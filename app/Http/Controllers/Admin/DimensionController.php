<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dimension;
use Illuminate\Http\Request;

class DimensionController extends Controller
{
    /**
     * Display a listing of the dimensions.
     */
    public function index()
    {
        $dimensions = Dimension::paginate(10);
        return view('admin.dimensions.index', compact('dimensions'));
    }

    /**
     * Store a newly created dimension in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:dimensions,name',
            'description' => 'nullable|string',
        ]);

        Dimension::create($request->only('name', 'description'));

        return redirect()->route('dimensions.index')->with('success', 'Dimension created successfully.');
    }

    /**
     * Update the specified dimension in storage.
     */
    public function update(Request $request, Dimension $dimension)
    {
        $request->validate([
            'name' => 'required|unique:dimensions,name,' . $dimension->id,
            'description' => 'nullable|string',
        ]);

        $dimension->update($request->only('name', 'description'));

        return redirect()->route('dimensions.index')->with('success', 'Dimension updated successfully.');
    }

    /**
     * Remove the specified dimension from storage.
     */
    public function destroy(Dimension $dimension)
    {
        $dimension->delete();
        return redirect()->route('dimensions.index')->with('success', 'Dimension deleted successfully.');
    }
}