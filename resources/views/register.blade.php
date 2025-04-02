<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* General body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container for registration form */
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        /* Header styling */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Error message styling */
        .alert {
            background-color: #ffe6e6;
            color: #d93025;
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #d93025;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Error icon */
        .error-icon {
            font-weight: bold;
            font-size: 18px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Input label styling */
        label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #666;
        }

        /* Input field styling */
        input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Focus effect for input fields */
        input:focus {
            border-color: #4e73df;
            outline: none;
        }

        /* Button styling */
        button {
            padding: 12px;
            background-color: #4e73df;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        /* Button hover effect */
        button:hover {
            background-color: #2e59d9;
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        a{
            text-align: center;
            color: #0800ff;
            margin-bottom: 20px;    
            text-decoration: none;
        }
        #login{
            margin-top: 10px;

        }        
        /* Responsive design for mobile */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 18px;
            }

            button {
                font-size: 14px;
            }
        }
        span.text-danger{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
    
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
        <div id="login">
            <a href="{{ route('login') }}">Already have an account? Login here</a>
        </div>
    </div>
</body>
</html>