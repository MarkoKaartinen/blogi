<?php

namespace App\Filament\Resources\Recipes\Schemas;

use App\Models\Recipe;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RecipeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Otsikko')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(Recipe::class, 'slug', fn ($record) => $record)
                    ->disabled(),

                Textarea::make('description')
                    ->label('Kuvaus')
                    ->columnSpanFull(),

                TextInput::make('year')
                    ->label('Vuosi')
                    ->required()
                    ->integer(),

                TextInput::make('file')
                    ->label('Tiedosto')
                    ->required()
                    ->disabled(),

                Select::make('status')
                    ->label('Tila')
                    ->options([
                        'draft' => 'Luonnos',
                        'published' => 'Julkaistu',
                    ])
                    ->required(),

                DateTimePicker::make('published_at')
                    ->label('Julkaistu'),

                TextInput::make('servings_amount')
                    ->label('Annoksia (määrä)')
                    ->integer(),

                TextInput::make('servings_unit')
                    ->label('Annoksia (yksikkö, esim. annosta, kpl, pizzaa)'),

                Toggle::make('post_to_mastodon')
                    ->label('Lähetä Mastodoniin'),

                TextInput::make('mastodon_post_id')
                    ->label('Mastodon Post ID')
                    ->disabled(),

                Repeater::make('ingredients')
                    ->label('Ainesosat')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('section')
                            ->label('Osio (vaihtoehtoinen)')
                            ->columnSpanFull(),
                        TextInput::make('amount')
                            ->label('Määrä')
                            ->numeric(),
                        TextInput::make('unit')
                            ->label('Yksikkö'),
                        TextInput::make('name')
                            ->label('Ainesosa'),
                    ])
                    ->columns(3)
                    ->addActionLabel('Lisää ainesosa')
                    ->collapsible()
                    ->cloneable(),

                Placeholder::make('created_at')
                    ->label('Luotu')
                    ->content(fn (?Recipe $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Päivitetty')
                    ->content(fn (?Recipe $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }
}
