<?php

namespace App\Filament\Resources\Recipes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RecipesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Otsikko')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Tila')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('published_at')
                    ->label('Julkaistu')
                    ->date('j.n.Y H:i')
                    ->sortable(),

                TextColumn::make('prep_time')
                    ->label('Esivalmistelu')
                    ->suffix(' min')
                    ->sortable(),

                TextColumn::make('cook_time')
                    ->label('Valmistus')
                    ->suffix(' min')
                    ->sortable(),

                TextColumn::make('servings')
                    ->label('Annokset'),

                IconColumn::make('post_to_mastodon')
                    ->label('Mastodon')
                    ->boolean(),

                TextColumn::make('mastodon_post_id')
                    ->label('Mastodon ID')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Päivitetty')
                    ->date('j.n.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->defaultSort('published_at', 'desc');
    }
}
