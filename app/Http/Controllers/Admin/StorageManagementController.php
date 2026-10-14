<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageManagementController extends Controller
{
    public function index()
    {
        $files = collect(Storage::disk('public')->allFiles())
            ->filter(fn (string $path) => preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $path))
            ->map(function (string $path) {
                return [
                    'path' => $path,
                    'name' => basename($path),
                    'url' => asset('storage/' . $path),
                    'size' => Storage::disk('public')->size($path),
                    'updated_at' => Storage::disk('public')->lastModified($path),
                ];
            })
            ->sortByDesc('updated_at')
            ->values()
            ->all();

        return view('admin.storage.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:2048'],
        ]);

        $uploaded = 0;

        foreach ($request->file('files', []) as $file) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($originalName) . '-' . time() . '-' . Str::random(4) . '.' . $extension;

            $file->storeAs('uploads', $filename, 'public');
            $uploaded++;
        }

        return redirect()->route('admin.storage.index')->with('success', $uploaded . ' gambar berhasil diupload.');
    }

    public function destroy(string $path)
    {
        $normalizedPath = trim(urldecode($path), '/');

        if ($normalizedPath === '' || ! Storage::disk('public')->exists($normalizedPath)) {
            return redirect()->route('admin.storage.index')->with('error', 'File tidak ditemukan.');
        }

        Storage::disk('public')->delete($normalizedPath);

        return redirect()->route('admin.storage.index')->with('success', 'Gambar berhasil dihapus dari storage lokal.');
    }
}
