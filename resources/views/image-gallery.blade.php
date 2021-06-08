<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Gallary') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <form  method="POST" action="{{ url('image-gallery') }}" enctype="multipart/form-data">
                    @csrf
                
                <div class="grid bg-white rounded-lg shadow-xl">
                    <div class="flex justify-center">
                    <div class="flex">
                        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Add Image</h1>
                    </div>
                    </div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                            <strong>{{ $message }}</strong>
                    @endif
            
                    

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Name</label>
                    <input class="@error('title') is-invalid @enderror py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" name="title" type="text" placeholder="name" />
                    </div>
                    <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">File</label>
                    <input type="file" name="image" class="">
                    </div>
                    </div>
                    
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                    <div id="formResetBtn" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancel</div>
                    <button class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="flex items-center justify-center">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <!-- 1 card -->
                
            @if($images->count())
                @foreach($images as $image)
                <div class="relative bg-white py-3 px-3 rounded-3xl w-64 my-4 shadow-xl">
                    <div class=" text-white flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-pink-500 left-4 -top-6">
                        <form action="{{ url('image-gallery',$image->id) }}" method="POST">
                            <input type="hidden" name="_method" value="delete">
                            {!! csrf_field() !!}
                            <button type="submit">x</button>
                        </form>
                    </div>
                    <div class="mt-8">
                        <p class="text-xl font-semibold my-2">{{ $image->title }}</p>
                        <div class="bg-green-300">
                            <img class="object-scale-down h-48 w-full " src="/images/{{ $image->image }}">
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
