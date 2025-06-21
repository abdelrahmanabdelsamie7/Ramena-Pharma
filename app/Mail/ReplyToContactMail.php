<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyToContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $replyMessage;
    public function __construct($name, $phone,$replyMessage)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->replyMessage = $replyMessage;
    }
    public function build()
    {
        return $this->subject('Reply to Your Message')
            ->view('emails.reply_to_contact');
    }
}
