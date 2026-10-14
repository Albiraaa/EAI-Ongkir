@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar Kategori</label>
                @if($category->image)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-24 w-24 rounded-xl object-cover ring-1 ring-slate-200">
                        <form method="POST" action="{{ route('admin.categories.remove-image', $category) }}" onsubmit="return confirm('Hapus gambar kategori ini dari storage lokal?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">Hapus Gambar</button>
                        </form>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-teal-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-xl bg-teal-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-teal-500">Update Kategori</button>
                <a href="{{ route('admin.categories.index') }}" class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Kembali</a>
            </div>
        </form>
    </div>
@endsection
