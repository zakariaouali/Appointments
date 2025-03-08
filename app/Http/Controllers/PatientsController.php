<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index(Request $request)
    {
        $query = Patients::All();

        $patients = $query->All();
    
        return view('patients-list', compact('patients'));
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

    public function show($id)
    {
        // Fetch the patient by its ID
        $patient = Patients::findOrFail($id);

        // Pass the appointment to the view
        return view('patient-view', compact('patient'));
    }


    public function create()
    {
        return view('patient-add');
    }

    // Store the patient data in the database
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Check if the patient already exists by phone number
        $existingPatient = Patients::where('phone', $validated['phone'])->first();

        if ($existingPatient) {
            // If the phone number exists, check if the full name matches
            if ($existingPatient->full_name !== $validated['full_name']) {
                // If the full name does not match, return with an error message
                return redirect()->back()->with('error', 'This phone number belongs to someone else. Please check the name or phone number.');
            }
        } else {
            // Create a new patient if they don't exist
            Patients::create($validated);
        }

        // Redirect back with a success message
        return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully!');
    }
    
    public function editPatient($id)
    {
        $patient = Patients::findOrFail($id);
        return view('patient-edit', compact('patient'));
    }

    public function updatePatient(Request $request, $id)
    {
        $patient = Patients::findOrFail($id);
        $patient->update($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
    {
        $patient = Patients::findOrFail($id);
        $patient->delete();

        return redirect()->route('admin.patients.index')->with('success', 'Patient deleted successfully.');
    }

    public function history($id)
    {
        $patient = Patients::findOrFail($id);
        $appointments = $patient->appointments;

        return view('patient-history', compact('patient', 'appointments'));
    }

}