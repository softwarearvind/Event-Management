<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
   {
    $users = User::when($request->search,function($q) use($request){

        $q->where('name','like','%'.$request->search.'%')
          ->orWhere('email','like','%'.$request->search.'%');

    })->latest()->paginate(10);
    $roles = Role::all();

    return view('Admin.users.index',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required',
        'role'=>'required'
    ]);

    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
    ]);

    $user->assignRole($request->role);

     return redirect()->back()->with('success', 'User Added Successfully');
    }

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $user = User::findOrFail($id);

    return response()->json($user);
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $user = User::findOrFail($id);

    $user->update([
        'name'=>$request->name,
        'email'=>$request->email,
    ]);

    $user->syncRoles([$request->role]);

    return back()->with('success','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

    $user->delete();

    return redirect()->back()
        ->with('error', 'User Deleted Successfully');

    }
}
