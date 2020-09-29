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

class newSinister extends Mailable
{
    use Queueable, SerializesModels;


    public $sinister;
    public $agent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sinister $sinister,Agent $agent)
    {
        //
        $this->sinister = $sinister;
        $this->agent = $agent;
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
                    ->view('emails.newSinister')
                    ->cc([$this->agent,$this->agent->agency->chief],"RESPONSABLE")
                    ->bcc(explode(",",env("DEV_MAIL")),"DEV")
                    ->replyTo(config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'SUPPORT smarty'))
                    ->subject('Nouvelle déclaration de sinistre!')
                    ->priority(3);
    }
}
