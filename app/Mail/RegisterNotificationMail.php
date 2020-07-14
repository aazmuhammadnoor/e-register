<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $register;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($register)
    {
        $this->register = $register;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $register = $this->register;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        $status = ucwords($register->status);

        return $this->subject($status.' Registrasi '.$register->thisFormRegister->form_name)->view('emails.register_notifikasi',compact('register','identitas'));
    }
}
