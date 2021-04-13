<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function edit()
    {
        return view('admin.account.edit');
    }

    public function update()
    {
        auth()->user()->update([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => request()->has('password') ? bcrypt(request('password')) : auth()->user()->password,
        ]);

        return redirect(route('admin.account.edit'))
            ->with('success', 'Account was updated.');
    }
}