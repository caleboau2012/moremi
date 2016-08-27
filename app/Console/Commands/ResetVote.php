<?php

namespace App\Console\Commands;

use App\Profile;
use App\Services\Vote\VoteResetter;
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
       $reset =new VoteResetter();
        $reset->reset(); ///reset vote;
        $this->info('Vote successfully reset');

    }
}
