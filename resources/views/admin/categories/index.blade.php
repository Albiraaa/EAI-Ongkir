@extends('layouts.admin')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-1">
            <h2 class="text-xl font-bold text-slate-900">Tambah Kategori</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Kategori</label>
                    <input type="text" name="name" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none"></textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar Kategori</label>
                    <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-teal-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
                </div>
                <button type="submit" class="w-full rounded-xl bg-teal-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-teal-500">Simpan Kategori</button>
            </form>
        </div>

        <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-bold text-slate-900">Daftar Kategori</h2>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $categories->total() }} Total</span>
            </div>

            <div class="mt-4 space-y-3">
                @foreach($categories as $category)
                    <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 md:flex-row md:items-center md:justify-between">
                        <div class="flex items-center gap-4">
                            <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $category->name }}" class="h-16 w-16 rounded-xl object-cover ring-1 ring-slate-200">
                            <div class="space-y-1">
                                <div class="font-semibold text-slate-900">{{ $category->name }}</div>
                                <div class="text-sm text-slate-500">{{ $category->products_count ?? 0 }} produk</div>
                                <div class="text-xs font-medium uppercase tracking-[0.16em] text-slate-400">{{ $category->slug }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ addslashes($category->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
