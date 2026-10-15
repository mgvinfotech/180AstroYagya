<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Inquiry $inquiry;
    public string $recipientType; // 'admin' or 'seeker'

    public function __construct(Inquiry $inquiry, string $recipientType = 'admin')
    {
        $this->inquiry = $inquiry;
        $this->recipientType = $recipientType;
    }

    public function envelope(): Envelope
    {
        $subject = $this->recipientType === 'admin'
            ? '⚡ New Vedic Sankalp Inquiry: ' . $this->inquiry->full_name . ' (' . ucfirst($this->inquiry->inquiry_type) . ')'
            : '🕉️ Sankalp Confirmation: Your Vedic Yagya / Consultation Request is Received - 108 Astro Yagya';

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inquiry-notification',
        );
    }
}
