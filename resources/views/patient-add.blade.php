<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/patient-add.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
        <h1>Add Patient</h1>

        <form id="patientForm" action="{{ route('admin.patients.store') }}" method="POST">
            @csrf
        
            <div class="form-group">
                <i class="fa fa-user"></i>
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter full name" value="{{ old('full_name') }}" required>
            </div>

            <div class="form-group">
                <i class="fa fa-calendar"></i>
                <label for="birthdate">BirthDate</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('birthdate') }}" required>
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

            <button type="submit">Add Patient</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('admin.patients.index') }}";
                    }
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: "Error!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            @endif
        });
    </script>

</body>
</html>