<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;
use App\Models\Result;

class LotteryResultProcessor implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $header;
    protected $lottery_type;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($header, $data, $lottery_type)
    {
        $this->header = $header;
        $this->lottery_type = $lottery_type;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->data as $result)
        {
            $result2 = array_merge($result, $this->lottery_type);
            Result::create(array_combine($this->header, $result2));
        }
    }

}
