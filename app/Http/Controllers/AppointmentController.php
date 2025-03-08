<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Patients;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Store a new appointment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'desired_date' => 'required|date',
            'desired_time' => 'required|date_format:H:i',
            'specialty' => 'required|string',
            'comments' => 'nullable|string',
        ]);

    // Check if the patient already exists
    $patient = Patients::where('full_name', $validated['full_name'])->first();

    if (!$patient) {
        // Create a new patient if they don't exist
        $patient = Patients::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);
    }

    
        // Create Appointment and associate it with the patient
    $appointment = Appointment::create([
        'full_name' => $validated['full_name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'desired_date' => $validated['desired_date'],
        'desired_time' => $validated['desired_time'],
        'specialty' => $validated['specialty'],
        'comments' => $validated['comments'],
        'status' => 'pending', // Default status is pending
        'patient_id' => $patient->id, // Associate the appointment with the patient
    ]);

    
        return response()->json(['message' => 'Appointment created successfully!', 'data' => $appointment], 200);
    }

    public function checkPhone(Request $request)
    {
        $phone = $request->query('phone');
        $patient = Patients::where('phone', $phone)->first();

        if ($patient) {
            return response()->json(['exists' => true, 'full_name' => $patient->full_name]);
        }

        return response()->json(['exists' => false]);
    }

    public function index(Request $request)
    {
        $query = Appointment::query();

         // Check for any expired pending appointments and update their status
         $this->checkAndCancelExpiredAppointments();
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
           if ($request->status !== 'completed') {
            $query->where('status', $request->status);
        } else {
            // Show only completed appointments when 'completed' filter is selected
            $query->where('status', 'completed');
        }
        }
    
        // Filter by date
        if ($request->has('date')) {
            if ($request->date == 'today') {
                $query->whereDate('desired_date', Carbon::today());
            } elseif ($request->date == 'this_week') {
                $query->whereBetween('desired_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($request->date == 'this_month') {
                $query->whereMonth('desired_date', Carbon::now()->month);
            }
        }
    
        $appointments = $query->paginate(10);
    
        return view('appointments', compact('appointments'));
    }


    


public function show($id)
{

    // Ensure pending appointments with expired dates are cancelled
    $this->checkAndCancelExpiredAppointments();

    // Fetch the appointment by its ID
    $appointment = Appointment::findOrFail($id);

    // Pass the appointment to the view
    return view('show', compact('appointment'));
}



public function edit($id)
{
    $appointment = Appointment::findOrFail($id);  // Find the appointment by its ID
    return view('edit', compact('appointment'));  // Return the view with the appointment data
}



public function update(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->update($request->all());  // Update the appointment with the new data

        // Check and update status if needed
        $this->checkAndCancelExpiredAppointments();

    return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully!');
}





 // Delete Appointment
 public function destroy($id)
 {
     $appointment = Appointment::findOrFail($id);

     // Optionally, add additional checks before deleting
     $appointment->delete();

     return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted successfully.');
 }







private function checkAndCancelExpiredAppointments()
    {
        $today = Carbon::today();

        // Update the status of pending appointments where the date has passed
        Appointment::where('status', 'Pending')
                  ->whereDate('desired_date', '<', $today)
                  ->update(['status' => 'Cancelled']);
    }






    public function adminStore(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:20',
            'desired_date' => 'required|date', 
            'desired_time' => 'required',
            'specialty' => 'required|string|max:255',
            'comments' => 'nullable|string',
        ]);

        // Check if the patient already exists by phone number
        $patient = Patients::where('phone', $validated['phone'])->first();

        if ($patient) {
            // If the phone number exists, check if the full name matches
            if ($patient->full_name !== $validated['full_name']) {
                // If the full name does not match, return with an error message
                return response()->json(['message' => 'This phone number belongs to someone else. Please check the name or phone number.'], 400);
            }
        } else {
            // Create a new patient if they don't exist
            $patient = Patients::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'birthdate' => null, // Set birthdate to null or handle it as needed
            ]);
        }

        // Create Appointment and associate it with the patient
        $appointment = Appointment::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'desired_date' => $validated['desired_date'], // Make sure this is passed correctly
            'desired_time' => $validated['desired_time'],
            'specialty' => $validated['specialty'],
            'comments' => $validated['comments'],
            'status' => 'pending', // Default status is pending
            'patient_id' => $patient->id, // Associate the appointment with the patient
        ]);

        // Return success response
        return response()->json(['message' => 'Appointment created successfully!']);
    }

public function create()
{
    return view('create-rv');
} 
}