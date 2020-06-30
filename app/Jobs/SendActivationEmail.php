<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\ActivationEmail;
use App\Models\Pendaftar;

class SendActivationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pendaftar;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = false;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ActivationEmail($this->pendaftar);
        Mail::to($this->pendaftar->email)->send($email);
    }

    /**
     * The job failed to process.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function failed($exception)
    {
        Pendaftar::destroy($this->pendaftar->id);
    }

}
