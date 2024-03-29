<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $ip;
    protected string $userAgent;
    protected bool $isSoc;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $ip, string $userAgent, bool $isSoc)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->isSoc = $isSoc;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Новий вхід на сайт tsukor-norm',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.login',
            with:[
                'ip' => $this->ip,
                'userAgent' => $this->userAgent,
                'date' => date('d-m-Y H:i:s'),
                'isSoc' => $this->isSoc,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
