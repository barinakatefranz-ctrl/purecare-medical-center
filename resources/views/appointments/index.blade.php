<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureCare Medical Center | Appointments</title>

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
            padding: 25px;
            border: 1px solid #e6eee8;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            gap: 15px;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            background: #146b45;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #21865a;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #edf1ee;
            font-size: 14px;
        }

        th {
            background: #f8faf8;
            color: #526359;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .action-btn {
            padding: 7px 11px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 12px;
        }

        .view {
            background: #2879bd;
        }

        .edit {
            background: #d99b24;
        }

        .delete {
            background: #dc4545;
            border: none;
            cursor: pointer;
            padding: 7px 11px;
            border-radius: 5px;
            color: white;
        }

        .success {
            background: #d9f4e3;
            color: #146b45;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e3f2e9;
            color: #146b45;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #718078;
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

            .card-header {
                align-items: flex-start;
                flex-direction: column;
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
            <h1>Appointments</h1>
            <p>Manage patient appointments and schedules.</p>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                <h3>Appointment List</h3>

                <a href="{{ route('appointments.create') }}" class="btn">
                    + Add New Appointment
                </a>
            </div>

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->id }}</td>

                                <td>
                                    {{ $appointment->patient?->name ?? 'Patient unavailable' }}
                                </td>

                                <td>
                                    {{ $appointment->doctor?->name ?? 'Doctor unavailable' }}
                                </td>

                                <td>{{ $appointment->appointment_date }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </td>

                                <td>
                                    <span class="status">
                                        {{ $appointment->status }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">

                                        <a href="{{ route('appointments.show', $appointment->id) }}"
                                           class="action-btn view">View</a>

                                        <a href="{{ route('appointments.edit', $appointment->id) }}"
                                           class="action-btn edit">Edit</a>

                                        <form action="{{ route('appointments.destroy', $appointment->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this appointment?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="delete">
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">
                                    No appointments found. Click Add New Appointment to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>