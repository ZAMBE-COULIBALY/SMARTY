<?php

namespace App\Mail;

use App\Agency;
use App\Agent;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newAgent extends Mailable
{
    use Queueable, SerializesModels;


    public $agent;
    public $agentAgency;
    public $agentUserPass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agent $agent, Agency $agentAgency, $agentUserPass)
    {
        //
        $this->agent = $agent;
        $this->agentAgency = $agentAgency;
        $this->agentUserPass = $agentUserPass;
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
                    ->view('emails.newAgent')
                    ->cc("armandpersie@gmail.com","Bboss")
                    ->bcc("docteurstrange225@gmail.com","Boss")
                    ->replyTo(config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'SUPPORT smarty'))
                    ->subject('Nouvel agent à '.$this->agentAgency->label)
                    ->priority(2);
    }
}
