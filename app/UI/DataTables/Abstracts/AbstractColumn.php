<?php

namespace App\UI\DataTables\Abstracts;

use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractColumn implements Arrayable
{
    protected bool $dateTime = false;
    protected ?string $header = null;
    protected ?bool $enableSorting = null;
    protected ?bool $enableHiding = null;
    protected bool $notVisibled = false;

    public function __construct(
        protected string $accessorKey,
    ) {}

    public static function make(string $accessorKey): static
    {
        return new static($accessorKey);
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
            'notVisibled' => $this->notVisibled,
            'dateTime' => $this->dateTime
        ])->filter(fn($value) => !is_null($value))
            ->toArray();
    }

    public function dateTime(): self
    {
        $this->dateTime = false;

        return $this;
    }

    abstract public function format(): string;
}
