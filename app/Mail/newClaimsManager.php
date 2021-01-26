<?php

namespace App\Mail;

use App\ClaimsManager;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newClaimsManager extends Mailable
{
    use Queueable, SerializesModels;


    public $claimsManager;
    public $claimsManagerUser;
    public $claimsManagerUserPass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ClaimsManager $claimsManager, User $claimsManagerUser, $claimsManagerUserPass)
    {
        //
        $this->claimsManager = $claimsManager;
        $this->claimsManagerUserPass = $claimsManagerUserPass;
        $this->claimsManagerUser = $claimsManagerUser;
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
                    ->view('emails.newClaimsManager')
                    ->bcc("armandpersie@gmail.com","Boss")
                    ->replyTo(config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'SUPPORT smarty'))
                    ->subject('Nouveau Gestionnaire sinistres')
                    ->priority(1);
    }
}
