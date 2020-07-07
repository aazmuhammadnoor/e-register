<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $registant;
    protected $otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registant,$otp)
    {
        $this->registant = $registant;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $registant = $this->registant;
        $otp = $this->otp;
        return $this->subject('OTP Login')->view('emails.otp',compact('registant','otp'));
    }
}
