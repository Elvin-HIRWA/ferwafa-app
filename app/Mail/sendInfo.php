<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendInfo extends Mailable
{
    public string $name;
    public string $email;
    public string $subjects;
    public string $content;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $name,
        $email,
        $subjects,
        $content
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->subjects = $subjects;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: $this->email,
            subject: $this->subjects,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.sendinfo',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subjects,
                'content' => $this->content
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
