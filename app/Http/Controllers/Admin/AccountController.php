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
            'password' => bcrypt(request('password')),
        ]);

        return redirect(route('admin.account.edit'))
            ->with('success', 'Account was updated.');
    }
}