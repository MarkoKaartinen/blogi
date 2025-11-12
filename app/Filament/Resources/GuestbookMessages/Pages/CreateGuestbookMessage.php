<?php

namespace App\Filament\Resources\GuestbookMessages\Pages;

use App\Filament\Resources\GuestbookMessages\GuestbookMessageResource;
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
