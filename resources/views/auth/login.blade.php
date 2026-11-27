<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureCare Medical Center | Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f8f5;
            color: #26352b;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            padding: 40px;
            background: white;
            border: 1px solid #e6eee8;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            color: #146b45;
            margin-bottom: 12px;
        }

        .logo span {
            color: #21865a;
            display: block;
            font-size: 17px;
            margin-top: 4px;
        }

        .logo-icon {
            width: 76px;
            height: 76px;
            background: #e7f5ec;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
        }

        .header h1 {
            color: #26352b;
            font-size: 25px;
            margin-bottom: 8px;
        }

        .header p {
            color: #718078;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
            color: #26352b;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dce5de;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
            background: white;
        }

        input:focus {
            border-color: #146b45;
        }

        input::placeholder {
            color: #a0aaa3;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 65px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #146b45;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
        }

        .login-button {
            width: 100%;
            padding: 13px;
            background: #146b45;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #21865a;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #718078;
        }

        .register-link a {
            color: #146b45;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            color: #21865a;
            text-decoration: underline;
        }

        .alert {
            padding: 13px;
            margin-bottom: 20px;
            border-radius: 7px;
            font-size: 14px;
        }

        .success {
            background: #dff5e8;
            color: #176b3a;
        }

        .error {
            background: #ffe3e3;
            color: #b42323;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e6eee8;
            color: #9aa49d;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="header">

          <div class="logo-icon">
             <svg viewBox="0 0 48 48" width="48" height="48">
                <path d="M24 39S6 28 6 16C6 9 15 5 24 15C33 5 42 9 42 16C42 28 24 39 24 39Z"
                    fill="none"
                    stroke="#146b45"
                    stroke-width="2.8"
                    stroke-linejoin="round"/>

                <path d="M8 23h9l4-7 6 14 4-7h9"
                    fill="none"
                    stroke="#21865a"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="logo">
                 PureCare <span>Medical Center</span>
            </div>

            <h1>Welcome Back!</h1>

            <p>Please log in to your account</p>

        </div>

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="email">Email Address</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                >

            </div>

            <div class="form-group">

                <label for="password">Password</label>

                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword()"
                    >
                        Show
                    </button>

                </div>

            </div>

            <button type="submit" class="login-button">
                Log In
            </button>

        </form>

        <div class="register-link">

            Don't have an account?

            <a href="{{ route('register') }}">
                Register here
            </a>

        </div>

        <div class="footer">
            PureCare Medical Center | Patient Records Management System
        </div>

    </div>

    <script>
        function togglePassword() {

            const password = document.getElementById('password');
            const button = document.querySelector('.toggle-password');

            if (password.type === 'password') {

                password.type = 'text';
                button.textContent = 'Hide';

            } else {

                password.type = 'password';
                button.textContent = 'Show';

            }

        }
    </script>

</body>
</html>