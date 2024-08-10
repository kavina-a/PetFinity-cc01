<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/login.css'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
    </style>    
</head>

<body>
    <div class="animation-bg"></div>
    <div class="guest-layout">
        <div class="authentication-card">
            <div class="title">Petfinity</div>
            <div class="authentication-card-logo">
                <a href="/">
                    <img src="icon.jpeg" class="avatar" alt="User Avatar">
                </a>
            </div>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" onsubmit="return validateForm()">
                @csrf

                <div>
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block w-full mt-1 input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
                    <x-input id="password" class="block w-full mt-1 input" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember" class="checkbox">
                        <span class="text-sm text-gray-600 ms-2">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit" class="button ms-4">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var errors = [];

            if (!email) {
                errors.push('Email is required.');
            }
            if (!password) {
                errors.push('Password is required.');
            }

            if (errors.length > 0) {
                var errorList = document.getElementById('error-list');
                errorList.innerHTML = '';
                errors.forEach(function (error) {
                    var li = document.createElement('li');
                    li.textContent = error;
                    errorList.appendChild(li);
                });
                document.getElementById('validation-errors').style.display = 'block';
                return false;
            }
            return true;
        }
    </script>
</body>
</html>