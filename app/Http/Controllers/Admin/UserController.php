<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        if ($request->filled('status')) {
            $query->where('status', (bool)$request->status);
        }

        $users = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        $roles = Role::orderBy('id', 'asc')->get();

        return view('backend.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::orderBy('id', 'asc')->get();

        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:6'],
            'role_id' => ['required', 'exists:roles,id'],
            'status' => ['nullable', 'boolean'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->boolean('status', true),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'নতুন ব্যবহারকারী সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('id', 'asc')->get();

        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => ['nullable', 'string', 'min:6'],
            'role_id' => ['required', 'exists:roles,id'],
            'status' => ['nullable', 'boolean'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'status' => $request->boolean('status', true),
        ];

        // Prevent disabling or demoting own logged in account
        if ($user->id === auth()->id()) {
            $data['status'] = true;
            if ($user->isSuperAdmin()) {
                $superAdminRole = Role::where('slug', 'super-admin')->first();
                if ($superAdminRole) {
                    $data['role_id'] = $superAdminRole->id;
                }
            }
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'ব্যবহারকারীর তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'আপনি নিজের অ্যাকাউন্ট নিষ্ক্রিয় করতে পারবেন না।');
        }

        $user->status = !$user->status;
        $user->save();

        $statusText = $user->status ? 'সক্রিয় (Active)' : 'নিষ্ক্রিয় (Inactive)';

        return redirect()
            ->route('admin.users.index')
            ->with('success', "ব্যবহারকারী স্ট্যাটাস পরিবর্তন করে {$statusText} করা হয়েছে।");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'আপনি নিজের অ্যাকাউন্ট মুছে ফেলতে পারবেন না।');
        }

        if ($user->isSuperAdmin()) {
            $superAdminCount = User::whereHas('role', function ($q) {
                $q->where('slug', 'super-admin');
            })->count();

            if ($superAdminCount <= 1) {
                return redirect()
                    ->route('admin.users.index')
                    ->with('error', 'সিস্টেমে অন্তত একজন সুপার অ্যাডমিন থাকা আবশ্যক।');
            }
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'ব্যবহারকারী সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
