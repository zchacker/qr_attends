<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full sm:max-w-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">دخول</h2>
        @if(Session::has('errors'))
        <div class="my-3 w-full p-4 bg-orange-500 text-white rounded-md">
            {!! session('errors')->first('login_error') !!}
        </div>
        @endif
        @if(Session::has('success'))
        <div class="my-3 w-auto p-4 bg-green-700 text-white rounded-md">
            {!! session('success') !!}
        </div>
        @endif
        <form action="{{ route('login.action') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">إيميل</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="example@gmail.com">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">رقم سري</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="************">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white rounded-md py-2 px-4 font-semibold hover:bg-blue-600 focus:outline-none focus:bg-blue-600">دخول</button>
        </form>
        <!-- <p class="text-gray-600 text-sm mt-4 text-center">Don't have an account? <a href="#" class="text-blue-500 hover:underline">Sign Up</a></p> -->
    </div>
</body>

</html>