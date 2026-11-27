<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Display all doctors
    public function index()
    {
        $doctors = Doctor::all();

        return view('doctors.index', compact('doctors'));
    }

    // Show the form for creating a doctor
    public function create()
    {
        return view('doctors.create');
    }

    // Store a new doctor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
        ]);

        Doctor::create($validated);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor added successfully!');
    }

    // Display a specific doctor
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('doctors.show', compact('doctor'));
    }

    // Show the edit form
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('doctors.edit', compact('doctor'));
    }

    // Update doctor information
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
        ]);

        $doctor->update($validated);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor updated successfully!');
    }

    // Delete a doctor
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor deleted successfully!');
    }
}