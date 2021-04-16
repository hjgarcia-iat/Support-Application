<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id','<>',auth()->id())->paginate(25);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store()
    {
        User::create([
           'name' => request('name'), 
           'email' => request('email'), 
           'password' => bcrypt(request('password')),
        ]);
        
        return redirect(route('admin.users'))
            ->with('type', 'success')
            ->with('status', 'User was added.');
    }
}