<?php

namespace App\Filament\Pages;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Relaticle\Flowforge\Board;
use Relaticle\Flowforge\BoardPage;
use Relaticle\Flowforge\Column;
use BackedEnum;

class TasksBoard extends BoardPage
{
    public static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationLabel = 'Tasks Board';
    protected static ?string $title = 'Task Board';

    public function board(Board $board): Board
    {
        return $board
            ->query($this->getEloquentQuery())
            ->recordTitleAttribute('title')
            ->columnIdentifier('status')
            ->positionIdentifier('position') // Enable drag-and-drop with position field
            ->columns([
                Column::make('todo')->label('To Do')->color('gray'),
                Column::make('in_progress')->label('In Progress')->color('blue'),
                Column::make('done')->label('Completed')->color('green'),
            ]);
    }

    public function getEloquentQuery(): Builder
    {
        return Task::query();
    }
}
