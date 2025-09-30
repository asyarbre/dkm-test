<?php

namespace App\Filament\Resources\Requests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Department;
use App\Helpers\NumberToWords;

class RequestForm
{
    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                TextInput::make('employee_id')
                    ->label('Employee ID')
                    ->required()
                    ->numeric(),
                Select::make('department_id')
                    ->label('Department')
                    ->options(Department::pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                TextInput::make('full_name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('purpose')
                    ->label('Purpose')
                    ->required()
                    ->maxLength(65535),
                DatePicker::make('activity_date')
                    ->label('Activity Date')
                    ->required(),
                Repeater::make('expenses')
                    ->label('Expenses')
                    ->schema([
                        TextInput::make('expense')
                            ->label('Expense Description')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('date')
                            ->label('Expense Date')
                            ->required(),
                        TextInput::make('amount')
                            ->label('Amount')
                            ->required()
                            ->numeric()
                            ->step(0.01)
                            ->live()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $expenses = $get('../../expenses') ?? [];
                                $total = collect($expenses)->sum('amount');
                                $set('../../total_amount_display', 'Rp ' . number_format($total, 0, ',', '.'));
                                $set('../../total_words_display', ucfirst(NumberToWords::convert($total)));
                            }),
                    ])
                    ->columns(3)
                    ->defaultItems(1)
                    ->addActionLabel('Add Expense')
                    ->reorderableWithButtons()
                    ->collapsible()
                    ->live()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $expenses = $get('expenses') ?? [];
                        $total = collect($expenses)->sum('amount');
                        $set('total_amount_display', 'Rp ' . number_format($total, 0, ',', '.'));
                        $set('total_words_display', ucfirst(NumberToWords::convert($total)));
                    }),
                TextInput::make('total_amount_display')
                    ->label('Total Amount')
                    ->disabled()
                    ->dehydrated(false)
                    ->default('Rp 0'),
                TextInput::make('total_words_display')
                    ->label('Total in Words')
                    ->disabled()
                    ->dehydrated(false)
                    ->default('Nol rupiah'),
            ]);
    }
}
