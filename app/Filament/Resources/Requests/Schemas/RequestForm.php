<?php

namespace App\Filament\Resources\Requests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
            ]);
    }
}
