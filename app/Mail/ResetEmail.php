<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pendaftar;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pendaftar = $this->pendaftar;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        return $this->subject('Reset Password Akun DPMPTSP Kota Palembang')->view('emails.reset',compact('pendaftar','identitas'));
    }
}
