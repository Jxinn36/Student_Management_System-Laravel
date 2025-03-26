<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-200">

    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-xl">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Forgot Password</h2>

        @if ($errors->any())
            <p class="mb-4 text-red-500 text-sm">{{ $errors->first() }}</p>
        @endif

        <form action="{{ url('/verify-email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-600">Enter Your Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-gray-400 outline-none">
            </div>

            <button type="submit" class="w-full py-2 text-white bg-black rounded-md hover:bg-gray-800 transition">
                Verify Email
            </button>
        </form>
    </div>

</body>

</html>
