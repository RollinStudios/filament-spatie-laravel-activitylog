<?php
namespace AlexJustesen\FilamentSpatieLaravelActivitylog\Resources\ActivityResource\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ActivityTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('subject_type')
                    ->label(__('filament-spatie-activitylog::activity.subject'))
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('filament-spatie-activitylog::activity.description'))
                    ->searchable(),
                TextColumn::make('log_name')
                    ->label(__('filament-spatie-activitylog::activity.log')),
                TextColumn::make('created_at')
                    ->label(__('filament-spatie-activitylog::activity.logged_at'))
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('event')
                    ->multiple()
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('logged_from')
                            ->label('Logged from'),
                        DatePicker::make('logged_until')
                            ->label('Logged until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['logged_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['logged_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['logged_from'] ?? null) {
                            $indicators['logged_from'] = 'Created from ' . Carbon::parse($data['logged_from'])->toFormattedDateString();
                        }
                        if ($data['logged_until'] ?? null) {
                            $indicators['logged_until'] = 'Created until ' . Carbon::parse($data['logged_until'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),
            ])
            ->toolbarActions([])
            ->defaultSort('id', 'DESC');
    }
}