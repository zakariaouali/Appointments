<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/patients-list.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients List</title>
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

        /* Card styles */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 25%;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 2px solid #ddd;
        }

        .card h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
            color: #777;
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

            .card {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <x-nav/>
    <!-- Main Content -->
    <div class="container">
        <h1>Patients List</h1>

        <div class="card-container">
            @foreach ($patients as $patient)
                <div class="card" onclick="window.location.href='{{ route('admin.patients.show', $patient->id) }}'">
                    <img src="{{ asset('images/user-icon.avif') }}" alt="User Logo">
                    <h2>{{ $patient->full_name }}</h2>
                    <p><i class="fas fa-envelope"></i> {{ $patient->email }}</p>
                    <p><i class="fas fa-phone"></i> {{ $patient->phone }}</p>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>