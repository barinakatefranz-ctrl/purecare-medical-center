<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureCare Medical Center | Doctors</title>

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

        .sidebar {
            width: 250px;
            flex-shrink: 0;
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

        .main {
            flex: 1;
            min-width: 0;
            padding: 30px;
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

        .appointments {
            background: white;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e6eee8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 19px;
        }

        .add-btn {
            background: #146b45;
            color: white;
            padding: 11px 18px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .add-btn:hover {
            background: #21865a;
        }

        .success {
            background: #d7f0df;
            color: #146b45;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
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

        .action {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            margin: 2px;
        }

        .view {
            background: #e1f0e7;
            color: #146b45;
        }

        .edit {
            background: #fff2d8;
            color: #93620a;
        }

        .delete {
            background: #fde7e7;
            color: #b42323;
            border: none;
            cursor: pointer;
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

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .profile-info {
                text-align: left;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

         <div class="logo">PureCareMedical
            Center</div>

        <h4>MAIN MENU</h4>

        <a href="{{ route('dashboard') }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('patients.index') }}">
            👥 Patients
        </a>

        <a href="{{ route('doctors.index') }}" class="active">
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

    <main class="main">

        <header class="topbar">

            <h2>Doctor Management</h2>

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

        <section class="welcome">

            <h1>Manage Doctors</h1>

            <p>View and manage all registered doctors in Medicare.</p>

        </section>

        <section class="appointments">

            <div class="section-header">

                <h2>Registered Doctors</h2>

                <a href="{{ route('doctors.create') }}" class="add-btn">
                    + Add New Doctor
                </a>

            </div>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($doctors as $doctor)

                            <tr>
                                <td>{{ $doctor->id }}</td>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->specialization }}</td>
                                <td>{{ $doctor->contact_number }}</td>
                                <td>{{ $doctor->email }}</td>

                                <td>

                                    <a href="{{ route('doctors.show', $doctor->id) }}"
                                       class="action view">
                                        View
                                    </a>

                                    <a href="{{ route('doctors.edit', $doctor->id) }}"
                                       class="action edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('doctors.destroy', $doctor->id) }}"
                                          method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action delete"
                                                onclick="return confirm('Are you sure you want to delete this doctor?')">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="empty">
                                    No doctors registered yet.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</div>

</body>
</html>
