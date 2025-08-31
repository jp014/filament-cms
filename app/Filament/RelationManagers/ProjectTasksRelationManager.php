<?php

namespace App\Filament\RelationManagers;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Miguilim\FilamentAutoPanel\AutoRelationManager;
use Zvizvi\RelationManagerRepeater\Tables\RelationManagerRepeaterAction;

class ProjectTasksRelationManager extends AutoRelationManager
{
    protected static string $relationship = 'tasks';

    protected static array $enumDictionary = [];

    protected static array $visibleColumns = [];

    protected static array $searchableColumns = [];

    public function getFilters(): array
    {
        return [
            //
        ];
    }

    public function getActions(): array
    {
        return [
            //
        ];
    }

    public function getColumnsOverwrite(): array
    {
        return [
            'table' => [
                //
            ],
            'form' => [
                //
            ],
            'infolist' => [
                //
            ],
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('project_id'),
                Tables\Columns\TextColumn::make('due_date'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
            ])  
            ->headerActions([
                RelationManagerRepeaterAction::make(),
            ]);
    }
}
