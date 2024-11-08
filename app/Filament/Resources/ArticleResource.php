<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $slug = 'articles';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $label = 'Artikkelit';
    protected static ?string $modelLabel = 'Artikkeli';
    protected static ?string $pluralLabel = 'Artikkelit';
    protected static ?string $navigationLabel = 'Artikkelit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                TextArea::make('description')
                    ->columnSpanFull(),

                TextInput::make('year')
                    ->required()
                    ->integer(),

                TextInput::make('slug')
                    ->disabled()
                    ->required()
                    ->unique(Article::class, 'slug', fn($record) => $record),

                TextInput::make('file')
                    ->required(),

                TextInput::make('status')
                    ->required(),

                Checkbox::make('legacy'),

                TextInput::make('mastodon_post_id'),

                DatePicker::make('published_at')
                    ->label('Published Date'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Article $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Article $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                TextInput::make('igdb_id')
                    ->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('year'),

                TextColumn::make('status'),

                TextColumn::make('legacy'),

                TextColumn::make('mastodon_post_id'),

                TextColumn::make('published_at')
                    ->label('Julkaistu')
                    ->date('j.n.Y H:i'),

                TextColumn::make('created_at')
                    ->label('Luotu')
                    ->date('j.n.Y H:i'),

                TextColumn::make('updated_at')
                    ->label('Päivitetty')
                    ->date('j.n.Y H:i'),

                TextColumn::make('igdb_id'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug'];
    }
}
