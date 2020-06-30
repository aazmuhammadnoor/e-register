<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class QueueActivationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:aktivasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue Worker for Activation Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return \App\Util\Command::factory('queue:work --queue=aktivasi')->runInBackground();
    }
}
