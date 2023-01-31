<?php

namespace App\Console\Commands;

use App\Models\ReadSession;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ChangeStatusEndRead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:endstatusreading';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mematikan status reading yang sudah tidak ada aktivitas';

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
     * @return int
     */
    public function handle()
    {
        $_LOG = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/change-status.log'),
        ]);
        $time_exp = Carbon::now()->subMinutes(2);
        $expired_session = ReadSession::where('on_reading', 1)->where('updated_at', '<', $time_exp)->update([
            'on_reading' => 0
        ]);
        $_LOG->info("{$time_exp} {$expired_session}");

        return 0;
    }
}
