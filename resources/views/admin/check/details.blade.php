<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد الدعوة</title>
    <meta name="description" content="قم بتحميل الكود الخاص بك الان">
    @vite(['resources/css/app.css' , 'resources/js/app.js'])    
</head>
<body>
    <div class="w-full bg-[#f1f1f1] py-0 min-h-screen">
        <div class="flex flex-col min-h-screen gap-4 justify-center items-center">
            @if(Session::has('success'))
            <div class="my-3 w-auto p-4 bg-green-700 text-white rounded-md">
                {!! session('success') !!}
            </div>
            @endif
            <p class="text-black font-bold text-4xl">{{ $user->name }}</p>
            <p class="text-gray-700 font-bold text-xl">{{ $user->phone }}</p>
            <p>{{ $user->email }}</p>
            <p class="font-bold text-3xl {{ $user->attend == 0 ? 'text-red-700' : 'text-green-700' }}">
                {{ $user->attend == 0 ? __('not_attend') : __('attend') }}
            </p>
            <div class="flex mt-10">
                <form action="{{ route('admin.guest.visits.confirm' , $user->id) }}" method="post">
                    @csrf 
                    <button type="submit" class="action_btn">
                        <span>تأكيد تسجيل الحضور</span>
                    </button>
                </form>
            </div>
        </div>        
    </div>
</body>
</html>