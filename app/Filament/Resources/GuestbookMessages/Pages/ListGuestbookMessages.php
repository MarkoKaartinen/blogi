<?php

namespace App\Filament\Resources\GuestbookMessages\Pages;

use App\Filament\Resources\GuestbookMessages\GuestbookMessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGuestbookMessages extends ListRecords
{
    protected static string $resource = GuestbookMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
