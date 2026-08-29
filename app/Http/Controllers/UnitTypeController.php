<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    //
    protected UnitType $unit_type;
    public function __construct(UnitType $unit_type)
    {
        $this->unit_type = $unit_type;
    }
    public function index(){
        $unit_types = $this->unit_type->all();
        return response()->json($unit_types);
    }
}
