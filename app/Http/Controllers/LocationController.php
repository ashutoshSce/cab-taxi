<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function driver(Request $request,  $id)
    {
        // @Todo Take this from loggedInSession instead of ID
        $driver = Driver::findOrFail($id);

        return $driver;
    }
}
