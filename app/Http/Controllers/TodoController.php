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

    /* Here is the explanation for the code:
    1. First we call the Todo::all() method to retrieve all the todos from the database.
    2. Next we pass the retrieved todos to the todo view. */
    public function index()
    {
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

    /* Here is the explanation for the code:
    1. If the validation fails, we are redirecting the user to the route todos.index and sending the error messages
    2. If the validation passes, we are creating a new record
    3. We are redirecting the user to the route todos.index and sending the success message */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['title' => 'required']);
        if ($validator->fails()) {
            return redirect()->route('todos.index')->withErrors($validator);
        }
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

    /* Here is the explanation for the code:
    1. We retrieve the todo from the database using the id.
    2. We pass the todo to the edit-todo view. */
    public function edit($id)
    {
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

    /* Here is the explanation for the code:
    1. The validator is used to check if the title is empty or not.
    2. If the title is empty, it redirects back to the edit page and shows the error.
    3. If the title is not empty, it takes the todo from the database and updates the title and the is_completed status and saves it back to the database.
    4. Then it redirects back to the index page with the success message. */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['title' => 'required']);
        if ($validator->fails()) {
            return redirect()->route('todos.edit', ['todo' => $id])->withErrors($validator);
        }

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