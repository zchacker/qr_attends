@include('admin.header')
<div class="content">

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-8"> {{__('update_password')}}</h1>

                <div class="relative rounded-tl-md  rounded-tr-md overflow-auto">
                    <div class="overflow-x-auto relative p-2">                        

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

                        <form action="{{ route('admin.password.update') }}" method="post" class="w-full" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-4  space-x-4 gap-2 items-center">
                                <label for="current-password" class="lable_form">{{ __('current-password') }} </label>
                                <input type="password" name="current-password" id="current-password" class="form_input !w-full" />
                            </div>
                            
                            <div class="mb-4  space-x-4 gap-2 items-center">
                                <label for="new-password" class="lable_form">{{ __('new-password') }} </label>
                                <input type="password" name="new-password" id="new-password" class="form_input !w-full"  />
                            </div>                                                                                  

                            <div class="mb-4">
                                <input id="submitButton" type="submit" value="{{ __('save') }}" class="action_btn" />
                            </div>

                        </form>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@include('admin.footer')