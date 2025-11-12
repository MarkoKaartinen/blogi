<?php

namespace App\Filament\Resources\GuestbookMessages;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\GuestbookMessages\Pages\ListGuestbookMessages;
use App\Filament\Resources\GuestbookMessages\Pages\CreateGuestbookMessage;
use App\Filament\Resources\GuestbookMessages\Pages\EditGuestbookMessage;
use App\Filament\Resources\GuestbookMessageResource\Pages;
use App\Models\GuestbookMessage;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class GuestbookMessageResource extends Resource
{
    protected static ?string $model = GuestbookMessage::class;

    protected static ?string $slug = 'guestbook';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center';

    protected static ?string $label = 'Vieraskirja';
    protected static ?string $modelLabel = 'Viesti';
    protected static ?string $pluralLabel = 'Vieraskirja';
    protected static ?string $navigationLabel = 'Vieraskirja';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nickname')
                    ->required(),

                TextInput::make('homepage'),

                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('reply')
                    ->columnSpanFull(),

                DateTimePicker::make('replied_at')
                    ->label('Replied Date')
                    ->columnSpanFull(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?GuestbookMessage $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?GuestbookMessage $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nickname')
                    ->label('Nimimerkki'),

                TextColumn::make('homepage')
                    ->label('Kotisivut'),

                TextColumn::make('created_at')
                    ->label('Luotu')
                    ->date('j.n.Y H:i'),

                TextColumn::make('replied_at')
                    ->label('Vastattu')
                    ->date('j.n.Y H:i'),
            ])
            ->filters([
                TernaryFilter::make('answered')
                    ->label('Vastattu')
                    ->placeholder('Kaikki')
                    ->trueLabel('Kyllä')
                    ->falseLabel('Ei')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNull('reply'),
                        false: fn (Builder $query) => $query->whereNullNotNull('reply'),
                        blank: fn (Builder $query) => $query,
                    ),
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
            'index' => ListGuestbookMessages::route('/'),
            'create' => CreateGuestbookMessage::route('/create'),
            'edit' => EditGuestbookMessage::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
