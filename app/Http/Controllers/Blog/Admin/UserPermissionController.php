<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function assignPermission(User $user, Permission $permission)
    {
        if ( ! auth()->user()->hasPermAnyWay('assign-permission')) {
            return redirect()
                ->route('blog.admin.users.show', $user)
                ->withErrors('Нет прав на выполнение этого действия');
        }

        $user->assignPermissions($permission->slug);

        return redirect()
            ->route('blog.admin.users.show', $user)
            ->with('success', 'Данные пользователя успешно обновлены');
    }

    public function unassignPermission(User $user, Permission $permission)
    {
        if ( ! auth()->user()->hasPermAnyWay('assign-permission')) {
            return redirect()
                ->route('blog.admin.users.show', $user)
                ->withErrors('Нет прав на выполнение этого действия');
        }
        $user->unassignPermissions($permission->slug);
        return redirect()
            ->route('blog.admin.users.show', $user)
            ->with('success', 'Данные пользователя успешно обновлены');
    }
}
