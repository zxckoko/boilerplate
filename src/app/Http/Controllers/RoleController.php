<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:roles.index|roles.show', only: ['index', 'show']),
            new Middleware('permission:roles.create', only: ['create', 'store']),
            new Middleware('permission:roles.edit', only: ['edit', 'update']),
            new Middleware('permission:roles.destroy', only: ['destroy']),
            new Middleware('permission:restoreRecord', only: ['restore']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role
            ::with(['created_by', 'updated_by', 'permissions'])
            ->latest('updated_at')
            ->filter(request()->only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Role/Index', [
            'roles' => $roles,
            'filters' => request()->only('search', 'trashed'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Role/Create', [
            'permissions' => Permission::pluck('name')->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3|max:255',
                'permissions' => 'required|array',
            ]);

            $role = Role::create([
                'name' => $request->input('name'),
            ]);

            $role->syncPermissions($request->input('permissions'));
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return $this->getSuccessMessage('roles.index', $role, $role->name, 'created');
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
        $role = Role::withTrashed()->with(['created_by', 'updated_by', 'deleted_by'])->findOrFail($id);
        $activities = $this->getActivityLogs($id, $role::class);

        return Inertia::render('Role/Edit', [
            'role' => $role,
            'rolePermissions' => $role->permissions()->pluck('name')->all(),
            'permissions' => Permission::pluck('name')->all(),
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
                    'unique:roles,name,' . $id . ',id,guard_name,web',
                    'min:3',
                    'max:255',
                ],
                'permissions' => 'required|array',
            ]);

            $role = Role::withTrashed()->findOrFail($id);
            $role->name = $request->input('name');
            $role->save();

            $role->syncPermissions($request->input('permissions'));
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return $this->getSuccessMessage('roles.index', $role, $role->name, 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::withTrashed()->findOrFail($id);
        $role->delete();

        if ($role !== 0) {
            return $this->getSuccessMessage('roles.index', $role, $role->name, 'deleted');
        } else {
            return response([], 404);
        }
    }

    public function restore(Role $role)
    {
        $role->restore();

        return $this->getSuccessMessage('roles.index', $role, $role->name, 'restored');
    }
}
