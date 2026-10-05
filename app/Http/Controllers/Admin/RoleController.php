<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])
            ->orderBy('id', 'asc')
            ->get();

        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissionsGrouped = Permission::all()->groupBy('group');

        return view('backend.roles.create', compact('permissionsGrouped'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        if (!$request->filled('slug') && $request->filled('name')) {
            $request->merge(['slug' => Str::slug($request->name)]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:roles,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role = Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'is_system' => false,
        ]);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'নতুন রোল সফলভাবে তৈরি করা হয়েছে এবং পারমিশন অ্যাসাইন করা হয়েছে।');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissionsGrouped = Permission::all()->groupBy('group');
        $assignedPermissionIds = $role->permissions->pluck('id')->toArray();

        return view('backend.roles.edit', compact('role', 'permissionsGrouped', 'assignedPermissionIds'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        if (!$request->filled('slug') && $request->filled('name')) {
            $request->merge(['slug' => Str::slug($request->name)]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'slug')->ignore($role->id),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        // Protect system role slug
        $slug = $role->is_system ? $role->slug : Str::slug($request->slug);

        $role->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        // Sync permissions
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'রোল ও পারমিশন সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if ($role->is_system) {
            return redirect()
                ->route('admin.roles.index')
                ->with('error', 'সিস্টেম নির্ধারিত রোল (Super Admin) মুছে ফেলা সম্ভব নয়।');
        }

        if ($role->users()->count() > 0) {
            return redirect()
                ->route('admin.roles.index')
                ->with('error', 'এই রোলের অধীনে ' . $role->users()->count() . ' জন ব্যবহারকারী রয়েছে। ডিলিট করার পূর্বে ব্যবহারকারীদের রোল পরিবর্তন করুন।');
        }

        $role->permissions()->detach();
        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'রোলটি সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
