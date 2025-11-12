<?php

namespace App\Filament\Resources\Comments;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Comments\Pages\ListComments;
use App\Filament\Resources\Comments\Pages\CreateComment;
use App\Filament\Resources\Comments\Pages\EditComment;
use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $slug = 'comments';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $label = 'Kommentit';
    protected static ?string $modelLabel = 'Kommentti';
    protected static ?string $pluralLabel = 'Kommentit';
    protected static ?string $navigationLabel = 'Kommentit';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nickname')
                    ->required(),

                TextInput::make('email')
                    ->required(),

                Textarea::make('comment')
                    ->columnSpanFull()
                    ->rows(6)
                    ->required(),

                TextInput::make('link'),

                Select::make('article_id')
                    ->relationship('article', 'title')
                    ->searchable()
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Comment $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Comment $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nickname'),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('comment')
                    ->limit(30),

                TextColumn::make('link'),

                TextColumn::make('article.title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Luotu')
                    ->date('j.n.Y H:i'),
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComments::route('/'),
            'create' => CreateComment::route('/create'),
            'edit' => EditComment::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['article', 'parent']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['email', 'article.title', 'parent.email'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->article) {
            $details['Article'] = $record->article->title;
        }

        if ($record->parent) {
            $details['Parent'] = $record->parent->email;
        }

        return $details;
    }
}
