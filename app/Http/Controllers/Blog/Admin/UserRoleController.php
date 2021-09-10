<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * @param User $user
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignRole(User $user, Role $role)
    {
        if (!auth()->user()->hasPermAnyWay('assign-role')) {
            return redirect()->route('blog.admin.users.show', $user)
                ->withErrors('Нет прав на выполнение этого действия');
        }
        $user->assignRoles($role->slug);
        return redirect()
            ->route('blog.admin.users.show', $user)
            ->with('success', 'Данные пользователя успешно обновлены');
    }

    /**
     * @param User $user
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unassignRole(User $user, Role $role)
    {
        if ( ! auth()->user()->hasPermAnyWay('assign-role')) {
            return redirect()
                ->route('blog.admin.users.show', $user)
                ->withErrors('Нет прав на выполнение этого действия');
        }
        $user->unassignRoles($role->slug);
        return redirect()
            ->route('blog.admin.users.show', $user)
            ->with('success', 'Данные пользователя успешно обновлены');
    }
}
