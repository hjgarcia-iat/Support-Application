<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function edit()
    {
        return view('admin.account.edit');
    }
}