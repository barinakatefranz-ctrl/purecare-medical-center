<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare | Patients</title>

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
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        h1 {
            color: #146b45;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            background: #146b45;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .button:hover {
            background: #21865a;
        }

        .back {
            background: #64748b;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            color: #146b45;
            background: #f4f8f5;
        }

        .delete {
            background: #dc3545;
        }

        .alert {
            padding: 12px;
            background: #dff5e8;
            color: #176b3a;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Patient Management</h1>

        <a href="{{ route('patients.create') }}" class="button">
            + Add Patient
        </a>
    </div>

    <a href="{{ route('dashboard') }}" class="button back">
        Back to Dashboard
    </a>

    <br><br>

    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->age }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->contact_number }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>
                            <form action="{{ route('patients.destroy', $patient->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this patient?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="button delete">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            No patients registered yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

</body>
</html>
