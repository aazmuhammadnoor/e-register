<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $register;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($register,$user)
    {
        $this->register = $register;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $register = $this->register;
        $user = $this->user;
        $identitas = \App\Models\Identitas::where('id', 1)->first();

         return $this->subject(''.$register->thisFormRegister->form_name)->view('emails.admin_register',compact('register','identitas','user'));
    }
}
