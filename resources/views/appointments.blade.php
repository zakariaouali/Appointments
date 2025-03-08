<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Filters section */
        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filters select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 200px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px;
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
            font-weight: bold

        }

        tr:hover {
            background-color: #f1f1f1;
        }

.action-btn {
    text-decoration: none;
    color: white;
    background-color: #007bff;
    padding: 10px 20px; /* Increased padding for better sizing */
    border-radius: 5px;
    font-weight: bold;
    margin-right: 15px; /* Increased margin for spacing between buttons */
    transition: background-color 0.3s ease;
    display: inline-block; /* Ensures buttons are aligned properly */
}

.action-btn:hover {
    background-color: #0056b3;
}
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            margin: 0 5px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        .actions {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.actions a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 16px;
    transition: 0.3s ease-in-out;
}

.btn-view {
    background-color: #4CAF50;
    color: white;
}

.btn-edit {
    background-color: #2196F3;
    color: white;
}

.actions a:hover {
    opacity: 0.8;
}
.status-label {
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    text-transform: capitalize;
}

.btn-delete {
            display: inline-block;
            width: 36px;
            height: 36px;
            border-radius: 6px;
            text-align: center;
            background-color: #F44336;
            color: white;
            font-size: 16px;
            transition: 0.3s ease-in-out;
            cursor: pointer;
        }

        .btn-delete:hover {
            opacity: 0.8;
        }

        /* Popup message */
        .popup-message {
            position: fixed;
            top: 10px;
            right: 35%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }


        /* Mobile Responsiveness */
        @media screen and (max-width: 768px) {
            .container {
                margin-left: 0;
                padding: 15px;
            }

            h1 {
                font-size: 28px;
            }

            table {
                font-size: 12px;
            }

            .filters {
                flex-direction: column;
            }

            .filters select {
                margin-bottom: 10px;
                width: 100%;
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
    <!-- Main Content -->
    <div class="container">
        <h1>Appointments</h1>

        <!-- Filters section -->
        <div class="filters">
            <!-- Example Filter Dropdowns -->
            <form method="GET" action="{{ route('admin.appointments.index') }}">
                <select name="status" onchange="this.form.submit()">
                    <option value="">Filter by Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>

                </select>
            
                <select name="date" onchange="this.form.submit()">
                    <option value="">Filter by Date</option>
                    <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="this_week" {{ request('date') == 'this_week' ? 'selected' : '' }}>This Week</option>
                    <option value="this_month" {{ request('date') == 'this_month' ? 'selected' : '' }}>This Month</option>
                </select>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Desired Date</th>
                    <th>Desired Time</th>
                    <th>Specialty</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($appointments->isEmpty())
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px;">
                        <div style="color: #888; font-size: 18px; font-weight: bold;">
                            <i class="fa fa-calendar-times" style="font-size: 30px; color: #b4b4b4;"></i>
                            <p>No appointments found</p>
                        </div>
                    </td>
                </tr>
                @endif
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->full_name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ $appointment->desired_date }}</td>
                        <td>{{ $appointment->desired_time }}</td>
                        <td>{{ $appointment->specialty }}</td>
                        <td>
                            <span class="status-label" style="background-color: {{ 
                                $appointment->status == 'Approved' ? '#4CAF50' : 
                                ($appointment->status == 'Completed' ? '#4CAF50' : 
                                ($appointment->status == 'Cancelled' ? '#F44336' : '#FFC107')) }}">
                                {{ $appointment->status }}
                            </span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="btn btn-view">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $appointment->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete" onclick="confirmDelete({{ $appointment->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $appointments->links() }}
        </div>
    </div>

    <!-- Popup Message -->
    <div id="popupMessage" class="popup-message">
        Appointment deleted successfully.
    </div>

    <script>
        function confirmDelete(appointmentId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to recover this appointment!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + appointmentId).submit();
                }
            });
        }
    </script>

</body>
</html>
