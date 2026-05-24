<?php
namespace App\Http\Controllers;
 
use App\Models\Vehicle;
use Illuminate\Http\Request;
 
class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }
 
    public function create()
    {
        return view('vehicles.create');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'brand'        => 'required|string|max:100',
            'model'        => 'required|string|max:100',
            'year'         => 'required|integer|min:1990|max:' . date('Y'),
            'plate_number' => 'required|string|max:20',
            'fuel_type'    => 'required|in:bensin,diesel,listrik,hybrid',
            'current_km'   => 'required|integer|min:0',
        ]);
 
        Vehicle::create([
            'user_id'      => auth()->id(),
            'name'         => $request->name,
            'brand'        => $request->brand,
            'model'        => $request->model,
            'year'         => $request->year,
            'plate_number' => strtoupper($request->plate_number),
            'fuel_type'    => $request->fuel_type,
            'current_km'   => $request->current_km,
            'status'       => 'active',
        ]);
 
        return redirect()->route('vehicles.index')
                         ->with('success', 'Kendaraan berhasil ditambahkan!');
    }
 
    public function show(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $schedules = $vehicle->schedules()->orderBy('due_date')->get();
        $histories = $vehicle->histories()->latest('service_date')->get();
        return view('vehicles.show', compact('vehicle', 'schedules', 'histories'));
    }
 
    public function edit(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        return view('vehicles.edit', compact('vehicle'));
    }
 
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
 
        $request->validate([
            'name'         => 'required|string|max:255',
            'brand'        => 'required|string|max:100',
            'model'        => 'required|string|max:100',
            'year'         => 'required|integer|min:1990|max:' . date('Y'),
            'plate_number' => 'required|string|max:20',
            'fuel_type'    => 'required|in:bensin,diesel,listrik,hybrid',
            'current_km'   => 'required|integer|min:0',
            'status'       => 'required|in:active,inactive',
        ]);
 
        $vehicle->update($request->all());
        return redirect()->route('vehicles.index')
                         ->with('success', 'Kendaraan berhasil diperbarui!');
    }
 
    public function destroy(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $vehicle->delete();
        return redirect()->route('vehicles.index')
                         ->with('success', 'Kendaraan berhasil dihapus.');
    }
 
    // Pastikan kendaraan milik user yang login
    private function authorizeVehicle(Vehicle $vehicle)
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }
    }
}

