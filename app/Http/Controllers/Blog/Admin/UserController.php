<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('perm:manage-users')->only('index');
        $this->middleware('perm:edit-user')->only(['edit', 'update']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::paginate(2);

        return view('blog.admin.users.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $allroles = Role::all();
        $allperms = Permission::all();

        return view('blog.admin.users.edit', compact('user', 'allperms', 'allroles'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $result = null;

        if ($request->change_password) {    // если надо изменить пароль
            $request->merge(['password' => Hash::make($request->password)]);
            $result = $user->update($request->all());
        } else {
            $result = $user->update($request->except('password'));
        }

        $user->roles()->sync($request->roles);
        $user->permissions()->sync($request->perms);

        if ($result) {
            return redirect()->route('blog.admin.users.index')
                ->with('success', "Данные пользователя [$user->id] успешно обновлены");
        }

        return back()->withErrors(['msg' => "Ошибка сохранения id=[$user->id]"])->withInput();
    }
}
