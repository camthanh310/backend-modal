<?php

namespace App\UI\DataTables\Contracts;

interface ColumnInterface
{
    public static function make(
        string $accessorKey,
        null|string $header = null,
        null|bool $enableSorting = null,
        null|bool $enableHiding = null
    ): static;

    public function sortable(bool $enableSorting = true): self;

    public function header(string $header): self;

    public function hidden(bool $enableHiding = true): self;

    public function toArray(): array;
}
