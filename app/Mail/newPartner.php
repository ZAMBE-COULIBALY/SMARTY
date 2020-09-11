<?php

namespace App\Mail;

use App\Manager;
use App\Partner;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newPartner extends Mailable
{
    use Queueable, SerializesModels;


    public $partner;
    public $partnerManager;
    public $partnerManagerUserPass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Partner $partner,Manager $partnerManager, $partnerManagerUserPass)
    {
        //
        $this->partner = $partner;
        $this->partnerManager = $partnerManager;
        $this->partnerManagerUserPass = $partnerManagerUserPass;
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
                    ->view('emails.newPartner')
                    ->bcc("armandpersie@gmail.com","Boss")
                    ->replyTo(config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'SUPPORT smarty'))
                    ->subject('Nouveau Partenariat!')
                    ->priority(2);
    }
}
