<?php

namespace App\Filament\Resources\Requests\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Request No')->sortable()->searchable(),
                TextColumn::make('full_name')->label('Employee')->sortable()->searchable(),
                TextColumn::make('department.name')->label('Department')->sortable()->searchable(),
                TextColumn::make('total_expenses')
                    ->label('Total Cost')
                    ->getStateUsing(function ($record) {
                        $expenses = $record->expenses ?? [];
                        return number_format(collect($expenses)->sum('amount'), 2);
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
