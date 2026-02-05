<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('title')
                    ->default(null),
                TextInput::make('subtitle')
                    ->default(null),
                Textarea::make('hero_description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('profile_image')
                    ->image(),
                Textarea::make('about_description')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('about_description_2')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('years_experience')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('projects_completed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('happy_clients')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('location')
                    ->default(null),
                TextInput::make('availability_status')
                    ->required()
                    ->default('Available for Work'),
                    FileUpload::make('cv_file')
                    ->default(null),
                TextInput::make('github_url')
                    ->url()
                    ->default(null),
                TextInput::make('linkedin_url')
                    ->url()
                    ->default(null),
                TextInput::make('twitter_url')
                    ->url()
                    ->default(null),
                TextInput::make('instagram_url')
                    ->url()
                    ->default(null),
            ]);
    }
}
