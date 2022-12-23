<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the todos in our index function.
        $todos = Todo::all();
        return view('todo', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validating the request using Laravel Validator functionality.
        // We are validating that title is required always.
        $validator = Validator::make($request->all(), ['title' => 'required']);
        // If it’s not present, return to route('todos.index') which is the main page of our application with the error.
        if ($validator->fails()) {
            return redirect()->route('todos.index')->withErrors($validator);
        }
        // If its present, then we are calling the Todo Model we created before with the create function
        // to store the todo in the table of todos.
        Todo::create(['title' => $request->get('title')]);
        return redirect()->route('todos.index')->with('success', 'Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Have id being passed, that id will be basically id of the todo item which details we want to load.
        $todo = Todo::where('id', $id)->first();
        return view('edit-todo', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), ['title' => 'required']);
        if ($validator->fails()) {
            return redirect()->route('todos.edit', ['todo' => $id])->withErrors($validator);
        }

        // Saving the title and the selected is_completed status using laravel save() function and redirecting back to the index function.
        $todo = Todo::where('id', $id)->first();
        $todo->title = $request->get('title');
        $todo->is_completed = $request->get('is_completed');
        $todo->save();
        return redirect()->route('todos.index')->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}