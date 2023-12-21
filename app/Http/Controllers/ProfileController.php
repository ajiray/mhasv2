<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use Chatify\Facades\ChatifyMessenger as Chatify;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;



class ProfileController extends Controller
{
    public function profileupdate()
    {
        $user = User::find(auth()->id());
        return view('update-profile-photo', compact('user'));
    }
    public function edit(){
        $user = User::find(auth()->id());
        return view('editaboutme', compact('user'));
    }
    public function edit_aboutme(Request $request)
    {
        $aboutmeData = $request->validate([
            'aboutme' => 'required|max:2000',
        ]);
    
        $aboutmeData['aboutme'] = strip_tags($aboutmeData['aboutme']);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Update the about_me field for the current user
        $user->update(['aboutme' => $aboutmeData['aboutme']]);

        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        return view('profile', ['posts' => $posts],['users' => $user]);
    }
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function update_avatar(Request $request) {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
        
            // Allowed extensions
            $allowed_images = Chatify::getAllowedImages();
        
            // Check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                // Check file extension
                if (in_array(strtolower($file->extension()), $allowed_images)) {
                    // Delete the older avatar
                    if (Auth::user()->avatar != config('chatify.user_avatar.default')) {
                        $avatar = Auth::user()->avatar;
                        if (Chatify::storage()->exists($avatar)) {
                            Chatify::storage()->delete($avatar);
                        }
                    }
        
                    // Generate a new filename using UUID and file extension
                    $avatar = Str::uuid() . "." . $file->extension();
        
                    // Update the user's avatar in the database
                    $update = User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
        
                    // Store the file
                    $file->storeAs(config('chatify.user_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
        
                    // Check if the update was successful
                    $success = $update ? 1 : 0;
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            } else {
                $msg = "File size you are trying to upload is too large!";
                $error = 1;
            }
        }
    
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        return view('profile', ['posts' => $posts],['users' => $user]);
    }

}
