<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Carbon\Carbon;

class NotifikasiPerizinan extends Notification
{
    use Queueable;
    public $permohonan;
    public $type;
    public $msg;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($permohonan, $type, $msg)
    {
        $this->permohonan = $permohonan;
        $this->type = $type;
        $this->msg  = $msg;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'jenis'=>$this->type,
            'waktu'=>Carbon::now(),
            'permohonan'=>$this->permohonan,
            'msg'=>$this->msg
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'jenis'=>$this->type,
            'waktu'=>Carbon::now(),
            'permohonan'=>$this->permohonan,
            'msg'=>$this->msg
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
