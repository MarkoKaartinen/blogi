<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class PostComment extends Component
{
    use UsesSpamProtection;

    public HoneypotData $extraFields;

    public string $feedback = '';

    public string $nickname = '';

    public string $email = '';

    public ?string $homepage = null;

    public string $message = '';

    public $articleId;

    public function mount()
    {
        $this->extraFields = new HoneypotData;
    }

    public function render()
    {
        return view('livewire.post-comment');
    }

    public function postComment()
    {
        $this->feedback = '';
        $this->protectAgainstSpam();
        $rules = [
            'nickname' => 'required',
            'message' => 'required',
            'email' => 'required|email',
        ];
        if ($this->homepage !== null) {
            $rules['homepage'] = 'url';
        }
        $this->validate($rules);

        $message = Str::of($this->message)->stripTags();

        $comment = Comment::create([
            'nickname' => $this->nickname,
            'email' => $this->email,
            'comment' => $message,
            'link' => $this->homepage,
            'article_id' => $this->articleId,
        ]);

        Notification::route('mail', config('blog.notification_email'))
            ->notify(new NewCommentNotification($comment));

        $this->reset(['nickname', 'homepage', 'message', 'email']);

        $this->feedback = 'Kiitos kommentistasi!';
    }
}
