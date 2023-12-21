<!DOCTYPE html>
<html lang="en" data-csrf="{{ csrf_token() }}">

<head>
    <title>Freedom Wall</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/reaction.js') }}" defer></script>
    <link rel="stylesheet" href="public/css/output.css">
    <style>
        .gradient {
            background-image: radial-gradient(circle farthest-corner at 10% 20%, rgba(147, 67, 67, 1) 0%, rgba(111, 27, 27, 1) 90%);
        }
    </style>
</head>

<body>


    @foreach ($posts->sortByDesc(function ($post) {
        return [$post->announcement, $post->id];
    }) as $post)
        <div class="relative mt-20 xl:ml-10">
            <div
                class="w-80 h-72 flex flex-col rounded-lg border-2 border-gray-300 shadow-md @if ($post->announcement) gradient @endif">
                <!-- Author info -->
                <div
                    class="flex justify-between items-center space-x-2 mt-3 ml-3 mr-3 border-b-2 border-black pb-3 @if ($post->announcement) border-yellow @endif">
                    <div
                        class="flex items-center space-x-2 @if ($post->announcement) w-full justify-center @endif">

                        @if ($post->anonymous)
                            <span class="text-lg font-semibold text-gray-700">Anonymous User</span>
                        @elseif ($post->announcement)
                            <i class="fa-solid fa-bullhorn fa-flip-horizontal fa-lg text-yellow"></i>
                            <span class="text-lg text-yellow font-semibold">ANNOUNCEMENT</span>
                            <i class="fa-solid fa-bullhorn fa-lg text-yellow"></i>
                        @else
                            <img src="{{ asset('public/storage/app/public/users-avatar/' . $post->user->avatar) }}" width="40" height="40"
                                alt="author profile" class="rounded-full">
                            <h1 class="text-lg font-semibold text-gray-700">{{ $post->user->name }}</h1>
                        @endif
                    </div>
                    <div class="flex items-center space-x-2">
                        @auth
                            @if (auth()->user()->id === $post->user->id)
                                <button onclick="confirmDeletePost('{{ $post->id }}')"
                                    class="material-symbols-outlined text-red-600">
                                    Delete
                                </button>
                                <form id="delete-form-{{ $post->id }}" action="/delete-post/{{ $post->id }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
                <!-- Caption -->
                <div class="h-3/5 flex items-center">
                    <p
                        class="text-center text-sm break-words w-full p-4 text-gray-700 tracking-widest @if ($post->announcement) text-yellow font-bold @endif">
                        {{ $post->body }}
                    </p>
                </div>

                <!-- Reaction Section -->
                <div
                    class="absolute bottom-0 bg-gray-100 left-0 right-0 border-2 border-gray-300 p-1 rounded-bl-lg rounded-br-lg">
                    <div class="flex space-x-36 items-center">
                        <div class="flex space-x-5 items-center">
                            @php
                                $hasReactedWithHeart = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'heart')
                                    ->exists();

                                $hasReactedWithLike = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'like')
                                    ->exists();
                                $hasReactedWithHaha = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'haha')
                                    ->exists();
                                $hasReactedWithFrown = $post
                                    ->reactions()
                                    ->where('user_id', auth()->id())
                                    ->where('type', 'sad')
                                    ->exists();
                            @endphp

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-heart-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'heart')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithHeart ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'heart', '{{ $hasReactedWithHeart ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-like-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'like')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithLike ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'like', '{{ $hasReactedWithLike ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-thumbs-up"></i>
                                </button>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-haha-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'haha')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithHaha ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'haha', '{{ $hasReactedWithHaha ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-grin-beam"></i>
                                </button>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <p id="reaction-count-sad-{{ $post->id }}" class="text-xs">
                                    {{ $post->reactions()->where('type', 'sad')->count() }}</p>
                                <button
                                    class="reaction-icon text-{{ $hasReactedWithFrown ? 'maroon' : 'gray-500' }} hover-text-gray-700 text-lg"
                                    onclick="react('{{ $post->id }}', 'sad', '{{ $hasReactedWithFrown ? 'gray-500' : 'maroon' }}', this)">
                                    <i class="fas fa-frown"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Comment Section -->

                        <!-- Comment Icon -->
                        <div class="flex flex-col justify-center items-center">
                            <p id="comment-count-{{ $post->id }}" class="text-xs">
                                {{ $post->comments()->count() }}
                            </p>
                            <button class="comment-icon text-gray-500 hover:text-gray-700 text-lg"
                                onclick="showCommentPopup('{{ $post->id }}')">
                                <i class="fas fa-comment"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment section modal -->
            <div id="commentSection-{{ $post->id }}"
                class="fixed inset-0 flex justify-center items-center bg-opacity-50 bg-gray-600 z-50 hidden">
                <div
                    class="bg-white px-10 py-5 rounded-lg shadow-lg overflow-y-auto
    xl:w-full xl:max-w-[1200px] xl:max-h-[700px] 
    laptop:w-full laptop:max-w-[800px] laptop:max-h-[700px] 
    tablet:w-full tablet:max-w-[600px] tablet:max-h-[700px] 
    mobileS:w-full mobileS:max-w-[300px] mobileS:max-h-[700px]">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Comments</h2>
                        <button class="text-gray-600 hover:text-gray-800 text-2xl"
                            onclick="showCommentPopup('{{ $post->id }}')">&times;</button>
                    </div>

                    <div id="comments-container-{{ $post->id }}"
                        class="mb-4
                        xl:w-full xl:max-w-[1200px] 
                        laptop:w-full laptop:max-w-[800px] 
                        tablet:w-full tablet:max-w-[600px] 
                        mobileS:w-full mobileS:max-w-[300px] 
                        text-base">

                        <!-- Your comments will be displayed here -->

                    </div>

                    <div class="mt-auto">
                        <!-- Form for adding a new comment -->
                        <form id="addCommentForm_{{ $post->id }}"
                            onsubmit="return submitComment('{{ $post->id }}', this);"
                            class="flex items-center flex-col tablet:flex-row" autocomplete="off">

                            <input type="text" name="content"
                                class="flex-grow p-2 mb-2 sm:mb-0 tablet:mr-2 border rounded resize-y"
                                placeholder="Add your comment..." required maxlength="200">

                            <button type="button" onclick="submitComment('{{ $post->id }}', this.form)"
                                class="bg-green-500 text-white p-2 rounded cursor-pointer">Submit</button>

                        </form>


                    </div>
                </div>
            </div>

        </div>
    @endforeach


</body>

</html>
