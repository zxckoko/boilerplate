<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission
            ::with(['created_by', 'updated_by'])
            ->latest('updated_at')
            ->paginate(10);

        return Inertia::render('Permission/Index', [
            'permissions' => $permissions,
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
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return to_route('permissions.index')
            ->with('message',
                sprintf($this->successMessage, class_basename($permission), $permission->name, 'created')
            );
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
        return Inertia::render('Permission/Edit', [
            'permission' => Permission::with(['created_by', 'updated_by'])->find($id),
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

            $permission = Permission::find($id);
            $permission->name = $request->input('name');
            $permission->updated_by = auth()->user()->id;
            $permission->updated_at = now();
            $permission->save();
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return to_route('permissions.index')
            ->with('message', sprintf($this->successMessage, class_basename($permission), $permission->name, 'updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->deleted_by = auth()->user()->id;
        $permission->deleted_at = now();
        $permission->save();

        if ($permission !== 0) {
            return to_route('permissions.index')
                ->with('message',
                    sprintf($this->successMessage, class_basename($permission), $permission->name, 'deleted')
                );
        } else {
            return response([], 404);
        }
    }
}
