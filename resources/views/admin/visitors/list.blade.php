@include('admin.header')

<div class="content">

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Content--}}
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="px-4">
                        <div class="flex justify-between sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-xl font-semibold text-gray-900">
                                    {{__('attends_list')}}
                                </h1>

                                <p class="mt-2 text-sm text-gray-700">
                                    {{ __('total').' : '.$sum}}
                                </p>
                            </div>
                            
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">#</th>
                                            <th scope="col" class="py-3 px-6"> {{__('name')}} </th>
                                            <th scope="col" class="py-3 px-6"> {{__('email')}} </th>
                                            <th scope="col" class="py-3 px-6"> {{__('phone')}} </th>
                                            <th scope="col" class="py-3 px-6"> {{__('join_date')}} </th>
                                            {{--<th scope="col" class="py-3 px-6"> </th>--}}
                                        </tr>
                                    </thead>
                                    <tbody class="table_body">
                                        
                                        @foreach($guests as $guest)
                                        <tr data-href="" class="clickable-row cursor-pointer hover:bg-gray-200">
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"> {{ $guest->id}} </td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"> {{ $guest->name }} </td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"> {{ $guest->email }} </td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"> {{ $guest->phone }} </td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"> {{ $guest->created_at }} </td>
                                            {{--
                                            <td class="relative flex gap-4 justify-between whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 md:pr-0">

                                                <a href="{{ route('admin.guest.edit' , $guest->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>                                                
                                                
                                                <form action="{{ route('admin.qr.generate', $guest->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="guest" value="{{ $guest->id}}" />

                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="QR">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6" id="qr-code">
                                                            <path d="M17 3h-1c-.6 0-1 .4-1 1s.4 1 1 1h1c1.1 0 2 .9 2 2v1.1c0 .6.4 1 1 1s1-.4 1-1V7c0-2.2-1.8-4-4-4zm3 12c-.6 0-1 .4-1 1v1c0 1.1-.9 2-2 2h-1c-.6 0-1 .4-1 1s.4 1 1 1h1c2.2 0 4-1.8 4-4v-1c0-.6-.4-1-1-1zM8 19H7c-1.1 0-2-.9-2-2v-1c0-.6-.4-1-1-1s-1 .4-1 1v1c0 2.2 1.8 4 4 4h1c.6 0 1-.4 1-1s-.4-1-1-1zM4 9c.6 0 1-.4 1-1V7c0-1.1.9-2 2-2h1c.6 0 1-.4 1-1s-.4-1-1-1H7C4.8 3 3 4.8 3 7v1c0 .5.4 1 1 1z"></path>
                                                            <path d="M12 8c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h2c1.1 0 2-.9 2-2V8zm-4 2V8h2v2H8zm10 6v-2c0-1.1-.9-2-2-2h-2c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h2c1.1 0 2-.9 2-2zm-4-2h2v2h-2v-2zm0-3h1c.6 0 1-.4 1-1V8h1c.6 0 1-.4 1-1s-.4-1-1-1h-2c-.6 0-1 .4-1 1v2c-.6 0-1 .4-1 1s.4 1 1 1zm-4 2H7c-.6 0-1 .4-1 1s.4 1 1 1h2v2c0 .6.4 1 1 1s1-.4 1-1v-3c0-.6-.4-1-1-1z"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                

                                                <form action="{{ route('admin.guest.delete', $guest->id) }}" method="POST" onsubmit="return confirmDelete()">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>

                                            </td>
                                            --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="text-left mt-10" dir="rtl">
            {{ $guests->onEachSide(5)->links('pagination::tailwind') }}
        </div>

    </div>

</div>

<script>
    // $(document).ready(function($) {
    //     $(".clickable-row").click(function() {
    //         window.location = $(this).data("href");
    //     });
    // });
</script>

<script>
    function confirmDelete() {
        return confirm(" {{__('delete_engineer_confirmation')}} ");
    }
</script>

@include('admin.footer')