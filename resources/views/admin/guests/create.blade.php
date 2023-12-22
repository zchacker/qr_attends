@include('admin.header')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

<div class="content">
    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="form-cover">
                <div class="relative rounded-tl-md  rounded-tr-md overflow-auto p-8">

                    <h2 class="text-2xl font-bold mb-4"> إضافة زائر </h2>

                    <div class="w-1/3 flex gap-4 mb-8">
                        <a href="{{ route('admin.guest.upload') }}" class="normal_button">رفع ملف الاعضاء </a>
                    </div>

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

                        <form action="{{ route('admin.guest.create.action') }}" method="post" onsubmit="return form_submit(this);" class="w-full">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="lable_form">{{ __('name') }}</label>
                                <input type="text" name="name" class="form_input" value="{{ old('name') }}" />
                            </div>

                            <div class="mb-4">
                                <label for="email" class="lable_form">{{ __('email') }}</label>
                                <input type="text" name="email" class="form_input" value="{{ old('email') }}" />
                            </div>

                            <div class="mb-4">
                                <label for="phone_no" class="lable_form">{{ __('phone') }}</label>
                                <input type="text" name="phone_no" id="phone_no" placeholder="512345678" class="form_input !w-full !border-blue-500 text-left" dir="ltr" value="{{ old('phone') }}" />
                                <input type="hidden" name="phone_no[phone]" />
                            </div>


                            <div class="mb-4">
                                <input type="submit" value="{{ __('save') }}" class="action_btn" />
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
    const input = document.querySelector("#phone_no");
    window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        dropdownContainer: document.getElementById("form-cover"),
        initialCountry: 'sa',
        separateDialCode: true,
        preferredCountries: ["sa", "ae", 'uk', 'us'],
        hiddenInput: "phone"
    });
</script>


@include('admin.footer')