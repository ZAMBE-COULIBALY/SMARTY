<?php

namespace App\Mail;

use App\Agency;
use App\Agent;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newAgency extends Mailable
{
    use Queueable, SerializesModels;


    public $agency;
    public $agencyChief;
    public $agencyChiefUserPass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agency $agency,Agent $agencyChief, $agencyChiefUserPass)
    {
        //
        $this->agency = $agency;
        $this->agencyChief = $agencyChief;
        $this->agencyChiefUserPass = $agencyChiefUserPass;
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
                    ->view('emails.newAgency')
                    ->cc("armandpersie@gmail.com","Bboss")
                    ->bcc("docteurstrange225@gmail.com","Boss")
                    ->replyTo(config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'SUPPORT smarty'))
                    ->subject('Nouvelle Agence!')
                    ->priority(2);
    }
}
