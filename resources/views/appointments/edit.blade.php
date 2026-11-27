<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare | Edit Appointment</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f8f5;
            color: #26352b;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #146b45;
            padding: 30px 20px;
            color: white;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 45px;
        }

        .logo span {
            color: #a8e6c2;
        }

        .sidebar a {
            display: block;
            padding: 14px 18px;
            margin-bottom: 10px;
            color: #e3f2e9;
            text-decoration: none;
            border-radius: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #21865a;
        }

        .logout {
            margin-top: 35px;
            background: #21865a;
            border: none;
            color: white;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
        }

        .main {
            flex: 1;
            padding: 30px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            gap: 15px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            background: #146b45;
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #718078;
        }

        .card {
            background: white;
            padding: 30px;
            border: 1px solid #e6eee8;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            max-width: 850px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #dce5de;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #146b45;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #146b45;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background: #21865a;
        }

        .cancel {
            background: #718078;
            margin-left: 8px;
        }

        .cancel:hover {
            background: #526359;
        }

        .error {
            color: #dc4545;
            font-size: 13px;
            margin-top: 6px;
        }

        .alert {
            background: #ffe3e3;
            color: #b42323;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        @media (max-width: 650px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>

<div class="dashboard">

    <aside class="sidebar">

        <div class="logo">Medi<span>care</span></div>

        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('patients.index') }}">Patients</a>
        <a href="{{ route('doctors.index') }}">Doctors</a>
        <a href="{{ route('appointments.index') }}" class="active">Appointments</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>

    </aside>

    <main class="main">

        <div class="topbar">

            <h2>Appointment Management</h2>

            <div class="profile">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <span>{{ auth()->user()->name ?? 'Administrator' }}</span>
            </div>

        </div>

        <div class="welcome">
            <h1>Edit Appointment</h1>
            <p>Update the appointment information below.</p>
        </div>

        <div class="card">

            <h3 style="margin-bottom: 25px;">Appointment Information</h3>

            @if($errors->any())
                <div class="alert">
                    Please correct the errors below.
                </div>
            @endif

            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="patient_id">Select Patient</label>

                    <select name="patient_id" id="patient_id" required>
                        <option value="">-- Select Patient --</option>

                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}"
                                {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('patient_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="doctor_id">Select Doctor</label>

                    <select name="doctor_id" id="doctor_id" required>
                        <option value="">-- Select Doctor --</option>

                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}"
                                {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }} - {{ $doctor->specialization }}
                            </option>
                        @endforeach

                    </select>

                    @error('doctor_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="appointment_date">Appointment Date</label>

                        <input type="date"
                               name="appointment_date"
                               id="appointment_date"
                               value="{{ old('appointment_date', $appointment->appointment_date) }}"
                               required>

                        @error('appointment_date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="appointment_time">Appointment Time</label>

                        <input type="time"
                               name="appointment_time"
                               id="appointment_time"
                               value="{{ old('appointment_time', substr($appointment->appointment_time, 0, 5)) }}"
                               required>

                        @error('appointment_time')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="status">Appointment Status</label>

                    <select name="status" id="status" required>
                        <option value="Scheduled" {{ old('status', $appointment->status) == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="Completed" {{ old('status', $appointment->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ old('status', $appointment->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>

                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reason">Reason for Appointment</label>

                    <textarea name="reason"
                              id="reason"
                              placeholder="Enter reason for appointment...">{{ old('reason', $appointment->reason) }}</textarea>

                    @error('reason')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Update Appointment</button>

                <a href="{{ route('appointments.index') }}" class="btn cancel">
                    Cancel
                </a>

            </form>

        </div>

    </main>

</div>

</body>
</html>