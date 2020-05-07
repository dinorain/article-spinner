<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Feedback extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Feedback
     */
    public $feedback;

    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Model\Feedback $feedback, $name)
    {
        $this->feedback = $feedback;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.feedback')
            ->subject('Thanks your feedback')
            ->with([
                'name' => $this->name,
            ]);
    }
}
