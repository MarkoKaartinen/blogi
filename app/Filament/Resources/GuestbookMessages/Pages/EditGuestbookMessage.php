<?php

namespace App\Filament\Resources\GuestbookMessages\Pages;

use App\Filament\Resources\GuestbookMessages\GuestbookMessageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGuestbookMessage extends EditRecord
{
    protected static string $resource = GuestbookMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
