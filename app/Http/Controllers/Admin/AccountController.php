<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountRequest;

class AccountController extends Controller
{
    public function edit()
    {
        return view('admin.account.edit');
    }

    public function update(AccountRequest  $request)
    {
        auth()->user()->update([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => $request->has('password') ? bcrypt($request->get('password')) : auth()->user()->password,
        ]);

        return redirect(route('admin.account.edit'))
            ->with('type', 'success')
            ->with('status', 'Account was updated.');
    }
}