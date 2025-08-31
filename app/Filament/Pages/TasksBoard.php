<?php

namespace App\Filament\Pages;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Relaticle\Flowforge\Board;
use Relaticle\Flowforge\BoardPage;
use Relaticle\Flowforge\Column;
use BackedEnum;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;

class TasksBoard extends BoardPage
{
    public static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationLabel = 'Tasks Board';
    protected static ?string $title = 'Task Board';

    public function board(Board $board): Board
    {
        return $board
            ->query($this->getEloquentQuery())
            ->filters([
                Filter::make('overdue')
                    ->label('期限切れ')
                    ->query(fn (Builder $query) => $query->where('due_date', '<', today()))
                    ->toggle(),
                Filter::make('today')
                    ->label('今日のタスク')
                    ->query(fn (Builder $query) => $query->whereDate('due_date', today()))
                    ->toggle(),
            ])
            ->recordTitleAttribute('title')
            ->columnIdentifier('status')
            ->positionIdentifier('position') // Enable drag-and-drop with position field
            ->columns([
                Column::make('todo')->label('To Do')->color('gray'),
                Column::make('in_progress')->label('In Progress')->color('blue'),
                Column::make('done')->label('Completed')->color('green'),
            ])
            ->columnActions([
                CreateAction::make()
                    ->label('Add Task')
                    ->model(Task::class)
                    ->schema([
                        TextInput::make('title')->required(),
                        DatePicker::make('due_date'),
                        TextInput::make('priority'),
                    ])
                    ->mutateDataUsing(function (array $data, array $arguments): array {
                        if (isset($arguments['column'])) {
                            $data['status'] = $arguments['column'];
                            $data['position'] = $this->getBoardPositionInColumn($arguments['column']);
                        }
                        return $data;
                    }),
            ])
            ->cardActions([
                EditAction::make()
                ->schema([
                    TextInput::make('title')->required(),
                    DatePicker::make('due_date'),
                    TextInput::make('priority'),
                ]),
                DeleteAction::make()->model(Task::class),
            ])
            ->cardAction('edit')
            ->searchable(['title', 'description']);
    }

    public function getEloquentQuery(): Builder
    {
        return Task::query();
    }
}
