<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureCare Medical Center | Doctor Details</title>

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

        .details-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid #e6eee8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
            max-width: 850px;
        }

        .details-card h2 {
            font-size: 19px;
            margin-bottom: 25px;
        }

        .detail-item {
            padding: 18px 0;
            border-bottom: 1px solid #edf1ee;
        }

        .detail-item:last-of-type {
            border-bottom: none;
        }

        .detail-item small {
            display: block;
            color: #758379;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .detail-item strong {
            font-size: 15px;
            color: #26352b;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .edit-btn {
            background: #146b45;
            color: white;
            padding: 13px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .edit-btn:hover {
            background: #21865a;
        }

        .back-btn {
            background: #edf3ef;
            color: #146b45;
            padding: 13px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
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
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">Medi<span>care</span></div>

        <h4>MAIN MENU</h4>

        <a href="{{ route('dashboard') }}">🏠 Dashboard</a>

        <a href="{{ route('patients.index') }}">👥 Patients</a>

        <a href="{{ route('doctors.index') }}" class="active">👨‍⚕️ Doctors</a>

        <a href="#" title="Coming soon">📅 Appointments</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">↪ Logout</button>
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

            <h1>Doctor Details</h1>

            <p>View complete information about this medical professional.</p>

        </section>

        <section class="details-card">

            <h2>Doctor Information</h2>

            <div class="detail-item">
                <small>Doctor ID</small>
                <strong>#{{ $doctor->id }}</strong>
            </div>

            <div class="detail-item">
                <small>Doctor's Name</small>
                <strong>{{ $doctor->name }}</strong>
            </div>

            <div class="detail-item">
                <small>Specialization</small>
                <strong>{{ $doctor->specialization }}</strong>
            </div>

            <div class="detail-item">
                <small>Contact Number</small>
                <strong>{{ $doctor->contact_number }}</strong>
            </div>

            <div class="detail-item">
                <small>Email Address</small>
                <strong>{{ $doctor->email }}</strong>
            </div>

            <div class="buttons">

                <a href="{{ route('doctors.edit', $doctor->id) }}"
                   class="edit-btn">
                    Edit Doctor
                </a>

                <a href="{{ route('doctors.index') }}"
                   class="back-btn">
                    Back to Doctors
                </a>

            </div>

        </section>

    </main>

</div>

</body>
</html>