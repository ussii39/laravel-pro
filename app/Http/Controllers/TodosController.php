<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title'=> 'required|string',
            'completed' => 'required|boolean'
        ]);

        $todo = Todo::create($data);

        return response($todo,201);
    }

    public function show($id)
    {
        // Get Article
        $data = Todo::findOrFail($id);

        // Return single article as a resource
        return response($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title'=> "required|string",
            'completed' => 'required|boolean'
        ]);

        $todo->update($data);

        return response($todo,200);
    }

   public function updateAll(Request $request)
   {
        $data = $request->validate([
           'completed' => 'required|boolean'
        ]);

        Todo::query()->update($data);
        return response ('Update',200);
   }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response($todo,200);
    }

    public function destroyCompleted(Request $request)
    {
         $request->validate([
            'todos' => 'required|array'
         ]);

         Todo::destroy($request->todos);

        return response('Delete todo item',200);
    }
}

//VXUZFndbtBXKASetaWGxkxSZHetG19DP2tBfEzFo
//8dd0IFsusRDfHfGizb4M8yZMw9GjJG8ERaRRM9GM
