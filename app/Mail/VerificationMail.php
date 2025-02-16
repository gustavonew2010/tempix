<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    public $code;
    
    /**
     * Cria uma nova instância da mensagem.
     */
    public function __construct($user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }
    
    /**
     * Constrói a mensagem.
     */
    public function build()
    {
        return $this->subject('Verificação de Email')
                    ->view('emails.verification')
                    ->with([
                        'user' => $this->user,
                        'code' => $this->code,
                    ]);
    }
} 