<?php

namespace App\Filament\Resources;

use App\Models\Project;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Miguilim\FilamentAutoPanel\AutoResource;
use Miguilim\FilamentAutoPanel\Mounters\RelationManagerMounter;
use App\Filament\RelationManagers\ProjectTasksRelationManager;
use Guava\FilamentModalRelationManagers\Actions\RelationManagerAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ProjectResource extends AutoResource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static array $enumDictionary = [
        'status' => [
            'planned' => '予定',
            'in_progress' => '着手中',
            'completed' => '完了',
            'on_hold' => '保留',
        ]
    ];

    protected static array $visibleColumns = [];

    protected static array $searchableColumns = [];

    public static function getFilters(): array
    {
        return [
            //
        ];
    }

    public static function getActions(): array
    {
        return [
            //
        ];
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagerMounter::makeFromResource(
            //     resource: TaskResource::class, // Auto Resource
            //     relation: 'tasks',
            // ),
            ProjectTasksRelationManager::class,
        ];
    }

    public static function getHeaderWidgets(): array
    {
        return [
            'list' => [
                //
            ],
            'view' => [
                //
            ],
        ];
    }

    public static function getFooterWidgets(): array
    {
        return [
            'list' => [
                //
            ],
            'view' => [
                //
            ],
        ];
    }

    public static function getColumnsOverwrite(): array
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

    public static function getExtraPages(): array
    {
        return [
            //
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
            ])  
            ->recordActions([
                RelationManagerAction::make('tasks-relation-manager')
                    ->label('Tasks')
                    ->relationManager(\App\Filament\RelationManagers\ProjectTasksRelationManager::make()),
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
        ;
    }
    
}
