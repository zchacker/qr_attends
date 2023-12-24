@include('admin.header')

<div class="content">
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative rounded-tl-md  rounded-tr-md overflow-auto p-8">
                <h2 class="text-2xl font-bold mb-4"> تعديل عميل </h2>
                    <div class="overflow-x-auto relative">

                        @if(Session::has('errors'))
                        <div class="my-3 w-auto p-4 bg-orange-500 text-white rounded-md">
                            {!! session('errors')->first('error') !!}
                            @error('csv_file')
                                <span class=" text-white">
                                    {!! $message !!}
                                </span>
                            @enderror
                        </div>
                        @endif

                        

                        @if(Session::has('success'))
                        <div class="my-3 w-auto p-4 bg-green-700 text-white rounded-md">
                            {!! session('success') !!}
                        </div>
                        @endif

                        <form action="{{ route('admin.guest.upload.action') }}" method="post" enctype="multipart/form-data" class="w-full">
                            @csrf                            
                            
                            <a href="{{ asset('Test.csv') }}" class="text-blue-500 hover:underline mb-8">تحميل نموذج رفع البيانات</a>

                            <div class="mb-4 mt-4">
                                <label for="csv_file" class="lable_form">{{ __('file') }}</label>
                                <input type="file" name="csv_file" id="csv_file" class="form_input" accept=".csv" />
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

@include('admin.footer')