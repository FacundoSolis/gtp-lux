<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation; // Objeto Reservation completo

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('email.confirmation_title'))
                    ->view('emails.confirmation')
                    ->with(['reservation' => $this->reservation]);
    }
}
