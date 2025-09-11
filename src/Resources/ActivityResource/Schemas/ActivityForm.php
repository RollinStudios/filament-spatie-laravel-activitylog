<?php

namespace AlexJustesen\FilamentSpatieLaravelActivitylog\Resources\ActivityResource\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\KeyValue;

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                TextInput::make('causer_type')
                    ->label(__('filament-spatie-activitylog::activity.causer_type'))
                    ->columnSpan([
                        'default' => 2,
                        'sm' => 1,
                    ]),
                TextInput::make('causer_id')
                    ->label(__('filament-spatie-activitylog::activity.causer_id'))
                    ->columnSpan([
                        'default' => 2,
                        'sm' => 1,
                    ]),
                TextInput::make('subject_type')
                    ->label(__('filament-spatie-activitylog::activity.subject_type'))
                    ->columnSpan([
                        'default' => 2,
                        'sm' => 1,
                    ]),
                TextInput::make('subject_id')
                    ->label(__('filament-spatie-activitylog::activity.subject_id'))
                    ->columnSpan([
                        'default' => 2,
                        'sm' => 1,
                    ]),
                TextInput::make('description')
                    ->label(__('filament-spatie-activitylog::activity.description'))->columnSpan(2),
                KeyValue::make('properties.attributes')
                    ->label(__('filament-spatie-activitylog::activity.attributes'))
                    ->columnSpan([
                        'default' => 2,
                        'sm' => 1,
                    ]),
                KeyValue::make('properties.old')
                    ->label(__('filament-spatie-activitylog::activity.old'))
                    ->columnSpan([
                        'default' => 2,
                        'sm' => 1,
                    ]),
            ]);
    }
}
