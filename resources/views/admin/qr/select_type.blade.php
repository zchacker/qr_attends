@include('admin.header')

<div class="content">
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="form-cover">
                <div class="relative rounded-tl-md  rounded-tr-md overflow-auto p-8">
                    <h2 class="text-2xl font-bold my-8"> {{__('select_qr_type')}} </h2>
                    <div class="overflow-x-auto relative mt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <a href="{{ route('admin.qr.create' , 'url') }}">
                                <div class="flex gap-4 border border-gray-400 shadow-lg rounded-lg p-2">
                                    <div class="w-[20%]">
                                        <i class="las la-globe la-3x text-gray-500"></i>
                                    </div>
                                    <div>
                                        <h2 class="font-bold text-xl">المواقع</h2>
                                        <p>أضف أي رابط لموقع</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.qr.create' , 'pdf') }}">
                                <div class="flex gap-4 border border-gray-400 shadow-lg rounded-lg p-2">
                                    <div class="w-[20%]">
                                        <i class="lar la-file-pdf la-3x text-gray-500"></i>                                        
                                    </div>
                                    <div>
                                        <h2 class="font-bold text-xl">ملفات PDF</h2>
                                        <p>إرفع ملفات PDF</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.qr.create' , 'video') }}">
                                <div class="flex gap-4 border border-gray-400 shadow-lg rounded-lg p-2">
                                    <div class="w-[20%]">                                        
                                        <i class="lab la-youtube la-3x text-gray-500"></i>                                      
                                    </div>
                                    <div>
                                        <h2 class="font-bold text-xl">فديو</h2>
                                        <p> اعرض فديو </p>
                                    </div>
                                </div>
                            </a>

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')