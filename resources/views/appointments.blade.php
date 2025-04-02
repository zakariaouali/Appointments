<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/appointments.blade.php -->

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
:root {
    --background-color: #f4f7fc;
    --text-color: #333;
    --table-background-color: #fff;
    --table-header-background-color: #007bff;
    --table-header-text-color: white;
    --table-row-hover-color: #f1f1f1;
    --button-background-color: #ffffff;
    --button-text-color: rgb(0, 0, 0);
    --button-hover-background-color: #cfcfcf;
    --pagination-background-color: #007bff;
    --pagination-text-color: white;
    --pagination-hover-background-color: #0056b3;
    --pagination-disabled-background-color: #ccc;
    --pagination-info-background-color: #5a5a5a;
    --popup-background-color: #4CAF50;
    --popup-text-color: white;
    --table-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    --input-background-color: #fff;
    --input-text-color: #333;
    --input-border-color: #2e2e2e;
}

[data-theme="dark"] {
    --background-color: #161616;
    --text-color: #e0e0e0;
    --table-background-color: #1e1e1e;
    --table-header-background-color: #333;
    --table-header-text-color: #e0e0e0;
    --table-row-hover-color: #333;
    --button-background-color: #333;
    --button-text-color: #e0e0e0;
    --button-hover-background-color: #555;
    --pagination-background-color: #333;
    --pagination-text-color: #e0e0e0;
    --pagination-hover-background-color: #555;
    --pagination-disabled-background-color: #555;
    --pagination-info-background-color: #444;
    --popup-background-color: #333;
    --popup-text-color: #e0e0e0;
    --table-box-shadow: 0 5px 10px rgba(255, 255, 255, 0.274);
    --input-background-color: #333;
    --input-text-color: #e0e0e0;
    --input-border-color: #9a9a9a;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
    margin: 0;
    padding: 0;
    display: flex;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.container {
    margin-left: 250px;
    padding: 30px;
    max-width: 1200px;
    margin-top: 50px;
    background-color: var(--table-background-color);
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: calc(100% - 250px);
    transition: background-color 0.3s ease;
}

h1 {
    font-size: 32px;
    color: var(--text-color);
    margin-bottom: 20px;
    text-align: center;
    transition: color 0.3s ease;
}

.filters {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.filters select, .filters input[type="date"] {
    padding: 8px;
    border-radius: 5px;
    border: 2px solid var(--input-border-color);
    width: 200px;
    background-color: var(--input-background-color);
    color: var(--input-text-color);
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    background-color: var(--table-background-color);
    box-shadow: var(--table-box-shadow);
    border-radius: 8px;
    overflow: hidden;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: var(--table-header-background-color);
    color: var(--table-header-text-color);
    font-size: 16px;
    text-align: center;
    transition: background-color 0.3s ease, color 0.3s ease;
}

td {
    font-size: 14px;
    color: var(--text-color);
    text-align: center;
    font-weight: bold;
    transition: color 0.3s ease;
}

tr:hover {
    background-color: var(--table-row-hover-color);
    transition: background-color 0.3s ease;
}

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

.action-btn {
    text-decoration: none;
    color: var(--button-text-color);
    background-color: var(--button-background-color);
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    margin-right: 15px;
    transition: background-color 0.3s ease;
    display: inline-block;
}

.action-btn:hover {
    background-color: var(--button-hover-background-color);
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    gap: 10px;
}

.pagination a, .pagination span {
    padding: 8px 16px;
    margin: 0 5px;
    background-color: var(--pagination-background-color);
    color: var(--pagination-text-color);
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: var(--pagination-hover-background-color);
}

.pagination .disabled {
    background-color: var(--pagination-disabled-background-color);
    cursor: not-allowed;
}

.pagination .page-info {
    margin: 0 10px;
    font-size: 14px;
    color: var(--pagination-text-color);
    background-color: var(--pagination-info-background-color);
    padding: 8px 16px;
    border-radius: 5px;
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

.popup-message {
    position: fixed;
    top: 10px;
    right: 35%;
    background-color: var(--popup-background-color);
    color: var(--popup-text-color);
    padding: 10px 20px;
    border-radius: 5px;
    display: none;
    z-index: 1000;
}

.toggle-theme {
    font-size: 20px;
    position: fixed;
    top: 5px;
    right: 5px;
    background-color: var(--button-background-color);
    color: var(--button-text-color);
    border: none;
    padding: 10px;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.toggle-theme:hover {
    background-color: var(--button-hover-background-color);
    transform: scale(1.1);
}

#theme-icon {
    transition: transform 0.3s ease;
}

[data-theme="dark"] #theme-icon {
    transform: rotate(360deg);
}

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

    .filters select, .filters input[type="date"] {
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
<!-- Add this inside the <body> tag -->
    <div class="container">
        <button class="toggle-theme" onclick="toggleTheme()">
            <i class="fa fa-sun" id="theme-icon"></i>
        </button>    <!-- Main Content -->
        <h1>Appointments</h1>
        
        <!-- Filters section -->
        <div class="filters">
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

                <!-- New filter for specific date -->
                <input type="date" name="specific_date" value="{{ request('specific_date') }}" onchange="this.form.submit()">
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th><i class="fa fa-user"></i> Full Name</th>
                    <th><i class="fa fa-envelope"></i> Email</th>
                    <th><i class="fa fa-phone"></i> Phone</th>
                    <th><i class="fa fa-calendar"></i> Desired Date</th>
                    <th><i class="fa fa-clock"></i> Desired Time</th>
                    <th><i class="fa fa-stethoscope"></i></i> Specialty</th>
                    <th><i class="fa fa-info-circle"></i> Status</th>
                    <th><i class="fa fa-cogs"></i> Actions</th>
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
                                ($appointment->status == 'Cancelled' ? '#F44336' : '#FFC107')) }};">
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
            @if ($appointments->onFirstPage())
                <span class="disabled">&laquo; Previous</span>
            @else
                <a href="{{ $appointments->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
            @endif
        
            <span class="page-info">
                Page {{ $appointments->currentPage() }}
            </span>
        
            @if ($appointments->hasMorePages())
                <a href="{{ $appointments->appends(request()->query())->nextPageUrl() }}" rel="next">Next &raquo;</a>
            @else
                <span class="disabled">Next &raquo;</span>
            @endif
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

        function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-theme");
    const newTheme = currentTheme === "dark" ? "light" : "dark";
    document.documentElement.setAttribute("data-theme", newTheme);
    localStorage.setItem("theme", newTheme);
    updateThemeIcon(newTheme);
}

function updateThemeIcon(theme) {
    const themeIcon = document.getElementById("theme-icon");
    if (theme === "dark") {
        themeIcon.classList.remove("fa-moon");
        themeIcon.classList.add("fa-sun");
    } else {
        themeIcon.classList.remove("fa-sun");
        themeIcon.classList.add("fa-moon");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme") || "light";
    document.documentElement.setAttribute("data-theme", savedTheme);
    updateThemeIcon(savedTheme);
});
    </script>

</body>
</html>