<?php

namespace App\UI\DataTables\Actions;

use Illuminate\Contracts\Support\Arrayable;

class Action implements Arrayable
{
    protected $linkFn;

    protected $modalFn;

    public function __construct(protected string $label, protected ?string $icon = null) {}

    public function toArray()
    {
        if (!empty($this->linkFn)) {
            $actionType = 'url';
            $action = $this->linkFn;
        } elseif (!empty($this->modalFn)) {
            $actionType = 'modal';
            $action = $this->modalFn;
        }

        return collect([
            'label'      => $this->label,
            'actionType' => $actionType,
            'action'     => $action,
            'icon'       => $this->icon,
        ])->filter(fn($value) => !is_null($value))
            ->toArray();
    }

    public static function make(string $label, ?string $icon = null): static
    {
        return new static($label, $icon);
    }

    public function icon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function link(callable $callback): self
    {
        $this->linkFn = $callback;

        return $this;
    }

    public function modal(callable $callback): self
    {
        $this->modalFn = $callback;

        return $this;
    }
}
