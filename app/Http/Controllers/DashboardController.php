<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Reminder;
use App\Models\ServiceSchedule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user     = auth()->user();
        $vehicles = Vehicle::where('user_id', $user->id)->get();

        // Reminder muncul H-7 sebelum tanggal (lebih berguna)
        $reminders = Reminder::where('user_id', $user->id)
                            ->where('is_read', false)
                            ->where('remind_date', '>=', Carbon::today())
                            ->where('remind_date', '<=', Carbon::today()->addDays(3))
                            ->orderBy('remind_date')
                            ->limit(5)
                            ->get();

        // Jadwal overdue
        $overdueSchedules = ServiceSchedule::whereHas('vehicle', function($q) use ($user) {
                                $q->where('user_id', $user->id);
                            })
                            ->where('status', 'overdue')
                            ->count();

        return view('dashboard.index', compact('vehicles', 'reminders', 'overdueSchedules'));
    }
}