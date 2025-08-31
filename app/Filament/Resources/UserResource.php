<?php

namespace App\Filament\Resources;

use App\Models\User;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Miguilim\FilamentAutoPanel\AutoResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class UserResource extends AutoResource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static array $enumDictionary = [];

    protected static array $visibleColumns = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

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
            //
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
                TextInput::make('password')
                ->password()
                    ->afterStateHydrated(function (TextInput $component, $state) {
                        $component->state('');
                    })
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
            ],
            'infolist' => [
                //
                TextEntry::make('password')
                    ->label('Password')
                    ->formatStateUsing(fn () => '******'),
            ],
        ];
    }

    public static function getExtraPages(): array
    {
        return [
            //
        ];
    }
}
