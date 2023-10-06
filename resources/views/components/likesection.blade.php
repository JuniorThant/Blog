@props(['blogpost'])

                                    <div class="text-secondary">
                                        @auth
                                            @if(auth()->user()->isSubscribed($blogpost))
                                                <button class="like-button liked border border-0 bg-transparent" data-blogpost_id="{{ $blogpost->id }}" data-filename="{{ $blogpost->filename }}">
                                                    <i class="bi bi-hand-thumbs-up-fill text-primary fs-3"></i>
                                                </button>
                                            @else
                                                <button class="like-button border border-0 bg-transparent" data-blogpost_id="{{ $blogpost->id }}" data-filename="{{ $blogpost->filename }}">
                                                    <i class="bi bi-hand-thumbs-up fs-3"></i>
                                                </button>
                                            @endif
                                            <div class="like-count-container">
    <span class="like-count">{{ $blogpost->subscribers()->count() }} </span> Likes
</div>
@else
                                                <div class=" d-flex justify-content-end align-content-center">
                                                <a href="/blogposts/login" class="like-button border border-0 bg-transparent" style="text-decoration:none;">
                                                <i class="bi bi-hand-thumbs-up fs-3 text-dark"></i>
                                                </a>
                                                <span class="like-count ms-1 me-1"> {{ $blogpost->subscribers()->count() }} </span> Likes<br>
                                                </div>
                                                <p>Please <a href="/blogposts/login">Login</a> to like the post</p>


                                        @endauth
                                    </div>
                                </div>