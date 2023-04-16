<?php
 
namespace App\Console\Commands\DelayReport;

use App\Models\DelayReport;
use Illuminate\Console\Command;
use Brokenice\LaravelMysqlPartition\Schema\Schema;
use Brokenice\LaravelMysqlPartition\Models\Partition;
use Carbon\Carbon;

class RangePartition extends Command
{
    protected $signature = 'partition:delay_reports';
    protected $description = 'Using this command, the delay_reports table is partitioned monthly.';
    private string $db;
    private string $table;
    private Carbon $nextMonth;
 
    public function __construct()
    {
        parent::__construct();
        $this->db = app('db')->connection()->getDatabaseName();
        $this->table = (new DelayReport)->getTable();
        $this->nextMonth = Carbon::now()->addMonth();
    }

    public function handle()
    {
        $partitionName = 'p' . $this->nextMonth->format('Ym');
        if (!$this->getAllPartitions()->contains('PARTITION_NAME', $partitionName)) {
            
            Schema::partitionByRange(
                table: (new DelayReport)->getTable(),
                column: 'YEAR(created_at) * 100 + MONTH(created_at)',
                partitions: [
                    new Partition(
                        name: $partitionName,
                        type: Partition::RANGE_TYPE,
                        value: $this->nextMonth->format('Y') * 100 + $this->nextMonth->format('m')
                    )
                ],
                includeFuturePartition: false
            );
        }
    }

    private function getAllPartitions(): \Illuminate\Support\Collection
    {
        $partitions = Schema::getPartitionNames(db: $this->db, table: $this->table);
        return collect($partitions);
    }
}