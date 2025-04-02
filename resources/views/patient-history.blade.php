<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/patient-history.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-left: 250px; /* Adjust this value to match the width of your nav */
            padding: 30px;
            max-width: 1200px;
            margin-top: 50px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            text-align: center;
        }

        .table td {
            font-size: 14px;
            color: #555;
            text-align: center;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .status-label {
            padding: 6px 12px;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status-pending {
            background-color: #FFA500; /* Orange */
            border: 2px solid #FFA500;
        }

        .status-completed {
            background-color: #006400; /* Dark Green */
            border: 2px solid #006400;
        }

        .status-approved {
            background-color: #90EE90; /* Light Green */
            border: 2px solid #90EE90;
        }

        .status-cancelled {
            background-color: #FF0000; /* Red */
            border: 2px solid #FF0000;
        }

        @media screen and (max-width: 768px) {
            .container {
                margin-left: 0;
                padding: 15px;
            }

            h1 {
                font-size: 28px;
            }

            .table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <x-nav/>

    <div class="container">
        <h1>Appointment History for {{ $patient->full_name }}</h1>

        <table class="table">
            <thead>
                <tr>
                    <th><i class="fa fa-calendar-alt"></i> Date</th>
                    <th><i class="fa fa-clock"></i> Time</th>
                    <th><i class="fa fa-stethoscope"></i> Specialty</th>
                    <th><i class="fa fa-info-circle"></i> Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->desired_date }}</td>
                        <td>{{ $appointment->desired_time }}</td>
                        <td>{{ $appointment->specialty }}</td>
                        <td>
                            <span class="status-label status-{{ strtolower($appointment->status) }}">
                                {{ $appointment->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>