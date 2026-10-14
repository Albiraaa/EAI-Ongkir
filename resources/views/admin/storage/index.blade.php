@extends('layouts.admin')

@section('title', 'Storage Management')
@section('page-title', 'Management Storage')

@section('content')
    <div class="space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Upload Gambar</h2>
                    <p class="text-sm text-slate-500">Kelola semua file gambar yang tersimpan di storage lokal.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.storage.upload') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Pilih Gambar</label>
                    <input type="file" name="files[]" multiple accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-teal-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
                </div>
                <button type="submit" class="rounded-xl bg-teal-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-teal-500">Upload Gambar</button>
            </form>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-5 flex items-center justify-between gap-3">
                <h2 class="text-xl font-bold text-slate-900">Daftar Gambar</h2>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-600">{{ count($files) }} file</span>
            </div>

            @if(empty($files))
                <div class="rounded-xl border border-dashed border-slate-200 bg-slate-50 px-4 py-8 text-center text-sm text-slate-500">
                    Belum ada gambar di storage lokal.
                </div>
            @else
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($files as $file)
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 shadow-sm">
                            <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="h-48 w-full object-cover">
                            <div class="space-y-3 p-4">
                                <div class="text-sm font-semibold text-slate-800 break-all">{{ $file['name'] }}</div>
                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <span>{{ number_format($file['size'] / 1024, 1) }} KB</span>
                                    <span>{{ date('d M Y', $file['updated_at']) }}</span>
                                </div>
                                <form method="POST" action="{{ route('admin.storage.destroy', ['path' => $file['path']]) }}" onsubmit="return confirm('Hapus gambar ini dari storage lokal?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
