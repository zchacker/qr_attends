@include('admin.header')

<div class="content">
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="form-cover">
                <div class="relative rounded-tl-md  rounded-tr-md overflow-auto p-8">
                    <h1 class="text-2xl font-bold my-8"> {{ $qr->name }} </h1>
                    <div class="overflow-x-auto relative mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @php 
                                $qr_img = base64_encode( QrCode::size(300)->errorCorrection('M')->format('png')->generate($url) );
                            @endphp
                            <div class="my-1">
                                <img src="data:image/png;base64, {{ $qr_img }}" alt="" class="my-8">  
                                <a href="{{ route('admin.qr.download' , $qr->id) }}" id="download" class="action_btn" download="qr_code.png">
                                    {{__('download_qr')}}
                                </a>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')