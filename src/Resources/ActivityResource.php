<?php

namespace AlexJustesen\FilamentSpatieLaravelActivitylog\Resources;

use AlexJustesen\FilamentSpatieLaravelActivitylog\Resources\ActivityResource\Pages;
use AlexJustesen\FilamentSpatieLaravelActivitylog\Resources\ActivityResource\Schemas\ActivityForm;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity;
use Filament\Icons\Heroicon;
use BackedEnum;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    public static function getLabel(): string
    {
        return __('filament-spatie-activitylog::activity.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-spatie-activitylog::activity.plural_label');
    }

    public static function form(Schema $schema): Schema
    {
        return ActivityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivityTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filament-spatie-laravel-activitylog.resource.group') ?? parent::getNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-spatie-laravel-activitylog.resource.sort') ?? parent::getNavigationSort();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'view' => Pages\ViewActivity::route('/{record}'),
        ];
    }
}
