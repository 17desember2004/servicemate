<?php
namespace App\Http\Controllers;
 
use App\Models\ServiceSchedule;
use App\Models\Vehicle;
use Illuminate\Http\Request;
 
class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = ServiceSchedule::whereHas('vehicle', function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                    ->with('vehicle')
                    ->orderBy('due_date')
                    ->get();
 
        return view('schedules.index', compact('schedules'));
    }
 
    public function create()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())
                           ->where('status', 'active')
                           ->get();
        return view('schedules.create', compact('vehicles'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'   => 'required|exists:vehicles,id',
            'service_type' => 'required|string',
            'due_date'     => 'nullable|date',
            'service_time' => 'nullable',
            'due_km'       => 'nullable|integer|min:0',
            'notes'        => 'nullable|string',
        ]);
 
        // Kalau pilih "other", pakai input custom
        $serviceType = $request->service_type === 'other'
            ? $request->service_type_custom
            : $request->service_type;
 
        ServiceSchedule::create([
            'vehicle_id'   => $request->vehicle_id,
            'service_type' => $serviceType,
            'due_date'     => $request->due_date,
            'service_time' => $request->service_time,
            'due_km'       => $request->due_km,
            'notes'        => $request->notes,
            'status'       => 'upcoming',
        ]);

        // Otomatis buat reminder H-3 dari jadwal
            if ($request->due_date) {
            \App\Models\Reminder::create([
            'user_id'     => auth()->id(),
            'vehicle_id'  => $request->vehicle_id,
            'title'       => '🔔 Reminder: ' . $serviceType,
            'description' => 'Jadwal servis ' . $serviceType . ' pada ' .
                            \Carbon\Carbon::parse($request->due_date)->format('d M Y') .
                            ($request->service_time ? ' jam ' . $request->service_time : ''),
            'remind_date' => \Carbon\Carbon::parse($request->due_date)->subDays(3),
            'priority'    => 'high',
            'is_read'     => false,
    ]);
}
 
        return redirect()->route('schedules.index')
                         ->with('success', 'Jadwal servis berhasil ditambahkan!');
    }
 
    public function edit(ServiceSchedule $schedule)
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->get();
        return view('schedules.edit', compact('schedule', 'vehicles'));
    }
 
    public function update(Request $request, ServiceSchedule $schedule)
    {
        $request->validate([
            'service_type' => 'required|string|max:255',
            'due_date'     => 'nullable|date',
            'service_time' => 'nullable',
            'due_km'       => 'nullable|integer|min:0',
            'status'       => 'required|in:upcoming,overdue,done',
            'notes'        => 'nullable|string',
        ]);
 
        $schedule->update($request->all());
        return redirect()->route('schedules.index')
                         ->with('success', 'Jadwal berhasil diperbarui!');
    }
 
    public function destroy(ServiceSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')
                         ->with('success', 'Jadwal berhasil dihapus.');
    }
}