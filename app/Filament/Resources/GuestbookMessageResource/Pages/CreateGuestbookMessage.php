<?php

namespace App\Filament\Resources\GuestbookMessageResource\Pages;

use App\Filament\Resources\GuestbookMessageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGuestbookMessage extends CreateRecord
{
    protected static string $resource = GuestbookMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
