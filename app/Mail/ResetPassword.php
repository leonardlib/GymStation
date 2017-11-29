<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class ResetPassword extends Mailable {
    use Queueable, SerializesModels;
    public $usuario, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $usuario) {
        $this->token = $token;
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('twofacedmirror34@gmail.com', 'GymStation')
                    ->subject('Restablecer contraseña')
                    ->view('mail.resetPassword');
    }
}
