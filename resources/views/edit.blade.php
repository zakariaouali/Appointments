<!-- resources/views/appointments/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-left: 250px;
            padding: 30px;
            max-width: 1200px;
            margin-top: 50px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px);
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            width: 150px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-top: 8px;
            display: flex;
            align-items: center;
        }

        .form-group i {
            font-size: 18px;
            margin-right: 10px;
            color: #007bff;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    
    <x-nav/>
    <div class="container">
        <h1>Edit Appointment</h1>

        <!-- Display success message if any -->
        @if (session('success'))
            <div style="background-color: #28a745; color: white; padding: 15px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Edit Appointment Form -->
        <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')  <!-- Use PUT method to update the record -->
        
            <!-- Appointment Details Form -->
            <div class="form-group">
                <i class="fa fa-stethoscope"></i>
                <label for="specialty">Specialty</label>
                <select name="specialty" id="specialty" class="form-control" required>
                    <option value="omnipractice" {{ $appointment->specialty == 'omnipractice' ? 'selected' : '' }}>Omnipractice</option>
                    <option value="diabetology" {{ $appointment->specialty == 'diabetology' ? 'selected' : '' }}>Diabetology</option>
                    <option value="nutrition" {{ $appointment->specialty == 'nutrition' ? 'selected' : '' }}>Nutrition</option>
                    <option value="homeopathy" {{ $appointment->specialty == 'homeopathy' ? 'selected' : '' }}>Homeopathy</option>
                    <option value="Cupping thérapie" {{ $appointment->specialty == 'Cupping thérapie' ? 'selected' : '' }}>Cupping thérapie</option>
                </select>
            </div>
        
            <div class="form-group">
                <i class="fa fa-calendar"></i>
                <label for="desired_date">New Date</label>
                <input type="date" id="desired_date" name="desired_date" value="{{ $appointment->desired_date }}" class="form-control" required>
            </div>
        
            <div class="form-group">
                <i class="fa fa-clock"></i>
                <label for="desired_time">New Time</label>
                <input type="time" id="desired_time" name="desired_time" value="{{ $appointment->desired_time }}" class="form-control" required>
            </div>
        
            <div class="form-group">
                <i class="fa fa-comment"></i>
                <label for="comments">Comment</label>
                <textarea id="comments" name="comments" class="form-control" rows="4">{{ $appointment->comments }}</textarea>
            </div>
        
            <div class="form-group">
                <i class="fa fa-info-circle"></i>
                <label for="status">New Statu</label>
                <select name="status" id="status" class="form-control">
                    <option value="Pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="Completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Appointment</button>
            
        </form>
    </div>

</body>
</html>
