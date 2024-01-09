<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function TypeView()
    {
        $types = Type::all();
        return view('dashboard.createtype', compact('types'));
    }




    public function store(Request $request) {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama_type' => 'required|unique:types,nama_type'
        ]);

        Type::create($validatedData);
        return redirect("/dashboard/type")->with('success', 'Successfully added a new Post!');
    }







    public function delete($id)
    {
        $type = Type::find($id);

        if ($type) {
            $type->delete();
            return redirect('/dashboard/type')->with('success', 'Post deleted successfully');
        } else {
            return redirect('/dashboard/type')->with('error', 'Post not found');
        }
    }

}
