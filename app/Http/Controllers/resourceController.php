<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewResourceNotification;
use App\Models\Resource; // Make sure to import the Resource model

class ResourceController extends Controller // Correct the capitalization of your class name
{
    public function storeResource(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file_content' => 'nullable|file|mimes:pdf,epub,mobi|max:51200',
            'file_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
            'category' => 'required|in:pdf,infographic,ebook,video|max:51200',
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv|max:551200',
            'infographic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
            'ebook' => 'nullable|file|mimes:pdf,epub,mobi|max:10240|max:51200',
        ]);
    
        // Create a new Resource record in the database
        $resource = new Resource();
        $resource->title = $validatedData['title'];
        $resource->description = $validatedData['description'];
        $resource->category = $validatedData['category'];

        // Check if the user is an admin (is_admin == 1)
    if (auth()->user()->is_admin == 1) {
        $redirectPath = '/adminresources';
    } elseif (auth()->user()->is_admin == 2) {
        // Check if the user is a guidance admin (assuming is_admin == 2 for guidance admin)
        $redirectPath = '/guidanceresources';
    }
    
        // Conditionally handle the file uploads based on the category
        if ($validatedData['category'] === 'pdf') {
            // Handle file uploads
            if ($request->hasFile('file_content') && $request->hasFile('file_cover')) {
                $file = $request->file('file_content');
                $coverPhoto = $request->file('file_cover');
    
                // Handle resource file upload
                $fileName = $file->getClientOriginalName();
                $file->storeAs('resources', $fileName, 'public');
    
                // Handle cover photo upload
                $coverPhotoName = $coverPhoto->getClientOriginalName();
                $coverPhoto->storeAs('covers', $coverPhotoName, 'public');
    
                $resource->file_content = $fileName; // Store the file path in the database
                $resource->file_cover = $coverPhotoName; // Store the cover photo path in the database
            } else {
                return redirect($redirectPath)->with('error', 'File upload failed');
            }
        } elseif ($validatedData['category'] === 'infographic') { 
            // Handle infographic file upload
            if ($request->hasFile('infographic')) {
                $infographic = $request->file('infographic');
                
                $infographicName = $infographic->getClientOriginalName();
                $infographic->storeAs('resources', $infographicName, 'public');
    
                $resource->file_content = $infographicName;
            } else {
                return redirect($redirectPath)->with('error', 'File upload failed');
            }
        } elseif ($validatedData['category'] === 'ebook') {
            // Handle ebook file upload
            if ($request->hasFile('ebook')) {
                $ebook = $request->file('ebook');
                $coverPhoto = $request->file('file_cover');
                
                $ebookName = $ebook->getClientOriginalName();
                $ebook->storeAs('resources', $ebookName, 'public');
                $coverPhotoName = $coverPhoto->getClientOriginalName();
                $coverPhoto->storeAs('covers', $coverPhotoName, 'public');
    
                $resource->file_content = $ebookName;
                $resource->file_cover = $coverPhotoName;
            } else {
                return redirect($redirectPath)->with('error', 'File upload failed');
            }
        }
    
        // Continue handling other categories (video, etc.)...
    
        if ($validatedData['category'] === 'video') {
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                
                $videoName = $video->getClientOriginalName();
                $video->storeAs('resources', $videoName, 'public');
                $resource->file_content = $videoName;
            } else {
                return redirect($redirectPath)->with('error', 'Invalid YouTube link');
            }
        }
        $resourceTitle = $validatedData['title'];
        $resourceCategory = $validatedData['category'];
        $nonAdminUsers = User::where('is_admin', 0)->get();

    foreach ($nonAdminUsers as $user) {
        $user->notify(new NewResourceNotification($resourceTitle, $resourceCategory));
    }
        $resource->save();
    
        return redirect($redirectPath)->with('success', 'Resource uploaded successfully');
    }
    



public function getResources(Request $request)
{
    $categories = $request->input('categories');
    if ($categories) {
        $resources = Resource::whereIn('category', $categories)->get();
    } else {
        $resources = Resource::all();
    }

    return response()->json($resources);
}

public function deleteResource(Resource $resource)
{
    // Delete the resource files from public storage
    if ($resource->category === 'infographic' && $resource->file_content) {
        Storage::disk('public')->delete('resources/' . $resource->file_content);
    } elseif (in_array($resource->category, ['pdf', 'ebook']) && $resource->file_cover && $resource->file_content) {
    Storage::disk('public')->delete('covers/' . $resource->file_cover);
    Storage::disk('public')->delete('resources/' . $resource->file_content);
} elseif ($resource->category === 'video' && $resource->file_content) {
        Storage::disk('public')->delete('resources/' . $resource->file_content);
    }

    // Delete the resource from the database
    $resource->delete();

    // Check if the user is an admin (is_admin == 1)
    if (auth()->user()->is_admin == 1) {
        $redirectPath = '/adminresources';
    } elseif (auth()->user()->is_admin == 2) {
        // Check if the user is a guidance admin (assuming is_admin == 2 for guidance admin)
        $redirectPath = '/guidanceresources';
    }

    return redirect($redirectPath)->with('success', 'Resource deleted successfully');
}

}
