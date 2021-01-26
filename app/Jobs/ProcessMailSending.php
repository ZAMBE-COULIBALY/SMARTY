<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessMailSending implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reciever;
    protected $mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($reciever, Mailable $mail)
    {
        //
        $this->reciever = $reciever;
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try {
            //code...
            Mail::to($this->reciever[0],$this->reciever[1])->send($this->mail);

        } catch (\Throwable $th) {
            throw $th;
            Log::alert(json_encode($th));
        }
    }
}
