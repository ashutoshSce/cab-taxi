<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Driver $driver
     * @return boolean
     */
    public function availability(Request $request,  $id)
    {
        // @Todo Take this from loggedInSession instead of ID
        $driver = Driver::findOrFail($id);
        $driver->status = !$driver->status;
        $driver->save();

        return $driver;
    }
}
