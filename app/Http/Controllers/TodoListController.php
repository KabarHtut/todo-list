<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoListController extends Controller
{
    public function index(){
        $todos = TodoList::orderBy('created_at', 'desc')->simplePaginate(3);
        return view('todo-list.index',compact('todos'));
    }

    public function store(){
        $validator = request()->validate([
            'title' => ["required"],
            'description' => ["required"]
        ]);

        TodoList::create($validator);
        return redirect()->route('todo.index')->with('success', 'Success!');
    }

    public function edit($id){
        $todo=TodoList::where('id',$id)->first();
        return view('todo-list.edit', compact('todo'));
    }

    public function update($id,Request $request){
        $validator = request()->validate([
            'title' => ["required"],
            'description' => ["required"]
        ]);

        $todo=TodoList::where('id',$id)->first();
        $todo->title=$request->get('title');
        $todo->description = $request->get('description');
        $todo->is_completed=$request->get('is_completed');
        $todo->save();
        return redirect()->route('todo.index')->with('success', 'Success!');
    }

    public function destroy($id){
        TodoList::where('id',$id)->delete();
        return redirect()->route('todo.index')->with('success', 'Deleted!');
    }
}