<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:permissions.index|permissions.show', only: ['index', 'show']),
            new Middleware('permission:permissions.create', only: ['create', 'store']),
            new Middleware('permission:permissions.edit', only: ['edit', 'update']),
            new Middleware('permission:permissions.destroy', only: ['destroy']),
            new Middleware('permission:restoreRecord', only: ['restore']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission
            ::with(['created_by', 'updated_by'])
            ->latest('updated_at')
            ->filter(request()->only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Permission/Index', [
            'permissions' => $permissions,
            'filters' => request()->only('search', 'trashed'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Permission/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3|max:255',
            ]);

            $permission = Permission::create([
                'name' => $request->input('name'),
            ]);
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return $this->getSuccessMessage('permissions.index', $permission, $permission->name, 'created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::withTrashed()->with(['created_by', 'updated_by', 'deleted_by'])->findOrFail($id);
        $activities = $this->getActivityLogs($id, $permission::class);

        return Inertia::render('Permission/Edit', [
            'permission' => $permission,
            'activities' => $activities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    'unique:permissions,name,' . $id . ',id,guard_name,web',
                    'min:3',
                    'max:255',
                ],
            ]);

            $permission = Permission::withTrashed()->findOrFail($id);
            $permission->name = $request->input('name');
            $permission->save();
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return $this->getSuccessMessage('permissions.index', $permission, $permission->name, 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::withTrashed()->findOrFail($id);
        $permission->delete();

        if ($permission !== 0) {
            $this->revokePermissionTo($permission);

            return $this->getSuccessMessage('permissions.index', $permission, $permission->name, 'deleted');
        } else {
            return response([], 404);
        }
    }

    public function restore(Permission $permission)
    {
        $permission->restore();

        return $this->getSuccessMessage('permissions.index', $permission, $permission->name, 'restored');
    }

    /*
     * Detach deleted permission from all Role models.
     * This has to be done manually based on experience.
     * */
    private function revokePermissionTo (Permission $permission): void
    {
        $roles = \App\Models\Role::all();

        foreach ($roles as $role) {
            $role->revokePermissionTo($permission);
        }
    }
}
