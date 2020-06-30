<?php

namespace App\Listeners;

use App\Events\BroadcastSMS;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class KirimNotifikasiSMS
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BroadcastSMS  $event
     * @return void
     */
    public function handle(BroadcastSMS $event)
    {
        $permohonan = $event->permohonan;
        $jenis = $event->jenis;

        //$sms = new \App\Integrasi\Sms($permohonan, $jenis);
        //Storage::put('smslog/sms.txt', "Req : ".$sms->request."\n Res: ".$sms->response);
    }
}
