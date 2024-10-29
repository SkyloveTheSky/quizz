<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('admin.files.index', compact('files'));
    }

    public function create()
    {
        return view('admin.files.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:mp3,wav|max:20480', // Maximum 20MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('audio_files', 'public');

        File::create([
            'title' => $request->input('title'),
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
        ]);

        return redirect()->route('files.index')->with('success', 'File uploaded successfully.');
    }

    public function destroy(File $file)
    {
        Storage::disk('public')->delete($file->file_path);
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
}
