<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->label('Short Description')
                            ->helperText('Brief description shown on the project card')
                            ->rows(2)
                            ->columnSpanFull(),
                        RichEditor::make('detail')
                            ->label('Full Detail')
                            ->helperText('Complete project description shown in the modal')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'orderedList',
                                'link',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Images')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Project Images')
                            ->helperText('First image will be used as thumbnail. You can reorder by dragging.')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('projects')
                            ->maxFiles(10)
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

                Section::make('Categories & Technologies')
                    ->columns(2)
                    ->schema([
                        CheckboxList::make('categories')
                            ->options([
                                'web' => 'Web',
                                'mobile' => 'Mobile',
                                'api' => 'API',
                                'desktop' => 'Desktop',
                            ])
                            ->columns(2),
                        TagsInput::make('technologies')
                            ->placeholder('Add technology...')
                            ->suggestions([
                                'Laravel',
                                'Vue.js',
                                'React',
                                'Flutter',
                                'Node.js',
                                'MySQL',
                                'PostgreSQL',
                                'MongoDB',
                                'Firebase',
                                'Docker',
                                'AWS',
                                'Tailwind CSS',
                            ]),
                    ])->columnSpanFull(),

                Section::make('Links')
                    ->columns(2)
                    ->schema([
                        TextInput::make('demo_url')
                            ->label('Demo URL')
                            ->placeholder('https://example.com'),
                        TextInput::make('github_url')
                            ->label('GitHub URL')
                            ->placeholder('https://github.com/...'),
                    ])->columnSpanFull(),

                Section::make('Settings')
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ])->columnSpanFull(),
            ]);
    }
}
