<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patients;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Validate the email and password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if the user exists and is activated
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->is_activated) {
            return back()->withErrors(['email' => 'Your account is not activated yet. Please wait until the admin accepts your registration request.']);
        }

        // Check if the credentials are correct
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If login is successful, redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // If the credentials are incorrect, send back with an error
        return back()->withErrors(['email' => 'Email or Password are incorrect']);
    }


        
    public function dashboard()
{
    $upcomingAppointments = Appointment::where('desired_date', '>', now())->count();
    $pastAppointments = Appointment::where('desired_date', '<', now())->count();
    $pendingAppointments = Appointment::where('status', 'pending')->count();

    $todayAppointments = Appointment::whereDate('desired_date', today())->count();
    $totalPatients = Patients::count();
    $mostRequestedSpecialty = Appointment::select('specialty')
                                         ->groupBy('specialty')
                                         ->orderByRaw('COUNT(specialty) DESC')
                                         ->limit(1)
                                         ->pluck('specialty')
                                         ->first();

    $notifications = [
        'New appointment request.',
        'New user signed up.',
        'Appointment canceled.'
    ];

    $appointmentsByMonth = Appointment::selectRaw('MONTH(desired_date) as month, COUNT(*) as count')
                                      ->groupBy('month')
                                      ->pluck('count', 'month')
                                      ->toArray();

    $appointmentsBySpecialty = Appointment::select('specialty', DB::raw('count(*) as total'))
                                      ->groupBy('specialty')
                                      ->pluck('total', 'specialty')
                                      ->toArray();
                                  

    $appointmentsByStatus = Appointment::select('status', DB::raw('count(*) as total'))
                                       ->groupBy('status')
                                       ->pluck('total', 'status')
                                       ->toArray();

    $appointmentsByDayOfWeek = Appointment::selectRaw('DAYOFWEEK(desired_date) as day, COUNT(*) as count')
                                          ->groupBy('day')
                                          ->pluck('count', 'day')
                                          ->toArray();

                                      

    return view('dashboard', compact(
        'upcomingAppointments', 
        'pastAppointments', 
        'pendingAppointments', 
        'todayAppointments', 
        'totalPatients', 
        'mostRequestedSpecialty', 
        'notifications', 
        'appointmentsByMonth',
        'appointmentsBySpecialty',
        'appointmentsByStatus',
        'appointmentsByDayOfWeek'
        ));
}
    public function appointments()
{
    $appointments = Appointment::all(); // Get all appointments (you can use pagination if needed)

    return view('appointments', compact('appointments'));
}
}