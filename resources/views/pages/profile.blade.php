@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <section class="section-shell py-12">
        <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <h1 class="text-4xl font-black text-slate-900">Profil Saya</h1>
            <form method="POST" action="{{ route('profile.update') }}" class="mt-8 space-y-5">
                @csrf
                @method('PATCH')
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nomor HP</label>
                    <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Alamat</label>
                    <textarea name="address" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">{{ auth()->user()->address ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </section>
@endsection
