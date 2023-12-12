@props(['comments', 'blogpost'])

<section class="comments-section">
    <div class="card my-5 findme2">
        <div class="card-body">
            <h5 class="text-secondary">Comments ({{ $comments->count() }})</h5>
            <div class="commentbox p-2">
                @foreach ($comments as $comment)
                    <x-single-comment :comment="$comment" :replies="$comment->replies" :blogpost="$blogpost" />
                @endforeach
            </div>
        </div>
        <div class="card-footer varyCommentForm bg-white" style="padding:0;">
            @auth
            <form class="commentForm" id="commentForm" method="POST" action="/article/{{ $blogpost->filename }}/comments">
                @csrf
                <div class="row">
                    <div class="col-10 col-md-11 col-lg-10 col-xl-10">
                        <input type="hidden" name="filename" value="{{ $blogpost->filename }}">
                        <input class="form-control border border-0 border-white" name="body" id="body" 
                            placeholder="Make a comment...">
                        <x-error name="body" />
                    </div>
                    <div class="col-2 col-md-1 col-lg-2 col-xl-2">
                        <button type="submit" data-filename="{{ $blogpost->filename }}" class="border border-0 bg-white">
                            <img src="/images/sendicon.png" alt="" style="width:50%;height:50%;">
                        </button>
                    </div>
                </div>
            </form>
            @endauth
            <form class="commenteditForm" id="commenteditForm" method="POST" action="/article/{{ $blogpost->filename }}/comments/update" style="display:none;">
                @csrf
                <div class="row">
                    <div class="col-10 col-md-11 col-lg-10 col-xl-10">
                        <input type="hidden" class="ufilename" name="ufilename" value="{{ $blogpost->filename }}">
                        <input type="hidden" value="{{ old('new_id') }}" class="new_id" name="new_id" id="new_id">
                        <input class="form-control border border-0 border-white edited_body"
                        value="{{ old('edited_body') }}" name="edited_body" id="edited_body">
                        <x-error name="edited_body" />
                    </div>
                    <div class="col-2 col-md-1 col-lg-2 col-xl-2">
                        <button type="submit" class="border border-0 bg-white">
                            <img src="/images/sendicon.png" alt="" style="width:50%;height:50%;">
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@guest
<div class="container col-md-8 mx-auto">
    <p>Please <a href="/blogposts/login">Login</a> to make a comment</p>
</div>
@endguest



