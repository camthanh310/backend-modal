<?php

namespace App\UI\DataTables\Columns;

use App\UI\DataTables\Abstracts\AbstractColumn;

class TextColumn extends AbstractColumn
{
    public function format(): string
    {
        return class_basename(static::class);
    }

    public function dateTime(): self
    {
        $this->dateTime = true;

        return $this;
    }
}
