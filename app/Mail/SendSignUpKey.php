<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSignUpKey extends Mailable
{
    use Queueable, SerializesModels;

    public string $key;
    public string $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($key, $email)
    {
        //
        $this->key = $key;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('contact@ferwafa.rw', 'Ferwafa')
            ->subject('Signup to Ferwafa')
            ->markdown('mail.SendSignUpKey')
            ->with([
                'name' => $this->email,
                'link' => $this->key
            ]);
    }
}

    