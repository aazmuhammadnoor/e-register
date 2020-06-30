<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PermohonanSelesai extends Mailable
{
    use Queueable, SerializesModels;

    protected $permohonan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($permohonan)
    {
        $this->permohonan = $permohonan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $permohonan = $this->permohonan;
        $identitas = \App\Models\Identitas::where('id', 1)->first();
        return $this->subject('Permohonan Baru')->view('emails.permohonan',compact('permohonan','identitas'));
    }
}
