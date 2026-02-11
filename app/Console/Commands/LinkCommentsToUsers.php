<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Console\Command;

class LinkCommentsToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogi:link-comments-to-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Yhdistä kommentit käyttäjiin sähköpostin perusteella';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Etsitään kommentteja ilman käyttäjäyhteyttä...');

        // Hae kaikki kommentit joilla ei ole user_id:tä mutta on sähköposti
        $comments = Comment::whereNull('user_id')
            ->whereNotNull('email')
            ->get();

        if ($comments->isEmpty()) {
            $this->info('Ei löytynyt yhdistettäviä kommentteja.');

            return self::SUCCESS;
        }

        $this->info("Löytyi {$comments->count()} kommenttia käsiteltäväksi.");

        $linked = 0;
        $notFound = 0;

        $bar = $this->output->createProgressBar($comments->count());
        $bar->start();

        foreach ($comments as $comment) {
            // Etsi käyttäjä sähköpostilla
            $user = User::where('email', $comment->email)->first();

            if ($user) {
                $comment->user_id = $user->id;
                $comment->save();
                $linked++;
            } else {
                $notFound++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("✓ Yhdistetty: {$linked} kommenttia");

        if ($notFound > 0) {
            $this->warn("! Ei löytynyt käyttäjää: {$notFound} kommentille");
        }

        return self::SUCCESS;
    }
}
