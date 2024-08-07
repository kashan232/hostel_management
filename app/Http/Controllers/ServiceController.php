<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function services_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.services_managment.service_create', []);
        } else {
            return redirect()->back();
        }
    }

    public function store_services(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();

            // Create the Service record
            $Service = Service::create([
                'admin_id' => $admin_id,
                'service_name' => $request->service_name, // Ensure this is a string type in the database
                'amount' => $request->amount,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('Service-added', 'Service Created Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function services()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $services = Service::where('admin_id', '=', $admin_id)->get();
            // dd($services);
            return view('admin_panel.services_managment.services', [
                'services' => $services,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
