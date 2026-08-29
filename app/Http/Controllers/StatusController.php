<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    //
    protected Status $status;
    public function __construct(Status $status)
    {
        $this->status = $status;
    }
    public function index(){
        $statuses = $this->status->all();
        return response()->json($statuses);
    }
}
