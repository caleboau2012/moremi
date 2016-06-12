<?php

namespace App\Console\Commands;

use App\Profile;
use Illuminate\Console\Command;

class ResetVote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:vote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description ='Command to reset vote every sunday by 12:00AM in the morning';

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
        
        $profiles =Profile::all();
        foreach($profiles as $profile) {
            $profile->vote =0;
            $profiles->save();
        }
        $this->info;

    }
}
