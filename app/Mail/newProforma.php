<?php

namespace App\Mail;

use App\Agency;
use App\Agent;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newProforma extends Mailable
{
    use Queueable, SerializesModels;


    public $subscription;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        //
        $this->subscription = $subscription;
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
                    ->view('emails.newProforma')
                    ->bcc("armandpersie@gmail.com","Boss")
                    ->attach(storage_path().'/app/public/invoices/'.$this->subscription['first_name'].$this->subscription['phone1'].'.pdf',[
                        'as' => 'PROFORMA.pdf',
                        'mime' =>  'application/pdf',
                    ])
                    ->replyTo(config('mail.from.address', 'smarty@gmail.com'), config('mail.from.name', 'SUPPORT smarty'))
                    ->subject('Nouvelle Proforma NSIA SMARTY')
                    ->priority(2);
    }
}
