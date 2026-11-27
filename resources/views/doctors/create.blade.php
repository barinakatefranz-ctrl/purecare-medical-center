<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare | Add Doctor</title>

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

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid #e6eee8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
            max-width: 850px;
        }

        .form-card h2 {
            font-size: 19px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dce6df;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #146b45;
        }

        .error {
            color: #c62828;
            font-size: 13px;
            margin-top: 7px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .submit-btn {
            background: #146b45;
            color: white;
            border: none;
            padding: 13px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .submit-btn:hover {
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

            <h1>Add New Doctor</h1>

            <p>Register a new medical professional in Medicare.</p>

        </section>

        <section class="form-card">

            <h2>Doctor Information</h2>

            <form action="{{ route('doctors.store') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label>Doctor's Name</label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter doctor's full name"
                           required>

                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Specialization</label>

                    <input type="text"
                           name="specialization"
                           value="{{ old('specialization') }}"
                           placeholder="Enter specialization"
                           required>

                    @error('specialization')
                        <p class="error">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Contact Number</label>

                    <input type="text"
                           name="contact_number"
                           value="{{ old('contact_number') }}"
                           placeholder="Enter contact number"
                           required>

                    @error('contact_number')
                        <p class="error">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Email Address</label>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Enter email address"
                           required>

                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror

                </div>

                <div class="buttons">

                    <button type="submit" class="submit-btn">
                        Register Doctor
                    </button>

                    <a href="{{ route('doctors.index') }}" class="back-btn">
                        Cancel
                    </a>

                </div>

            </form>

        </section>

    </main>

</div>

</body>
</html>