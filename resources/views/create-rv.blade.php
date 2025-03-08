<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/create-rv.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
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
        <h1>Create Appointment</h1>

        <form id="appointmentForm" action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf
        
            <div class="form-group">
                <i class="fa fa-user"></i>
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter full name" value="{{ old('full_name') }}" required>
            </div>

            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <i class="fa fa-phone"></i>
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}" required>
            </div>

            <div class="form-group">
                <i class="fa fa-stethoscope"></i>
                <label for="specialty">Specialty</label>
                <select name="specialty" id="specialty" class="form-control" required>
                    <option value="omnipractice" {{ old('specialty') == 'omnipractice' ? 'selected' : '' }}>Omnipractice</option>
                    <option value="diabetology" {{ old('specialty') == 'diabetology' ? 'selected' : '' }}>Diabetology</option>
                    <option value="nutrition" {{ old('specialty') == 'nutrition' ? 'selected' : '' }}>Nutrition</option>
                    <option value="homeopathy" {{ old('specialty') == 'homeopathy' ? 'selected' : '' }}>Homeopathy</option>
                    <option value="cupping_therapy" {{ old('specialty') == 'cupping_therapy' ? 'selected' : '' }}>Cupping Therapy</option>
                </select>
            </div>

            <div class="form-group">
                <i class="fa fa-calendar"></i>
                <label for="desired_date">Date</label>
                <input type="date" id="desired_date" name="desired_date" class="form-control" value="{{ old('desired_date') }}" required>
            </div>

            <div class="form-group">
                <i class="fa fa-clock"></i>
                <label for="desired_time">Time</label>
                <input type="time" id="desired_time" name="desired_time" class="form-control" value="{{ old('desired_time') }}" required>
            </div>

            <div class="form-group">
                <i class="fa fa-comment"></i>
                <label for="comments">Comments</label>
                <textarea id="comments" name="comments" class="form-control" placeholder="Additional comments">{{ old('comments') }}</textarea>
            </div>

            <button type="submit">Create Appointment</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#appointmentForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(() => {
                            window.location.href = "{{ route('admin.appointments.index') }}";
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>