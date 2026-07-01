<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public string $senderName;
    public string $senderEmail;
    public string $subjectText;
    public string $messageBody;
    public string $type; // 'admin' hoặc 'user'

    /**
     * Create a new message instance.
     */
    public function __construct(string $senderName, string $senderEmail, string $subjectText, string $messageBody, string $type = 'user')
    {
        $this->senderName  = $senderName;
        $this->senderEmail = $senderEmail;
        $this->subjectText = $subjectText;
        $this->messageBody = $messageBody;
        $this->type        = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjectLine = $this->type === 'admin'
            ? '[UniEvent] Tin nhắn mới từ: ' . $this->senderName
            : 'UniEvent – Xác nhận đã nhận tin nhắn của bạn';

        return new Envelope(
            subject: $subjectLine,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->type === 'admin'
            ? 'emails.contact-admin'
            : 'emails.contact-user';

        return new Content(
            view: $view,
        );
    }
}
