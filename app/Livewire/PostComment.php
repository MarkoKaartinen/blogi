<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewCommentReplyNotification;
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

    public bool $notifyOnReply = false;

    public $articleId;

    public ?int $replyTo = null;

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
            'parent_id' => $this->replyTo,
            'notify_on_reply' => $this->notifyOnReply,
        ]);

        // Check if admin is commenting
        $isAdminCommenting = auth()->check() && auth()->user()->is_admin;

        // Notify admin about new comment (unless admin is the one commenting)
        if (! $isAdminCommenting) {
            Notification::route('mail', config('blog.notification_email'))
                ->notify(new NewCommentNotification($comment));
        }

        // If this is a reply, notify the parent comment author if they want notifications
        if ($this->replyTo) {
            $parentComment = Comment::find($this->replyTo);
            if ($parentComment && $parentComment->notify_on_reply) {
                Notification::route('mail', $parentComment->email)
                    ->notify(new NewCommentReplyNotification($comment, $parentComment));
            }
        }

        $this->reset(['nickname', 'homepage', 'message', 'email', 'notifyOnReply']);

        // Close reply form
        if ($this->replyTo) {
            $this->dispatch('cancelReply');
        }

        $this->feedback = 'Kiitos kommentistasi!';
    }
}
