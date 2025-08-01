<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller implements HasMiddleware
{
    /*
     * EITHER: https://github.com/spatie/laravel-permission/blob/main/docs/basic-usage/middleware.md#controllers
     * OR: https://spatie.be/docs/laravel-permission/v6/best-practices/using-policies
     * (OR)
     * */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:users.index|users.show', only: ['index', 'show']),
            new Middleware('permission:users.create', only: ['create', 'store']),
            new Middleware('permission:users.edit', only: ['edit', 'update']),
            new Middleware('permission:users.destroy', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User
            ::withTrashed()
            ->with(['updated_by', 'roles'])
            ->latest('updated_at')
            ->paginate(10);

        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create', [
            'roles' => Role::pluck('name')->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|string|lowercase|email|min:3|max:255|unique:users,email',
                'roles' => 'required|array',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make('password'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $user->syncRoles($request->input('roles'));
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return to_route('users.index')
            ->with('message', sprintf($this->successMessage, class_basename($user), $user->name, 'created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd(69);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::withTrashed()->with(['created_by', 'updated_by', 'deleted_by'])->findOrFail($id);
        $userRoles = $user->roles()->pluck('name')->all();
        $roles = Role::pluck('name')->all();
        $activities = $this->getActivityLogs($id, $user::class);

        return Inertia::render('User/Edit', [
            'user' => $user,
            'userRoles' => $userRoles,
            'roles' => $roles,
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
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|string|lowercase|email|min:3|max:255|unique:users,email,' . $id,
                'roles' => 'required|array',
            ]);

            $user = User::withTrashed()->findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->address_1 = $request->input('address_1');
            $user->address_2 = $request->input('address_2');
            $user->updated_by = auth()->user()->id;
            $user->updated_at = now();
            $user->save();

            $user->syncRoles($request->input('roles'));
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }

        return to_route('users.index')
            ->with('message', sprintf($this->successMessage, class_basename($user), $user->name, 'updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->deleted_by = auth()->user()->id;
        $user->deleted_at = now();
        $user->save();

        if ($user !== 0) {
            return to_route('users.index')
                ->with('message', sprintf($this->successMessage, class_basename($user), $user->name, 'deleted'));
        } else {
            return response([], 404);
        }
    }
}
