<?php

namespace App\Tables;

use App\Models\User;
use App\UI\DataTables\Actions\Action;
use App\UI\DataTables\DataTable;
use App\UI\DataTables\Columns\TextColumn;
use App\UI\DataTables\Columns\ActionColumn;
use App\UI\DataTables\Columns\AvatarColumn;
use Illuminate\Pagination\LengthAwarePaginator;

class Users extends DataTable
{
    public function columns(): array
    {
        return [
            TextColumn::make('id'),
            AvatarColumn::make('avatar'),
            TextColumn::make('name'),
            TextColumn::make('email'),
            TextColumn::make('created_at')->dateTime(),
            ActionColumn::make('action')
        ];
    }

    public function query(): LengthAwarePaginator
    {
        return User::paginate(3);
    }

    public function actions(): array
    {
        return [
            Action::make('Edit')
                ->link(fn(User $user) => route('users.edit', $user)),
            Action::make('Edit Button')
                ->modal(fn() => 1),
            Action::make('Show Info')
                ->link(fn(User $user) => route('users.show', $user))
        ];
    }
}
