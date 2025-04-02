<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Content container */
        .container {
            margin-left: 250px; /* Make space for the sidebar */
            padding: 30px;
            max-width: 1200px;
            margin-top: 50px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px); /* Adjust width considering the sidebar */
        }

        h1, h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #007bff;
    color: white;
    font-size: 16px;
    text-align: center;
}

td {
    font-size: 14px;
    color: #555;
    text-align: center;
    font-weight: bold;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Button styling */
button {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    margin-right: 5px;
    transition: background-color 0.3s ease;
}

button[name="status"][value="accepted"] {
    background-color: #4CAF50;
    color: white;
}

button[name="status"][value="accepted"]:hover {
    background-color: #45a049;
}

button[name="status"][value="denied"] {
    background-color: #f44336;
    color: white;
}

button[name="status"][value="denied"]:hover {
    background-color: #e53935;
}

        /* Status message styling */
        .status-message {
            background-color: #e7f3fe;
            color: #31708f;
            padding: 10px;
            border: 1px solid #bce8f1;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Navigation bar styling */
        .navbar {
            background-color: #4e73df;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 0 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Mobile Responsiveness */
        @media screen and (max-width: 768px) {
            .container {
                margin-left: 0;
                padding: 15px;
            }

            h1, h2 {
                font-size: 28px;
            }

            table {
                font-size: 12px;
            }

            .sidebar {
                width: 200px;
                position: relative;
            }

            .sidebar nav ul li a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <x-nav/>

    <div class="container">
        <h1>Profile</h1>
        <h2>Pending User Registrations</h2>
        @if (session('status'))
            <div class="status-message">{{ session('status') }}</div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($pendingUsers->isEmpty())
                <tr>
                    <td colspan="3" class="text-center" style="padding: 20px;">
                        <div style="color: #888; font-size: 18px; font-weight: bold;">
                            <i class="fa fa-user-times" style="font-size: 30px; color: #b4b4b4;"></i>
                            <p>No pending user registrations found</p>
                        </div>
                    </td>
                </tr>
                @endif
                @foreach ($pendingUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form method="POST" action="{{ route('activate-user', $user->id) }}">
                                @csrf
                                <button type="submit" name="status" value="accepted">Accept</button>
                                <button type="submit" name="status" value="denied">Deny</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>