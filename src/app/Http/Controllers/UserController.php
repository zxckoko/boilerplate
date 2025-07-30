<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User
            ::with(['created_by', 'updated_by'])
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
        return Inertia::render('User/Create');
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
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make('password'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return Inertia::render('User/Edit', [
            'user' => $user,
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
            ]);

            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->address_1 = $request->input('address_1');
            $user->address_2 = $request->input('address_2');
            $user->updated_by = auth()->user()->id;
            $user->updated_at = now();
            $user->save();
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
        $user = User::find($id);
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
