<?php
namespace App\Http\Controllers;
 
use App\Models\Reminder;
use App\Models\Vehicle;
use App\Http\Controllers\PushController;
use Illuminate\Http\Request;
 
class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::where('user_id', auth()->id())
                        ->with('vehicle')
                        ->orderBy('remind_date')
                        ->get();
 
        return view('reminders.index', compact('reminders'));
    }
 
    public function create()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->where('status', 'active')->get();
        return view('reminders.create', compact('vehicles'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'  => 'required|exists:vehicles,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_date' => 'required|date',
            'priority'    => 'required|in:low,medium,high',
        ]);
 
        $reminder = Reminder::create([
            'user_id'     => auth()->id(),
            'vehicle_id'  => $request->vehicle_id,
            'title'       => $request->title,
            'description' => $request->description,
            'remind_date' => $request->remind_date,
            'priority'    => $request->priority,
            'is_read'     => false,
        ]);
 
        // Kirim push notification
        try {
            $vehicle = Vehicle::find($request->vehicle_id);
            PushController::sendToUser(
                auth()->id(),
                '🔔 Reminder Baru: ' . $reminder->title,
                ($vehicle ? $vehicle->name . ' · ' : '') . 'Jatuh tempo: ' . \Carbon\Carbon::parse($reminder->remind_date)->format('d M Y'),
                '/reminders'
            );
        } catch (\Exception $e) {
            // Notifikasi gagal tidak mengganggu proses utama
        }
 
        return redirect()->route('reminders.index')
                         ->with('success', 'Reminder berhasil ditambahkan!');
    }
 
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()->route('reminders.index')
                         ->with('success', 'Reminder dihapus.');
    }
 
    // Tandai sudah dibaca
    public function markRead($id)
    {
        $reminder = Reminder::where('id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();
        $reminder->update(['is_read' => true]);
        return back()->with('success', 'Reminder ditandai sudah dibaca.');
    }
}