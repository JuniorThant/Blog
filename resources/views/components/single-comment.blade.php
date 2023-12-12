@props(['comment', 'replies', 'blogpost'])

<div class="findme">
    <div class="my-3" style="position:relative;">
        <div class="edittemplate" style="position:absolute; top:0;left:38%;z-index:1;display:none;">
            <ul class="bg-white border border-1" style="width:200px;list-style:none;padding:0;">
                <li><a class="dropdown-item editComment" data-comment_body="{{ $comment->body }}" data-comment_id="{{ $comment->id }}"><i class="bi bi-pen-fill"></i>Edit</a></li>
                <li><a class="dropdown-item deleteComment"><i class="bi bi-trash-fill"></i>Delete</a></li>
            </ul>
        </div>

        <div class="card p-2 my-3 border comment-card" style="border-radius:20px;background-color:#E8E9EB;">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <div>
                        <img src="/storage/{{$comment->author->avatar}}" width="50" height="50" class="rounded-circle" alt="">
                    </div>
                    <div class="ms-3">
                        <h6>{{$comment->author->name}} 
                            @if($comment->author->job)
                            <small>({{$comment->author->job}})</small>
                            @endif
                        </h6>
                        <p class="text-secondary">{{$comment->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                <div class="ms-3">
                    @auth
                        <button class="border border-0 text-primary bg-transparent showReplySection">Reply</button>
                        @if ($comment->user_id == auth()->user()->id)
                            <button class="border border-0 text-primary bg-transparent showedittemplate"><i class="bi bi-pencil-square"></i></button>
                        @endif
                    @else
                        @endauth
                </div>
            </div>
            <p class="mt-1">
                {{$comment->body}}
            </p>
            <p class="commentid" style="display:none;">{{$comment->id}}</p>
            <p class="slug" style="display:none;">{{$blogpost->filename}}</p>
        </div>

        @if($replies->count() > 0)
            <button href="" style="text-decoration:none;" class="text-dark border border-0 bg-transparent replyDropdown"><i class="bi bi-arrow-return-right fs-3"></i> {{$replies->count()}} Reply</button>
        @endif
    </div>

    <x-replycreatebox :blogpost="$blogpost" :comment="$comment"/>

    <div class="ps-5 replycontainer" style="display:none;">
    <x-replysection :blogpost="$blogpost" :replies="$replies"/>
    </div>

</div>

