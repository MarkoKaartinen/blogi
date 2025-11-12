<?php

namespace App\Filament\Resources\Redirects;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Redirects\Pages\ListRedirects;
use App\Filament\Resources\Redirects\Pages\CreateRedirect;
use App\Filament\Resources\Redirects\Pages\EditRedirect;
use App\Filament\Resources\RedirectResource\Pages;
use App\Models\Redirect;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static ?string $slug = 'redirects';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-m-arrow-top-right-on-square';

    protected static ?string $label = 'Ohjaukset';
    protected static ?string $modelLabel = 'Ohjaus';
    protected static ?string $pluralLabel = 'Ohjaukset';
    protected static ?string $navigationLabel = 'Ohjaukset';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('old')
                    ->required(),

                TextInput::make('old_url')
                    ->url(),

                TextInput::make('new')
                    ->required(),

                TextInput::make('hits')
                    ->required()
                    ->integer(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Redirect $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Redirect $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('old')
                    ->searchable(),

                TextColumn::make('old_url'),

                TextColumn::make('new'),

                TextColumn::make('hits')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRedirects::route('/'),
            'create' => CreateRedirect::route('/create'),
            'edit' => EditRedirect::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
