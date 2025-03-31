<?php

namespace App\Mail;

use App\Models\Facture;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaiementFacture extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Facture $facture)
    {
        //
    }
    public function build()
    {
        return $this->subject('Confirmation de Paiement')
        ->from('reservation@baolhotel.sn')
        ->to($this->facture->reservation->client->user->email)
            ->markdown('mail.paiementFacture')
            ->attach($this->facture->path, [
                'as' => 'paiement.pdf',
            ]);
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Confirmation de Paiement',
    //         from: 'reservation@baolhotel.sn',
    //         to: $this->facture->reservation->client->user->email,
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'mail.paiementFacture',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [
    //         new Attachment(
    //             path: $this->facture->path,
    //             name: 'paiement.pdf',
    //             options: []
    //         ),
    //     ];

    // }
}
