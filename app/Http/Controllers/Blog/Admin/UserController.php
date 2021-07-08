<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('perm:manage-users')->only('index');
        $this->middleware('perm:edit-user')->only(['edit', 'update']);
    }

    public function index()
    {
        $users = User::all();
        dd(__METHOD__, $users);
    }

    public function show(User $user)
    {
        dd(__METHOD__, $user);
    }

    public function edit(User $user)
    {
        dd(__METHOD__, $user);
    }

    public function update(Request $request, User $user)
    {
        dd(__METHOD__, $user,$request);
    }
}
