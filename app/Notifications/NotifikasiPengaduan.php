<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Carbon\Carbon;

class NotifikasiPengaduan extends Notification
{
    use Queueable;
    public $pengaduan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'waktu'=>Carbon::now(),
            'pengaduan'=>$this->pengaduan
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'waktu'=>Carbon::now(),
            'pengaduan'=>$this->pengaduan
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
