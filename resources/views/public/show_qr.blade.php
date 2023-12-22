<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حمل كود الزيارة الخاص بك</title>
    <meta name="description" content="قم بتحميل الكود الخاص بك الان">
    @vite(['resources/css/app.css' , 'resources/js/app.js'])    
</head>
<body>
    <div class="w-full bg-[#f1f1f1] py-0 min-h-screen">
        <div class="flex justify-center py-16 mx-auto w-1/2">
            {!! QrCode::size(200)->generate($url); !!}
        </div>
        <div class="flex flex-col items-center justify-center gap-4">
            <p>قم بتحميل كود الدعوة الخاص بك</p>
            @php 
                $qr = base64_encode( QrCode::size(300)->format('png')->generate($url) );
            @endphp
            <a href="data:image/png;base64, {{ $qr }}" id="download" download="qr_code.png" class="flex bg-green-500 p-2 px-4 shadow-lg text-white font-bold rounded-lg" >
                <span>تحميل</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 fill-white" id="qr-code">
                    <path d="M17 3h-1c-.6 0-1 .4-1 1s.4 1 1 1h1c1.1 0 2 .9 2 2v1.1c0 .6.4 1 1 1s1-.4 1-1V7c0-2.2-1.8-4-4-4zm3 12c-.6 0-1 .4-1 1v1c0 1.1-.9 2-2 2h-1c-.6 0-1 .4-1 1s.4 1 1 1h1c2.2 0 4-1.8 4-4v-1c0-.6-.4-1-1-1zM8 19H7c-1.1 0-2-.9-2-2v-1c0-.6-.4-1-1-1s-1 .4-1 1v1c0 2.2 1.8 4 4 4h1c.6 0 1-.4 1-1s-.4-1-1-1zM4 9c.6 0 1-.4 1-1V7c0-1.1.9-2 2-2h1c.6 0 1-.4 1-1s-.4-1-1-1H7C4.8 3 3 4.8 3 7v1c0 .5.4 1 1 1z"></path>
                    <path d="M12 8c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h2c1.1 0 2-.9 2-2V8zm-4 2V8h2v2H8zm10 6v-2c0-1.1-.9-2-2-2h-2c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h2c1.1 0 2-.9 2-2zm-4-2h2v2h-2v-2zm0-3h1c.6 0 1-.4 1-1V8h1c.6 0 1-.4 1-1s-.4-1-1-1h-2c-.6 0-1 .4-1 1v2c-.6 0-1 .4-1 1s.4 1 1 1zm-4 2H7c-.6 0-1 .4-1 1s.4 1 1 1h2v2c0 .6.4 1 1 1s1-.4 1-1v-3c0-.6-.4-1-1-1z"></path>
                </svg>
            </a>
        </div>
    </div>
</body>
</html>