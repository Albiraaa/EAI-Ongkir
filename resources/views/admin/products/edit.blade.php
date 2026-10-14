@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Kategori</label>
                    <select name="category_id" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Produk</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Slug</label>
                    <input type="text" name="slug" value="{{ $product->slug }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Harga</label>
                    <input type="number" name="price" value="{{ $product->price }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Harga Banding</label>
                    <input type="number" name="compare_price" value="{{ $product->compare_price ?? '' }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Stok</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="description" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">{{ $product->description }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar Produk</label>
                @if($product->image)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 w-32 rounded-xl object-cover ring-1 ring-slate-200">
                        <form method="POST" action="{{ route('admin.products.remove-image', $product) }}" onsubmit="return confirm('Hapus gambar produk ini dari storage lokal?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">Hapus Gambar</button>
                        </form>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-teal-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="featured" value="1" {{ $product->featured ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500">
                <label class="text-sm font-medium text-slate-700">Produk Featured</label>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                    <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="rounded-xl bg-teal-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-teal-500">Update Produk</button>
        </form>
    </div>
@endsection
