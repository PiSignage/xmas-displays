<?php

namespace App\Filament\Resources\Displays\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;

class DisplayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')->required()->columnSpanFull(),
                        Textarea::make('description')->rows(5)->columnSpanFull(),

                    ]),
                Section::make('Location Details')
                    ->schema([
                        TextInput::make('address_line_1')
                            ->label('First address'),
                        TextInput::make('address_line_2')
                            ->label('Second address'),
                        TextInput::make('address_city')
                            ->label('City'),
                        TextInput::make('address_postcode')
                            ->label('Post code'),
                    ])
                    ->columns(2),

                Section::make('Social')
                    ->schema([
                        TextInput::make('website_uri')
                            ->label('Website'),
                        TextInput::make('public_email')
                            ->label('Public contact email'),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('facebook_link')
                                    ->label('Facebook'),
                                TextInput::make('twitter_link')
                                    ->label('Twitter'),
                                TextInput::make('instagram_link')
                                    ->label('Instagram'),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Images')
                    ->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->hiddenLabel()
                            ->disk('display_images'),
                    ])
            ])
            ->columns(1);
    }
}
