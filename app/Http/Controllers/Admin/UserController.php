<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '<>', auth()->id());

        if (request()->has('query')) {
            $users = $users->where('name', 'LIKE', "%" . request('query') . "%")
                ->orWhere('email', 'LIKE', "%" . request('query') . "%");
        }

        $users = $users->paginate(25);

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

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => ($request->get('password') != null) ? bcrypt($request->get('password')) : $user->password,
        ]);

        return redirect(route('admin.users.edit', $user))
            ->with('type', 'success')
            ->with('status', 'User was updated.');
    }

    public function delete(User $user): \Illuminate\Http\RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('type', 'success')
            ->with('status', 'User was deleted.');
    }
}