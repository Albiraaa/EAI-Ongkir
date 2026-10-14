@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @include('partials.flash-message')

        <div class="space-y-4">
            @foreach($users as $user)
                <div class="flex flex-col gap-4 rounded-xl border border-slate-200 p-4 md:flex-row md:items-center md:justify-between">
                    <div class="space-y-1">
                        <div class="font-semibold text-slate-900">{{ $user->name }}</div>
                        <div class="text-sm text-slate-500">{{ $user->email }}</div>
                        <div class="text-sm text-slate-500">{{ $user->phone ?? 'Belum ada nomor' }}</div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $user->role === 'admin' ? 'bg-violet-100 text-violet-700' : 'bg-emerald-100 text-emerald-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                        <a href="{{ route('admin.customers.edit', $user) }}" class="rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700">Edit</a>

                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.customers.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus akun {{ addslashes($user->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-700">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@endsection
