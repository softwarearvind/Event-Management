<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
    	return view('Admin.index');
    }

    public function role()
    {
    	$roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        $rolesCount = Role::count();
        $permissionsCount = Permission::count();
        $usersWithRoles = \App\Models\User::role('Admin')->count()
                        + \App\Models\User::role('Manager')->count()
                        + \App\Models\User::role('User')->count();

    return view('Admin.roles.index',compact('roles','permissions','rolesCount','permissionsCount','usersWithRoles')
    );
    }


    public function assignPermission(Request $request)
{
    $role = Role::findOrFail($request->role_id);

    $permissions = Permission::whereIn('id', $request->permissions)
                    ->pluck('name')
                    ->toArray();

    $role->syncPermissions($permissions);

    return back()->with('success', 'Permissions Assigned Successfully');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:roles,name'
    ]);

    Role::create([
        'name' => $request->name
    ]);

    return back()->with(
        'success',
        'Role Created Successfully'
    );
}


public function approved()
{
   $products = Product::where('status', 'pending')->get();
   return view('Admin.product.index',compact('products'));
}


public function approve($id)
{
    $product = Product::findOrFail($id);
    $product->update(['status' => 'approved']);

    return back()->with('success', 'Product Approved');
}

public function reject($id)
{
    $product = Product::findOrFail($id);
    $product->update(['status' => 'rejected']);

    return back()->with('error', 'Product Rejected');
}
}
