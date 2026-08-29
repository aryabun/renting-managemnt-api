<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //
    protected PropertyType $propety_type;
    public function __construct(PropertyType $propety_type)
    {
        $this->propety_type = $propety_type;
    }
    public function index(){
        $propety_types = $this->propety_type->all();
        return response()->json($propety_types);
    }

}
