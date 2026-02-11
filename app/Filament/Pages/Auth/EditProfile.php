<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public')
                    ->imageEditor()
                    ->circleCropper(),
                $this->getPasswordFormComponent()
                    ->revealable()
                    ->confirmed(),
                $this->getPasswordConfirmationFormComponent()
                    ->revealable(),
            ]);
    }
}
