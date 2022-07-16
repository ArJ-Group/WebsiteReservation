<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reservation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $r, $reservationServices, $reservationStatus;
    public function __construct($r, $reservationServices, $reservationStatus)
    {
        $this->r = $r;
        $this->reservationServices = $reservationServices;
        $this->reservationStatus = $reservationStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reservation', [
            'r' => $this->r, 'reservationServices' => $this->reservationServices, 'reservationStatus' => $this->reservationStatus
        ]);
    }
}
