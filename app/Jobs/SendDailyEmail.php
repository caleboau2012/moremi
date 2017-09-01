<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Profile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class SendDailyEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $picked;
    protected $poll;
    protected $connections;
    protected $suggestions;
    protected $spots;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Profile $picked, $poll, $connections, $suggestions, Collection $spots)
    {
        //
        $this->picked = $picked;
        $this->poll = $poll;
        $this->connections = $connections;
        $this->suggestions = $suggestions;
        $this->spots = $spots;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $picked = $this->picked;

        Mail::send('emails.dailyPollVote', [
            'picked' => $picked,
            'poll' => (isset($this->poll))?$this->poll:null,
            'connections' => (isset($this->connections))?$this->connections:null,
            'suggestions' => $this->suggestions,
            'spots' => $this->spots
        ], function ($m)  use($picked){
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $m->to($picked->email)->subject('What you missed on Moore.me');
//                $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
        });
    }
}
