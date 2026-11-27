<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureCare Medical Center | Appointment Details</title>

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

        .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .detail-item {
            border-bottom: 1px solid #edf1ee;
            padding-bottom: 15px;
        }

        .detail-item label {
            display: block;
            color: #718078;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .detail-item p {
            font-size: 16px;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            background: #e3f2e9;
            color: #146b45;
            font-size: 13px;
        }

        .reason {
            grid-column: 1 / -1;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #146b45;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            margin-top: 25px;
        }

        .btn:hover {
            background: #21865a;
        }

        .back {
            background: #718078;
            margin-left: 8px;
        }

        .back:hover {
            background: #526359;
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

            .details {
                grid-template-columns: 1fr;
            }

            .reason {
                grid-column: auto;
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
            <h1>Appointment Details</h1>
            <p>View the complete information about this appointment.</p>
        </div>

        <div class="card">

            <h3 style="margin-bottom: 25px;">Appointment Information</h3>

            <div class="details">

                <div class="detail-item">
                    <label>Appointment ID</label>
                    <p>#{{ $appointment->id }}</p>
                </div>

                <div class="detail-item">
                    <label>Appointment Status</label>
                    <p>
                        <span class="status">{{ $appointment->status }}</span>
                    </p>
                </div>

                <div class="detail-item">
                    <label>Patient Name</label>
                    <p>{{ $appointment->patient?->name ?? 'Patient unavailable' }}</p>
                </div>

                <div class="detail-item">
                    <label>Doctor Name</label>
                    <p>{{ $appointment->doctor?->name ?? 'Doctor unavailable' }}</p>
                </div>

                <div class="detail-item">
                    <label>Doctor Specialization</label>
                    <p>{{ $appointment->doctor?->specialization ?? 'Not available' }}</p>
                </div>

                <div class="detail-item">
                    <label>Appointment Date</label>
                    <p>{{ $appointment->appointment_date }}</p>
                </div>

                <div class="detail-item">
                    <label>Appointment Time</label>
                    <p>
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                    </p>
                </div>

                <div class="detail-item reason">
                    <label>Reason for Appointment</label>
                    <p>{{ $appointment->reason ?: 'No reason provided.' }}</p>
                </div>

            </div>

            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn">
                Edit Appointment
            </a>

            <a href="{{ route('appointments.index') }}" class="btn back">
                Back to Appointments
            </a>

        </div>

    </main>

</div>

</body>
</html>