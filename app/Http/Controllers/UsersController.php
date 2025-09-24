<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\stringContains;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $registrations = null)
    {
        $is_student = str_contains($request->url(), 'students');
        $users = User::when($request->has('name'), function ($query) use ($request) {

            $query->where('name', 'like', '%' . $request->name . '%');

        })->when($request->has('reg_number'), function ($query) use ($request) {
            $query->where('reg_number', 'like', '%' . $request->reg_number . '%');
        })->when($request->has('email'), function ($query) use ($request) {
            $query->where('email', 'like', '%' . $request->email . '%');
        })->when($is_student, function ($query) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', 'Student');
            });
        })->paginate(config('app.pagination'));
        return view('users.index', compact('is_student'))->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $is_student = str_contains($request->url(), 'students');
        $roles = Role::whereNotIn('name', ['Super Admin', 'Student'])->get();
        return view('users.create', compact('is_student', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "role" => "required",
            'reg_number' => 'nullable|unique:users,reg_number',
            'phone' => 'nullable|unique:users,phone'
        ]);

        $data['password'] = Hash::make('password');
        $user = User::create($data);
        $user->syncRoles($request->role);
        toast('User created successfully', 'success');
        return redirect()->route(($request->is_student ? 'students' : 'users') . '.index', ['registrations']);
    }

    /**
     * Display the specified resource.
     */
    public function assign(string $id)
    {
        return view('users.assign')->with('user', User::findOrFail($id));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user)
    {
        $is_student = str_contains($request->url(), 'students');
        $roles = Role::whereNotIn('name', ['Super Admin', 'Student'])->get();
        return view('users.edit ')->with('user', $user)->with('roles', $roles)->with('is_student', $is_student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required",
            "role" => "required",
            'reg_number' => 'nullable',
            'phone' => 'nullable|unique:users,phone,' . $user->id

        ]);
        $user->update($data);
        $user->syncRoles($request->role);
        toast('Profile updated successfully!', 'success');
        return back();

    }

    /**
     * Update the specified resource in storage.
     */
    public function passwordChange(Request $request, string $id)
    {
        $request->validate([
            "password_confirmation" => "required",
            "password" => "required",
        ]);
        if ($request->password != $request->password_confirmation) {
            toast('Password does not match!', 'warning');
            return back();
        }

        User::findOrFail($id)->update(['password' => Hash::make($request->password)]);
        toast('Profile updated successfully!', 'success');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
