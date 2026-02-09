<?php

namespace App\Livewire;

use App\Models\GuestbookMessage;
use App\Notifications\NewGuestbookMessageNotification;
use App\Support\MarkdownHandler;
use App\Support\SEO;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Guestbook extends Component
{
    use UsesSpamProtection, WithPagination;

    public HoneypotData $extraFields;

    public string $feedback = '';

    public string $title;

    public string $markdown;

    public string $nickname = '';

    public ?string $homepage = null;

    public string $message = '';

    public function mount()
    {
        $file = MarkdownHandler::getFile('pages/vieraskirja.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        $this->extraFields = new HoneypotData;

        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', ['vieraskirja']),
            url: route('guestbook'),
            titleSuffix: true
        );
    }

    public function sendMessage()
    {
        $this->feedback = '';
        $this->protectAgainstSpam();
        $rules = [
            'nickname' => 'required',
            'message' => 'required',
        ];
        if ($this->homepage !== null) {
            $rules['homepage'] = 'url';
        }
        $this->validate($rules);

        $message = Str::of($this->message)->stripTags();

        $guestbookMessage = GuestbookMessage::create([
            'nickname' => $this->nickname,
            'message' => $message,
            'homepage' => $this->homepage,
        ]);

        Notification::route('mail', config('blog.notification_email'))
            ->notify(new NewGuestbookMessageNotification($guestbookMessage));

        $this->reset(['nickname', 'homepage', 'message']);

        $this->feedback = 'Kiitos viestistäsi!';

        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.guestbook', [
            'messages' => GuestbookMessage::latest()->paginate(20),
        ]);
    }
}
