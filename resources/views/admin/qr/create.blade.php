@include('admin.header')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

<div class="content">
    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="form-cover">
                <div class="relative rounded-tl-md  rounded-tr-md overflow-auto p-8">

                    <h2 class="text-2xl font-bold mb-4"> {{__('generate_qr')}} </h2>
                   
                    <div class="overflow-x-auto relative">

                        @if(Session::has('errors'))
                        <div class="my-3 w-auto p-4 bg-orange-500 text-white rounded-md">
                            {!! session('errors')->first('error') !!}
                        </div>
                        @endif

                        @if(Session::has('success'))
                        <div class="my-3 w-auto p-4 bg-green-700 text-white rounded-md">
                            {!! session('success') !!}
                        </div>
                        @endif

                        <form action="{{ route('admin.qr.create.action') }}" method="post" class="w-full" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="type" value="{{ $type }}" />

                            <div class="mb-4">
                                <label for="name" class="lable_form">{{ __('name') }}</label>
                                <input type="text" name="name" class="form_input" value="{{ old('name') }}" required />
                            </div>

                            @if($type == 'pdf')
                            <div class="mb-4">
                                <label for="file" class="lable_form">{{ __('pdf_file') }}</label>
                                <span class="text-gray-600 mb-4">حجم الملف المسموح به 25 ميجا</span>
                                <input type="file" name="file" class="form_input"  />
                            </div>
                            @elseif( $type == "video" || $type == "website" )
                            <div class="mb-4">
                                <label for="url" class="lable_form">{{ __('youtube_url') }}</label>
                                <input type="url" id="youtubeUrl" name="url" class="form_input"  />
                            </div>                            
                            @endif

                            <div id="videoContainer" class="mb-4"></div>
                            
                            <div class="my-4">
                                <input type="submit" value="{{ __('generate_qr') }}" class="action_btn" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let typingTimer;
    const doneTypingInterval = 1000; // Time in milliseconds (1 second)

    document.getElementById('youtubeUrl').addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(embedVideo, doneTypingInterval);
    });

    function embedVideo() {
        const inputUrl = document.getElementById('youtubeUrl').value;
        const videoId = getVideoId(inputUrl);
        
        if (videoId) {
            const embedUrl = `https://www.youtube.com/embed/${videoId}`;
            const iframe = document.createElement('iframe');
            iframe.setAttribute('src', embedUrl);
            iframe.setAttribute('width', '560');
            iframe.setAttribute('height', '315');
            iframe.setAttribute('frameborder', '0');
            
            document.getElementById('videoContainer').innerHTML = '';
            document.getElementById('videoContainer').appendChild(iframe);
        } else {
            alert('Please enter a valid YouTube URL.');
        }
    }

    function getVideoId(url) {
        const regExp = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }

</script>


@include('admin.footer')