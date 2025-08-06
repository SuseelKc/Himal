<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Multimedia::latest()->get();
        return view('multimedia.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('multimedia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'file' => 'required|file',
        ]);

        if ($request->type === 'image') {
            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png,webp|max:20480', // 20MB
            ]);
            
            // Temporarily disable image dimension check
            // $image = Image::make($request->file('file'));
            // if ($image->width() > 1920 || $image->height() > 1080) {
            //     return back()->withErrors(['file' => 'Image exceeds 1920x1080 resolution limit.']);
            // }
        } else {
            $request->validate([
                'file' => 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/webm|max:204800', // 200MB
            ]);
        }

        try {
            // Store the file in the appropriate directory
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            if ($request->type === 'image') {
                // Store images in storage/app/public/images
                $path = $file->storeAs('images', $fileName, 'public');
                $filePath = 'images/' . $fileName;
            } else {
                // Store videos in storage/app/public/videos
                $path = $file->storeAs('videos', $fileName, 'public');
                $filePath = 'videos/' . $fileName;
            }
            
            // Create the multimedia record
            $multimedia = Multimedia::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
                'type' => $request->type,
            ]);

            return redirect()->route('multimedia.index')->with('success', 'File uploaded successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Error uploading file: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $multimedia = Multimedia::findOrFail($id);
        return view('multimedia.show', compact('multimedia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $multimedia = Multimedia::findOrFail($id);
        return view('multimedia.edit', compact('multimedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $multimedia = Multimedia::findOrFail($id);
        $multimedia->update($request->only('title', 'description'));

        return redirect()->route('multimedia.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $multimedia = Multimedia::findOrFail($id);
        
        try {
            // Delete the file from storage
            if (Storage::disk('public')->exists($multimedia->file_path)) {
                Storage::disk('public')->delete($multimedia->file_path);
            }
            
            $multimedia->delete();
            return redirect()->route('multimedia.index')->with('success', 'Deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('multimedia.index')->with('error', 'Error deleting file: ' . $e->getMessage());
        }
    }

    /**
     * Display public portfolio page
     */
    public function portfolio()
    {
        $media = Multimedia::latest()->get();
        return view('portfolio', compact('media'));
    }
}
