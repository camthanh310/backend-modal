<?php

namespace App\UI\DataTables\Columns;

use App\UI\DataTables\Abstracts\AbstractColumn;

class ActionColumn extends AbstractColumn
{
    public function __construct(
        protected string $accessorKey,
        protected ?string $header = null,
        protected ?bool $enableSorting = null,
        protected ?bool $enableHiding = null,
        protected array $actions = [],
        protected bool $notVisibled = false
    ) {
        parent::__construct(
            accessorKey: $accessorKey,
            notVisibled: true
        );
    }

    public function format(): string
    {
        return class_basename(static::class);
    }
}
