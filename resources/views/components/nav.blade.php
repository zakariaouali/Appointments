<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
    <style>
        /* Sidebar Container */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: 0.3s;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding-left: 0px;
        }

        /* Sidebar Header */
        .sidebar-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar-header img {
            width: 95%; /* Adjust width */
            height: auto; /* Maintain aspect ratio */
            object-fit: contain; /* Ensures the image fits well */      
        }

        /* Sidebar Navigation */
        .nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav li {
            margin-bottom: 10px; /* Reduced the space between items */
        }

        /* Navigation Links */
        .nav li a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #ecf0f1;
            padding: 12px 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s ease;
            box-sizing: border-box;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Added shadow */
        }

        .nav li a i {
            font-size: 20px;
            margin-right: 15px;
        }

        /* Hover Effects */
        .nav li a:hover {
            background-color: #007bff;
            padding-left: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
        }

        .nav li a.active {
            background-color: #f39c12;
        }

        .nav li a.active i {
            color: #fff;
        }

        /* Sub-Menu (Optional) */
        .nav li ul {
            list-style: none;
            padding-left: 20px;
        }

        .nav li ul li {
            margin-bottom: 10px;
        }

        .logout-container {
            position: absolute;
            bottom: 20px;
            width: 100%;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff; /* White text color */
            padding: 15px 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s ease;
            box-sizing: border-box;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #e74c3c;  /* Red background by default */
        }

        /* Hover Effects */
        .logout-btn:hover {
            background-color: #c0392b;  /* Darker red on hover */
            padding-left: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
        }

        .logout-btn i {
            font-size: 20px;
            margin-right: 10px; /* Adjust spacing for the icon */
        }

        /* Mobile Responsiveness */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 220px;
                padding-top: 20px;
            }

            .sidebar-header h2 {
                font-size: 18px;
            }

            .nav li a {
                font-size: 14px;
                padding: 10px 15px;
            }

            .nav li a i {
                font-size: 18px;
            }
        }

    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/DrLogo.png') }}" alt="Doctor Logo">
        </div>
        <nav class="nav">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
                <li>
                    <a href="{{ route('admin.appointments.index') }}"><i class="fa fa-calendar-check"></i> Appointments Management</a>
                </li>
                <li>
                    <a href="{{ route('admin.appointments.create') }}"><i class="fa fa-calendar-plus"></i> Add Appointment</a>
                </li>
                <li><a href="{{ route('admin.patients.index') }}"><i class="fa fa-users"></i> Patients List</a></li>
                <li><a href="{{ route('admin.patients.create') }}"><i class="fa fa-user-plus"></i>Add Patient</a></li>
                <li><a href="{{ route('admin.appointments.index') }}"><i class="fa fa-user-cog"></i> Profile</a></li>
            </ul>
        </nav>
    
        <!-- Logout Button in a div for separation -->
        <div class="logout-container">
            <a href="{{ route('admin.logout') }}" class="logout-btn">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</body>
</html>
