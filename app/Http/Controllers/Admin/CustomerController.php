<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(12);

        return view('admin.customers.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.customers.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'role' => ['required', 'in:customer,admin'],
        ]);

        $currentUserId = Auth::id();

        if ($user->id === $currentUserId && $validated['role'] !== 'admin') {
            return back()->with('error', 'Anda tidak bisa mengubah peran akun Anda sendiri menjadi customer.');
        }

        $user->update($validated);

        return redirect()->route('admin.customers.index')->with('success', 'Akun pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($user->role === 'admin') {
            $adminCount = User::where('role', 'admin')->count();

            if ($adminCount <= 1) {
                return back()->with('error', 'Minimal harus ada satu admin aktif di sistem.');
            }
        }

        $user->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
