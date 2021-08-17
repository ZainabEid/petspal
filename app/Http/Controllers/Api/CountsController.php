<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class CountsController extends Controller
{
    public function index()
    {
        $clinics_count = Clinic::count();

        return response()->json([
            'counts' => $clinics_count
        ]);
    }
}
