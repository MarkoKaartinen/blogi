<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Enums\Image\Size;
use MarcReichel\IGDBLaravel\Models\Game;

class GameBox extends Component
{
    public int $igdbId;

    public function render()
    {
        return view('livewire.game-box', [
            'game' => $this->getGame()
        ]);
    }

    public function getGame()
    {
        $game = Game::with(['cover', 'genres', 'platforms'])->where('id', $this->igdbId)->first();

        return (object) [
            'name' => $game->name,
            'summary' => $game->summary,
            'first_release_date' => $game->first_release_date,
            'cover' => $game->cover->getUrl(Size::COVER_BIG, true),
            'igdb_url' => $game->url,
            'total_rating' => $game->total_rating,
            'total_rating_count' => $game->total_rating_count,
            'genres' => $game->genres->pluck('name')->toArray(),
            'platforms' => $game->platforms->pluck('name')->toArray(),
        ];
    }
}
