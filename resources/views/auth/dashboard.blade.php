<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureCare Medical Center | Dashboard</title>

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

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #146b45;
            color: white;
            padding: 30px 20px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 45px;
        }

        .logo span {
            color: #a7e6bd;
        }

        .sidebar h4 {
            color: #b9ddc8;
            font-size: 12px;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #e3f2e9;
            padding: 14px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #21865a;
            color: white;
        }

        /* Main Content */
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

        .topbar h2 {
            color: #146b45;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-info {
            text-align: right;
        }

        .profile-info strong {
            display: block;
        }

        .profile-info small {
            color: #7a897f;
        }

        .avatar {
            background: #d7f0df;
            color: #146b45;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #7a897f;
        }

        /* Statistics Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e6eee8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .card .icon {
            font-size: 27px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 14px;
            color: #758379;
            margin-bottom: 12px;
        }

        .card h1 {
            font-size: 30px;
            color: #146b45;
        }

        /* Appointments */
        .appointments {
            background: white;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e6eee8;
        }

        .appointments h2 {
            font-size: 19px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #edf1ee;
            font-size: 14px;
        }

        th {
            color: #758379;
            background: #f8faf8;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #87948b;
        }

        .logout {
            margin-top: 35px;
            width: 100%;
            border: none;
            background: #21865a;
            color: white;
            padding: 13px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout:hover {
            background: #0e5838;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .profile-info {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="logo"> PureCare<span>Medical Center</span></div>

        <h4>MAIN MENU</h4>

        <a href="{{ route('dashboard') }}" class="active">
            🏠 Dashboard
        </a>

        <a href="{{ route('patients.index') }}">
             👥 Patients
        </a>

       <a href="{{ route('doctors.index') }}">
            👨‍⚕️ Doctors
        </a>

       <a href="{{ route('appointments.index') }}">
            📅 Appointments
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">
                ↪ Logout
            </button>
        </form>

    </aside>

    <!-- Main Content -->
    <main class="main">

        <header class="topbar">

            <h2>Dashboard</h2>

            <div class="profile">

                <div class="profile-info">
                    <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                    <small>Administrator</small>
                </div>

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

            </div>

        </header>

        <!-- Welcome Section -->
        <section class="welcome">

            <h1>Welcome to PureCare Medical Center!</h1>

            <p>Here's an overview of your hospital management system.</p>

        </section>

        <!-- Dashboard Cards -->
       
<!-- Dashboard Cards -->
        <section class="cards">

            <div class="card">
                <div class="icon">👥</div>
                <h3>Total Patients</h3>
                <h1>{{ $totalPatients }}</h1>
            </div>

            <div class="card">
                <div class="icon">👨‍⚕️</div>
                <h3>Total Doctors</h3>
                <h1>{{ $totalDoctors }}</h1>
            </div>

            <div class="card">
                <div class="icon">📅</div>
                <h3>Total Appointments</h3>
                <h1>{{ $totalAppointments }}</h1>
            </div>

        </section>


        <!-- Recent Appointments -->
        <section class="appointments">

            <h2>Recent Appointments</h2>

            <table>

                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                
                <tbody>

                    @forelse ($recentAppointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->name ?? 'N/A' }}</td>

                            <td>{{ $appointment->doctor->name ?? 'N/A' }}</td>

                            <td>{{ $appointment->appointment_date }}</td>

                            <td>{{ ucfirst($appointment->status) }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="empty">
                                No appointments available yet.
                            </td>
                        </tr>
                    @endforelse

</tbody>


            </table>

        </section>

    </main>

</div>

</body>
</html>
