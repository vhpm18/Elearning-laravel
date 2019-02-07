<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageToStudent extends Mailable
{
    private $text_message;
    private $teacher;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teacher, $text_message)
    {
        //
        $this->teacher      = $teacher;
        $this->text_message = $text_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("Mensaje de :teacher", ['teacher' => $this->teacher]))
            ->markDown('emails.message_to_student')
            ->with('text_message', $this->text_message);
    }
}
