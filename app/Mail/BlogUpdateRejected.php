<?php
namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogUpdateRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $rejectMessage;
    public $rejectType;
    public $blog;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rejectMessage, $rejectType, Blog $blog)
    {
        $this->rejectMessage = $rejectMessage;
        $this->rejectType = $rejectType;
        $this->blog = $blog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Blog Update')
                    ->view('emails.blog_update_rejected') // Tạo view để gửi email
                    ->with([
                        'rejectMessage' => $this->rejectMessage,
                        'rejectType' => $this->rejectType,
                        'blog' => $this->blog,
                    ]);
    }
}
