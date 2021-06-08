<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Marks;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    function index(){
        $markLists=Marks::get();
        
        return response()->json($markLists);
    }

    function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'term' => 'required',
            'physics' => 'numeric',
            'chemistry' => 'numeric',
            'biology' => 'numeric',
        ]);
        $marks = new Marks();
        //On left field name in DB and on right field name in Form/view
        $marks->name = $request->input('name');
        $marks->term = $request->input('term');
        $marks->physics = $request->input('physics');
        $marks->chemistry = $request->input('chemistry');
        $marks->biology = $request->input('biology');
        $marks->total = $request->input('physics')+$request->input('chemistry')+$request->input('biology');
        $marks->save();

        return response()->json($marks);
    
    }

    function edit($id){
        $markLists=Marks::find($id);
        
        return response()->json($markLists);
    
    }

    function update($id,Request $request){
        $this->validate($request, [
            'name' => 'required',
            'term' => 'required',
            'physics' => 'numeric',
            'chemistry' => 'numeric',
            'biology' => 'numeric',
        ]);
        $marks = Marks::find($id);
        //On left field name in DB and on right field name in Form/view
        $marks->name = $request->input('name');
        $marks->term = $request->input('term');
        $marks->physics = $request->input('physics');
        $marks->chemistry = $request->input('chemistry');
        $marks->biology = $request->input('biology');
        $marks->total = $request->input('physics')+$request->input('chemistry')+$request->input('biology');
        $marks->save();

        return response()->json($marks);
    }

    function destroy($id){
        $marks = Marks::findOrFail($id)->delete();
        return response()->json($marks);
    }

}
