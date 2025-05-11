<?php

namespace App\UI\DataTables\Abstracts;

use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractColumn implements Arrayable
{
    public function __construct(
        protected string $accessorKey,
        protected ?string $header = null,
        protected ?bool $enableSorting = null,
        protected ?bool $enableHiding = null,
        protected array $actions = [],
        protected bool $notVisibled = false
    ) {}

    public static function make(
        string $accessorKey,
        ?string $header = null,
        ?bool $enableSorting = null,
        ?bool $enableHiding = null,
        array $actions = [],
        bool $notVisibled = false
    ): static {
        return new static($accessorKey, $header, $enableSorting, $enableHiding, $actions, $notVisibled);
    }

    public function sortable(bool $enableSorting = true): self
    {
        $this->enableSorting = $enableSorting;

        return $this;
    }

    public function header(string $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function hidden(bool $enableHiding = true): self
    {
        $this->enableHiding = $enableHiding;

        return $this;
    }

    public function notVisibled(): self
    {
        $this->notVisibled = true;

        return $this;
    }

    public function toArray(): array
    {
        return collect([
            'accessorKey' => $this->accessorKey,
            'header' => is_null($this->header) ? Str::title($this->accessorKey) : $this->header,
            'enableSorting' => $this->enableSorting,
            'enableHiding' => $this->enableHiding,
            'format' => $this->format(),
            'actions' => $this->actions,
            'notVisibled' => $this->notVisibled
        ])->filter(fn($value) => !is_null($value))
            ->toArray();
    }

    abstract public function format(): string;
}
