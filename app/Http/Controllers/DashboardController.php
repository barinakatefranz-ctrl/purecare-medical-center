<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();

        $recentAppointments = Appointment::with(['patient', 'doctor'])
            ->latest()
            ->take(5)
            ->get();

        return view('auth.dashboard', compact(
            'totalPatients',
            'totalDoctors',
            'totalAppointments',
            'recentAppointments'
        ));
    }
}