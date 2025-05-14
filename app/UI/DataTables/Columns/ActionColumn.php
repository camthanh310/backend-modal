<?php

namespace App\UI\DataTables\Columns;

use App\UI\DataTables\Abstracts\AbstractColumn;

class ActionColumn extends AbstractColumn
{
    public function __construct(
        protected string $accessorKey
    ) {
        parent::__construct(accessorKey: $accessorKey);
        $this->notVisibled();
    }

    public function format(): string
    {
        return class_basename(static::class);
    }
}
