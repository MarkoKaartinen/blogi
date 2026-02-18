<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface Mastodonable
{
    /**
     * @return Collection<int, static>
     */
    public static function pendingMastodonDispatch(): Collection;

    public function mastodonMessage(): string;

    public function saveMastodonStatus(string $statusId): void;
}
