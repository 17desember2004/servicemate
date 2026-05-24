<?php
namespace App\Http\Controllers;
 
use App\Models\Bengkel;
use Illuminate\Http\Request;
 
class BengkelController extends Controller
{
    public function index(Request $request)
    {
        $query = Bengkel::query();
 
        // Filter pencarian
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%')
                  ->orWhere('specialization', 'like', '%' . $request->search . '%');
        }
 
        $bengkels = $query->orderByDesc('rating')->get();
        return view('bengkel.index', compact('bengkels'));
    }
 
    public function show($id)
    {
        $bengkel = Bengkel::findOrFail($id);
        return view('bengkel.show', compact('bengkel'));
    }
}