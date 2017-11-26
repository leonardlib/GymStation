<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class PagoClase extends Mailable {
    use Queueable, SerializesModels;
    public $clase, $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clase) {
        $this->clase = $clase;
        $this->usuario = Auth::user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('twofacedmirror34@gmail.com', 'GymStation')
                    ->view('mail.pagoClase');
    }
}
