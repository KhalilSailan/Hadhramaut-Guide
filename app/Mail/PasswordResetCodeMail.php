<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $code;
    public int $expiresIn;

    /**
     * Create a new message instance.
     */
    public function __construct(string $code, int $expiresIn)
    {
        $this->code = $code;
        $this->expiresIn = $expiresIn;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('كود إعادة تعيين كلمة المرور')
                    ->view('emails.password-reset-code');
    }
}
