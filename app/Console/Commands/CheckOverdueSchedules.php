<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServiceSchedule;
use Carbon\Carbon;

class CheckOverdueSchedules extends Command
{
    protected $signature   = 'schedules:check-overdue';
    protected $description = 'Tandai jadwal yang sudah lewat sebagai overdue';

    public function handle()
    {
        // Overdue hanya jika due_date SEBELUM hari ini (bukan sama dengan hari ini)
        $count = ServiceSchedule::where('status', 'upcoming')
            ->where('due_date', '<', Carbon::today())
            ->update(['status' => 'overdue']);

        $this->info("✅ $count jadwal ditandai overdue.");
    }
}