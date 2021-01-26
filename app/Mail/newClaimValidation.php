<?php

namespace App\Mail;

use App\Agency;
use App\Agent;
use App\Sinister;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newClaimValidation extends Mailable
{
    use Queueable, SerializesModels;


    public $sinister;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sinister $sinister)
    {
        //
        $this->sinister = $sinister;
        $this->sender  = [config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'Support SMARTY')];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                    ->view('emails.newClaimValidation')
                    ->bcc(explode(",",env("DEV_MAIL")),"DEV")
                    ->replyTo(config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'SUPPORT smarty'))
                    ->subject('Nouvelle déclaration de sinistre!')
                    ->priority(1)
                    ;
    }
}
