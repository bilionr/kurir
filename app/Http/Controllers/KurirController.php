<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;

class KurirController extends Controller
{
    public function index(Request $request)
    {
        $query = Kurir::query();

        // Filter berdasarkan level (?level=2,3)
        if ($request->has('level')) {
            $levels = explode(',', $request->level);
            $query->whereIn('level', $levels);
        }

        // Pencarian nama fleksibel (?search=budi+agung)
        if ($request->has('search')) {
            $searchTerms = explode(' ', $request->search);
            foreach ($searchTerms as $term) {
                $query->where('nama', 'like', '%' . $term . '%');
            }
        }

        // Sorting
        // Opsi override default sort
        if ($request->get('sort') === 'date') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('nama', 'asc');
        }

        // Pagination
        $kurirs = $query->paginate(10);

        return response()->json($kurirs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string',
            'no_telp'  => 'required|string',
            'plat_kendaraan'  => 'nullable|string',
            'level'         => 'required|integer',
        ]);

        $kurir = Kurir::create($validated);

        return response()->json([
            'message' => 'kurir created successfully',
            'data'    => $kurir
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($kurir);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurir $kurir)
    {
        $validated = $request->validate([
            'nama'          => 'sometimes|required|string',
            'no_telp'  => 'sometimes|required|string',
            'plat_kendaraan'  => 'nullable|string',
            'level'         => 'sometimes|required|integer|between:1,5',
        ]);

        $kurir->update($validated);

        return response()->json([
            'message' => 'kurir updated successfully',
            'data'    => $kurir
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurir $kurir)
    {
        $kurir->delete();

        return response()->json([
            'message' => 'kurir deleted successfully'
        ], 204);
    }
}
