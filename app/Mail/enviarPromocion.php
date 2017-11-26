<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class enviarPromocion extends Mailable {
    use Queueable, SerializesModels;
    public $promocion, $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($promocion) {
        $this->promocion = $promocion;
        $this->usuario = Auth::user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('twofacedmirror34@gmail.com', 'GymStation')
                    ->view('mail.enviarPromocion');
    }
}
