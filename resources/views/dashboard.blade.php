<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Marks') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
    
    <div class="overflow-x-auto">
        <form id="markForm" method="POST" action="{{ route('marks.store') }}">
            @csrf
        <div>
          <div class="grid bg-white rounded-lg shadow-xl">
            <div class="flex justify-center">
              <div class="flex">
                <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Add Mark</h1>
              </div>
            </div>
            

            <div class="grid grid-cols-1 md:grid-cols-5 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
              <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Name</label>
              <input class="@error('name') is-invalid @enderror py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" name="name" type="text" placeholder="name" />
              @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="grid grid-cols-1">
              <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Term</label>
              <select name="term" class="@error('term') is-invalid @enderror py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                <option value="one">One</option>
                <option value="two">Two</option>
                <option value="three">Three</option>
              </select>
              @error('term')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
              <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Physics</label>
                <input class="@error('physics') is-invalid @enderror py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" name="physics" type="number" placeholder="Physics marks" />
                @error('physics')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>             
              <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Chemistry</label>
                <input class="@error('chemistry') is-invalid @enderror py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" name="chemistry" type="number" placeholder="Chemistry marks" />
                @error('chemistry')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
              <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Biology</label>
                <input class="@error('biology') is-invalid @enderror py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" name="biology" type="number" placeholder="Biology marks" />
                @error('biology')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-max w-full table-auto" id="example">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Id</th>
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-center">Physics</th>
                                <th class="py-3 px-6 text-center">Chemistry</th>
                                <th class="py-3 px-6 text-center">Biology</th>
                                <th class="py-3 px-6 text-center">Term</th>
                                <th class="py-3 px-6 text-center">Total marks</th>
                                <th class="py-3 px-6 text-center">Created On</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="mtbody" class="text-gray-600 text-sm font-light">
                            
                        </tbody>
                    </table>
    
                </div>
            </div>
        </div>
    </div>
  
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$("#formResetBtn").click(function(){
    $('#markForm')[0].reset();
    $('#markForm').attr('action', '{{URL::to('marks/store')}}');
});

loadMardData();

function loadMardData(){
    $("#mtbody").html("<tr>Loading</tr>");
$.ajax({
        dataType: 'json',
        type : 'get',
        url : '{{URL::to('marks')}}',

        data:{ "_token": "{{ csrf_token() }}",
        },
        success:function(data)
        {
            console.log(data);
            var res='';
            $.each (data, function (key, value) {
            res +=
            '<tr class="border-b border-gray-200 hover:bg-gray-100"><td class="py-3 px-6 text-left whitespace-nowrap"><div class="flex items-center"><span class="font-medium">'+
                value.id
                +'</span></div></td><td class="py-3 px-6 text-left"><div class="flex items-center"><span>'+
                    value.name
                +'</span></div></td><td class="py-3 px-6 text-center"><div class="flex items-center justify-center">'+
                value.physics
                +'</div></td><td class="py-3 px-6 text-center"><div class="flex items-center justify-center">'+
                value.chemistry
                +'</div></td><td class="py-3 px-6 text-center"><div class="flex items-center justify-center">'+
                value.biology
                +'</div></td><td class="py-3 px-6 text-center"><div class="flex items-center justify-center">'+
                                    value.term
                +'</div></td><td class="py-3 px-6 text-center"><div class="flex items-center justify-center">'+
                                    value.total
                +'</div></td><td class="py-3 px-6 text-center"><div class="flex items-center justify-center">'+
                                    value.created_at
                +'</div></td><td class="py-3 px-6 text-center"><div class="flex item-center justify-center">'+
                '<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">'+
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg></div>'+
                '<div onclick="editMark('+value.id+')" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">'+
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></div>'+
                '<div onclick="deleteMark('+value.id+')" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">'+
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></div></div></td></tr>';

   });
   $("#mtbody").html(res);
}
});
}
function editMark(id){
$.ajax({
        dataType: 'json',
        type : 'get',
        url : '{{URL::to('marks/edit')}}/'+id,

        data:{ "_token": "{{ csrf_token() }}",
        },
        success:function(data)
        {
            console.log(data);
            if(data){
                $('input[name="name"]').val(data.name);
                $('input[name="term"]').val('two').change();;
                $('input[name="physics"]').val(data.physics);
                $('input[name="chemistry"]').val(data.chemistry);
                $('input[name="biology"]').val(data.biology);
            }
        }
});
$("#markForm").attr('action', '{{URL::to('marks/update')}}/'+id);
}

function deleteMark(id){
    $.ajax({
        dataType: 'json',
        type : 'delete',
        url : '{{URL::to('marks/delete')}}/'+id,

        data:{ "_token": "{{ csrf_token() }}",
        },
        success:function(data)
        {
            console.log(data);
            loadMardData();
        }
});

}

$("#markForm").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var url = form.attr('action');

    $.ajax({
       type: "POST",
       url: url,
       data: form.serialize(), // serializes the form's elements.
       success: function(data)
       {
           alert("Sucess"); // show response from the php script.
           loadMardData();
       }
     });


});


</script>