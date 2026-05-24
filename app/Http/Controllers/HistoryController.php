<?php
namespace App\Http\Controllers;
 
use App\Models\ServiceHistory;
use App\Models\Vehicle;
use Illuminate\Http\Request;
 
class HistoryController extends Controller
{
    public function index()
    {
        $histories = ServiceHistory::whereHas('vehicle', function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                    ->with('vehicle')
                    ->latest('service_date')
                    ->get();
 
        return view('histories.index', compact('histories'));
    }
 
    public function create()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->get();
        return view('histories.create', compact('vehicles'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'   => 'required|exists:vehicles,id',
            'service_type' => 'required|string|max:255',
            'service_date' => 'required|date',
            'km_at_service'=> 'required|integer|min:0',
            'cost'         => 'nullable|numeric|min:0',
            'bengkel_name' => 'nullable|string|max:255',
            'notes'        => 'nullable|string',
        ]);
 
        ServiceHistory::create($request->all());
 
        return redirect()->route('histories.index')
                         ->with('success', 'Riwayat servis berhasil disimpan!');
    }
 
    public function destroy(ServiceHistory $history)
    {
        $history->delete();
        return redirect()->route('histories.index')
                         ->with('success', 'Riwayat dihapus.');
    }
}