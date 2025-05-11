<?php

namespace App\UI\DataTables\Columns;

use App\UI\DataTables\Abstracts\AbstractColumn;

class TextColumn extends AbstractColumn
{
    public function format(): string
    {
        return class_basename(static::class);
    }
}
