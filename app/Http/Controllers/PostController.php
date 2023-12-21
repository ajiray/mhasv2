<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{

    public function deletePost(Post $post)
{
    // Delete related reactions first
    $post->reactions()->delete();
    
    $post->comments()->delete();
    
    // Now delete the post
    $post->delete();
    return redirect('/wall')->with('delete', 'Success! Your post has been deleted');
     
}
public function deletePostProfile(Post $post)
{
    // Delete related reactions first
    $post->reactions()->delete();
    
    $post->comments()->delete();
    
    // Now delete the post
    $post->delete();
    return redirect('/profile')->with('delete', 'Success! Your post has been deleted');
     
}


    
public function createPost(Request $request)
{
    $incomingFields = $request->validate([
        'body' => 'required|max:200'
    ]);

    $profanityWords = ['bobo', 'tanga', 'patay', 'fuck','inutil', 'nigga', 'puta', 'tangina', 'gago','mamatay', 'suicide', 'Putang ina mo', 'Walang hiya', 'Tae', 'Punyeta', 'Pakshet', 'Bwisit', 'Leche', 'Hayop', 'Lintik', 'Tarantado', 'kantot', 'pokpok', 'slut', 'motherfucker', 'vovo', 'wtf', 'panget', 'Hayup', 'bitch'];

    foreach ($profanityWords as $word) {
        if (stripos($incomingFields['body'], $word) !== false) {
            
            return redirect('/wall')->with('profanity', 'Your post contains inappropriate content.');
    
        }
    }
    
    $incomingFields['body'] = strip_tags($incomingFields['body']);
    $incomingFields['user_id'] = auth()->id();

    // Check if the "anonymous" checkbox is selected
    $isAnonymous = $request->has('anonymous');
    $incomingFields['anonymous'] = $isAnonymous;
    

    Post::create($incomingFields);

    // Redirect to the appropriate page based on whether the post is anonymous or not
    if ($isAnonymous) {
        return redirect('/wall')->with('success', 'Success! Your anonymous post has been published');
    } else {
        return redirect('/wall')->with('success', 'Success! Your post has been published');
    }

}


public function createPostAdmin(Request $request) {
    $incomingFields = $request->validate([
        'body' => 'required|max:200'
    ]); 

    $profanityWords = ['bobo', 'tanga', 'patay', 'fuck','inutil', 'nigga', 'puta', 'tangina', 'gago','mamatay', 'suicide', 'Putang ina mo', 'Walang hiya', 'Tae', 'Punyeta', 'Pakshet', 'Bwisit', 'Leche', 'Hayop', 'Lintik', 'Tarantado', 'kantot', 'pokpok', 'slut', 'motherfucker', 'vovo', 'wtf', 'panget', 'Hayup', 'bitch'];

    foreach ($profanityWords as $word) {
        if (stripos($incomingFields['body'], $word) !== false) {

            $redirectPath = '/adminwall'; // Default redirect path for non-admin users

    // Check if the user is an admin (is_admin == 1)
    if (auth()->user()->is_admin == 1) {
        $redirectPath = '/adminwall';
    } elseif (auth()->user()->is_admin == 2) {
        // Check if the user is a guidance admin (assuming is_admin == 2 for guidance admin)
        $redirectPath = '/guidancewall';
    }
            
            return redirect($redirectPath)->with('profanity', 'Your post contains inappropriate content.');
    
        }
    }

    $incomingFields['body'] = strip_tags($incomingFields['body']);
    $incomingFields['user_id'] = auth()->id();

    // Check if the announcement checkbox is checked
    $incomingFields['announcement'] = $request->has('announcement');

    Post::create($incomingFields);

    $redirectPath = '/adminwall'; // Default redirect path for non-admin users

    // Check if the user is an admin (is_admin == 1)
    if (auth()->user()->is_admin == 1) {
        $redirectPath = '/adminwall';
    } elseif (auth()->user()->is_admin == 2) {
        // Check if the user is a guidance admin (assuming is_admin == 2 for guidance admin)
        $redirectPath = '/guidancewall';
    }

    return redirect($redirectPath)->with('success', 'Success! Your post has been published');
}

public function deletePostAdmin(Post $post) {
    $post->reactions()->delete();
    $post->comments()->delete();
    $post->delete();

    $redirectPath = '/adminwall'; // Default redirect path for non-admin users

    // Check if the user is an admin (is_admin == 1)
    if (auth()->user()->is_admin == 1) {
        $redirectPath = '/adminwall';
    } elseif (auth()->user()->is_admin == 2) {
        // Check if the user is a guidance admin (assuming is_admin == 2 for guidance admin)
        $redirectPath = '/guidancewall';
    }

    return redirect($redirectPath)->with('delete', 'Success! The post has been deleted');
}


public function heartReact(Post $post) {
    $user = auth()->user();

    // Check if the user has already reacted to this post
    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'heart')->first();

    if ($existingReaction) {
        // The user has already reacted, so remove the reaction
        $existingReaction->delete();
    } else {
        // The user hasn't reacted, so add a heart reaction
        $post->reactions()->create([
            'type' => 'heart',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}

public function likeReact(Post $post) {
    $user = auth()->user();

    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'like')->first();

    if ($existingReaction) {
       
        $existingReaction->delete();
    } else {
     
        $post->reactions()->create([
            'type' => 'like',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}

public function hahaReact(Post $post) {
    $user = auth()->user();


    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'haha')->first();

    if ($existingReaction) {
       
        $existingReaction->delete();
    } else {
     
        $post->reactions()->create([
            'type' => 'haha',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}

public function sadReact(Post $post) {
    $user = auth()->user();


    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'sad')->first();

    if ($existingReaction) {
       
        $existingReaction->delete();
    } else {
     
        $post->reactions()->create([
            'type' => 'sad',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}

public function getReactionCount(Post $post, $reactionType)
{
    $count = $post->reactions()->where('type', $reactionType)->count();

    return response()->json(['count' => $count]);
}


public function submitComment(Request $request, Post $post) {

  
   

    // Create a new comment
    $comment = new Comment([
        'user_id' => auth()->id(), // Assuming the user is authenticated
        'post_id' => $post->id,
        'content' => $request->input('content'),
    ]);

    // Save the comment to the database
    $comment->save();
    
    // You can redirect back to the post or any other page after storing the comment
    return redirect()->back()->with('comment', 'Comment added successfully!');
}

public function getComments($postId)
{
    $authenticatedUser = Auth::user();
    $comments = Comment::join('users', 'comments.user_id', '=', 'users.id')
    ->where('comments.post_id', $postId)
    ->select('comments.*', 'users.name as user_name', 'users.avatar as user_avatar')
    ->get();


    return response()->json(['user' => $authenticatedUser, 'comments' => $comments]);
}


public function deleteComment(Comment $comment) {
    // Delete the specific comment
    $comment->delete();

    return response()->json(['message' => 'Success! Your comment has been deleted']);
}

public function getCommentCount($postId)
{
    $count = Comment::where('post_id', $postId)->count();

    return response()->json(['count' => $count]);
}

}


