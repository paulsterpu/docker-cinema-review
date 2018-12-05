<?php

namespace App\Jobs;

use App\Movie;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $movie, $grade;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Movie $movie, int $grade)
    {
        $this->movie = $movie;
        $this->grade = $grade;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //$movie -> Eloquent object
        //$grade -> integer

        Log::info('testinggggggggggggggggggggggggg');

        $this->movie->reviews()->create(["grade" => $this->grade]);

    }
}
