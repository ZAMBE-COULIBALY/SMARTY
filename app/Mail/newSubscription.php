<?php

namespace App\Mail;

use App\Agency;
use App\CategoryGear;
use App\Cylender;
use App\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newSubscription extends Mailable
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

        $this->sender  = ['portail.smarty@gmail.com', config('mail.from.name', 'portail.smarty@gmail.com')];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                    ->view('emails.newSubscription')
                    ->from(config('mail.from.address', 'portail.smarty@gmail.com'),config('mail.from.name', 'portail.smarty@gmail.com'))
                    ->attach(storage_path().'/app/public/received/'.$this->subscription->first_name.$this->subscription->phone1.'.pdf',[
                        'as' => 'proforma.pdf',
                        'mime' =>  'application/pdf',
                    ])
                    // ->attach(storage_path().'/app/public/certificate/'.$this->subscription['attestationcode'].'.pdf',[
                    //     'as' => 'proforma.pdf',
                    //     'mime' =>  'application/pdf',
                    // ])
                    // ->cc(["Banianassurances@gmailcom","Crystalgroupe2018@gmail.com","arval777@gmail.com"],'Boss')
                    ->cc(explode(",",\env("MAIL_SUBSCRIPTION_CC")),'Admin')
                    ->bcc(explode(",",\env("DEV_MAIL")),'DEV')
                    ->replyTo(config('mail.from.address', 'portail.smarty@gmail.com'), config('mail.from.name', 'portail.smarty@gmail.com'))
                    ->subject('Nouvelle Souscription')
                    ->priority(3);
    }
}
