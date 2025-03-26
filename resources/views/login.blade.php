<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const successMessage = document.getElementById("success-message");
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = "none";
                }, 3000); // Hide after 3 seconds
            }
        });
    </script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-200">

    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-xl">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Lecturer Login</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div id="success-message" class="mb-4 text-green-600 text-sm text-center bg-green-100 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <p class="mb-4 text-red-500 text-sm">{{ $errors->first('login_error') }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="lecID" class="block text-sm font-medium text-gray-600">Lecturer ID</label>
                <input type="text" name="lecID" required
                    class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-gray-400 outline-none">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-gray-400 outline-none">
            </div>

            <div class="text-right">
                <a href="/forgot-password" class="text-sm text-blue-500 hover:underline">
                    Forgot Password?
                </a>
            </div>

            <button type="submit" class="w-full py-2 text-white bg-black rounded-md hover:bg-gray-800 transition">
                Login
            </button>
        </form>
    </div>

</body>

</html>
