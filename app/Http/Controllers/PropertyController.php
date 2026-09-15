<?php
namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    protected Property $property;
    public function __construct(Property $property)
    {
        $this->property = $property;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $properties = $user->isSuperAdmin()
            ? $this->property->with('units')->get()
            : $this->property->with('units')
            ->where(function ($q) use ($user) {
                $q->where('owner_id', $user->id)
                    ->orWhereHas('members', fn($q2) => $q2->where('user_id', $user->id));
            })
            ->get();

        return response()->json($properties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        try {
            $data             = $request->validated();
            $data['owner_id'] = Auth::id();
            $property         = $this->property->create($data);

            return response()->json([
                'status'  => "Success!",
                'data'    => $property,
                'message' => 'Property Successfully Created!',
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->errorInfo ?: 'Something went wrong!',
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return response()->json([
            'data' => $property->load('units'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
    public function invite(Request $request, Property $property)
    {
        $this->authorize('invite', $property);

        $data    = $request->validate(['email' => 'required|email|exists:users,email']);
        $invitee = User::where('email', $data['email'])->firstOrFail();

        $property->members()->syncWithoutDetaching([
            $invitee->id => ['role' => 'manager'],
        ]);

        return response()->json(['message' => 'Management team member invited!']);
    }
}
