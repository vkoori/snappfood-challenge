<?php
 
namespace App\Console\Commands\DelayReport;

use App\Models\DelayReport;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class RangePartition extends Command
{
    protected $signature = 'partition:delay_reports';
    protected $description = 'Using this command, the delay_reports table is partitioned monthly.';
    private DelayReport $model;
 
    public function __construct()
    {
        parent::__construct();
        $this->model = new DelayReport;
    }

    public function handle()
    {
        $currentMonth = Carbon::now();
        if (!$this->model->hasPartition(date: $currentMonth)) {
            $this->model->savePartition(date: $currentMonth);
        }

        $nextMonth = Carbon::now()->addMonth();
        if (!$this->model->hasPartition(date: $nextMonth)) {
            $this->model->savePartition(date: $nextMonth);
        }
    }
}