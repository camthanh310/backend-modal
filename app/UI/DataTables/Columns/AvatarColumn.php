<?php

namespace App\UI\DataTables\Columns;

use App\UI\DataTables\Abstracts\AbstractColumn;
use App\UI\DataTables\Contracts\ColumnInterface;

class AvatarColumn extends AbstractColumn
{
    public function format(): string
    {
        return class_basename(static::class);
    }
}
