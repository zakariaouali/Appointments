<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/patient-edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <h1>Edit Patient</h1>

        <!-- Edit Patient Form -->
        <form id="edit-patient-form" action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')  <!-- Use PUT method to update the record -->
        
            <!-- Patient Details Form -->
            <div class="form-group">
                <i class="fa fa-user"></i>
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="{{ $patient->full_name }}" class="form-control" required>
            </div>
        
            <div class="form-group">
                <i class="fa fa-calendar"></i>
                <label for="birthdate">Birth Date</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ $patient->birthdate }}" class="form-control" required>
            </div>
        
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $patient->email }}" class="form-control" required>
            </div>
        
            <div class="form-group">
                <i class="fa fa-phone"></i>
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ $patient->phone }}" class="form-control" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Update Patient</button>
            
        </form>
    </div>

    <script>
        document.getElementById('edit-patient-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the patient's details.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if the user confirms
                }
            });
        });
    </script>

</body>
</html>