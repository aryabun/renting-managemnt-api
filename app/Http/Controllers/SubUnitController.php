<?php
namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\SubUnit;
use Illuminate\Http\Request;

class SubUnitController extends Controller
{
    public function index(Request $request, Property $property)
    {
        $this->authorize('viewAny', [SubUnit::class, $property]);
        return response()->json($property->units);
    }
    public function store(Request $request, Property $property)
    {
        $this->authorize('create', [SubUnit::class, $property]); // blocks management team

        $data = $request->validate(['name' => 'required|string']);
        $unit = $property->units()->create($data);

        return response()->json($unit, 201);
    }

    public function update(Request $request, SubUnit $unit)
    {
        $this->authorize('update', $unit); // allows management team

        $unit->update($request->validate(['status' => 'sometimes|string']));
        return response()->json($unit);
    }

    public function destroy(Request $request, SubUnit $unit)
    {
        $this->authorize('delete', $unit); // blocks management team

        $unit->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
