<?php
namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogUpdateAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $blog;
    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Blog $blog, $messageContent = null)
    {
        $this->blog = $blog;
        $this->messageContent = $messageContent ?? 'Your blog has been accepted!';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Blog Accepted')
                    ->view('emails.blog_update_accepted')
                    ->with([
                        'blog' => $this->blog,
                        'messageContent' => $this->messageContent,
                    ]);
    }
}
