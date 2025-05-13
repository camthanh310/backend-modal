<?php

namespace App\UI\DataTables;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

abstract class DataTable
{
    public static function make(): array
    {
        $instance = new static;

        return [
            'columns'  => $instance->toColumns()->toArray(),
            'response' => $instance->toQuery()->toArray()
        ];
    }

    abstract public function columns(): array;

    abstract public function query(): LengthAwarePaginator;

    public function actions(): array
    {
        return [];
    }

    protected function paginator(array $data): Collection
    {
        return collect([
            'data'  => $data,
            'links' => [
                'first' => $this->query()->url(1),
                'last'  => $this->query()->url($this->query()->lastPage()),
                'prev'  => $this->query()->previousPageUrl(),
                'next'  => $this->query()->nextPageUrl()
            ],
            'meta' => [
                'current_page' => $this->query()->currentPage(),
                'from'         => $this->query()->firstItem(),
                'last_page'    => $this->query()->lastPage(),
                'links'        => $this->query()->toArray()['links'],
                'path'         => $this->query()->path(),
                'per_page'     => $this->query()->perPage(),
                'to'           => $this->query()->lastItem(),
                'total'        => $this->query()->total()
            ]
        ]);
    }

    protected function toQuery(): Collection
    {
        $data = [];

        $accessorKeys = $this->toColumns()->pluck('accessorKey')->toArray();

        foreach ($this->query()->items() as $key => $model) {
            foreach ($accessorKeys as $accessorKey) {
                if (isset($model[$accessorKey])) {
                    $field = $model[$accessorKey];
                    if ($field instanceof Carbon) {
                        $data[$key][$accessorKey] = Carbon::make($field)->toDateTimeString();
                    } else {
                        $data[$key][$accessorKey] = $field;
                    }
                }
            }

            if (!empty($actions = $this->actions())) {
                foreach ($actions as $ack => $action) {
                    if ($action instanceof Arrayable) {
                        $execute = $action->toArray();
                        $label = data_get($execute, 'label');
                        $icon = data_get($execute, 'icon');
                        $actionType = data_get($execute, 'actionType');
                        if ($actionType === 'url') {
                            $action = value($execute['action'], $model);
                        } else {
                            $action = value($execute['action']);
                        }
                    } else {
                        $label = data_get($action, 'label');
                        $icon = data_get($action, 'icon');

                        if ($ack === 'url') {
                            $actionType = 'url';
                            $action = value($action['url'], $model);
                        }
                    }
                    $data[$key]['action'][$ack] = [
                        'label' => $label,
                        'icon' => $icon,
                        'actionType' => $actionType,
                        'action' => $action
                    ];
                }
            }
        }

        return $this->paginator($data);
    }

    protected function toColumns(): Collection
    {
        return collect($this->columns())->map(function ($column) {
            if ($column instanceof Arrayable) {
                return $column->toArray();
            }

            return $column;
        });
    }
}
