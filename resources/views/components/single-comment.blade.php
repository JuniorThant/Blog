@props(['comment','replies','blogpost'])
<div class="findme">
<div class="my-3" style="position:relative;">
  
<div class="edittemplate" style="position:absolute; top:0;left:200px;z-index:1;display:none;">
<ul class="bg-white border border-1" style="width:200px;list-style:none;padding:0;">
    <li><a class="dropdown-item editComment" data-comment_body="{{ $comment->body }}" 
    data-comment_id="{{ $comment->id }}"><i class="bi bi-pen-fill"></i>Edit</a>
</li>
    <li><a class="dropdown-item deleteComment"><i class="bi bi-trash-fill"></i>Delete</a></li>
  </ul>
</div>

<div class="card p-2 my-3 border comment-card" style="border-radius:20px;background-color:#E8E9EB;">
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <div>
            <img
                src="/storage/{{$comment->author->avatar}}"
                width="50"
                height="50"
                class="rounded-circle"
                alt=""
            >
            </div>
            <div class="ms-3">
            <h6>{{$comment->author->name}} 
                @if($comment->author->job)
                <small>({{$comment->author->job}} )</small>
                @else
                @endif
            </h6>
            <p class="text-secondary">{{$comment->created_at->diffForHumans()}}</p>
        </div>
        </div>
        <div class="ms-3">
        @auth
        <button class="border border-0 text-primary bg-transparent showReplySection">Reply</button>
        @if ($comment->user_id==auth()->user()->id)
        <button class="border border-0 text-primary bg-transparent showedittemplate"><i class="bi bi-pencil-square"></i></button>
        @endif
        @else
        @endauth
        </div>
    </div>
    <p class="mt-1">
      {{$comment->body}}
    </p>
    <p class="commentid" style="display:none;"> {{$comment->id}}</p>
    <p class="slug" style="display:none;">{{$blogpost->filename}}</p>
</div>


@if($replies->count()==0)
@else
<button href="" style="text-decoration:none;" class="text-dark border border-0 bg-transparent replyDropdown"><i class="bi bi-arrow-return-right fs-3"></i> {{$replies->count()}} Reply</button>
@endif
</div>

<div class="border replysection" style="border-radius:20px;background-color:#E8E9EB;width:70%;padding:0;display:none;">
                        <div class="row" style="padding:0;">
                          <div class="col-10">
                                <input type="hidden" class="rfilename" value="{{$blogpost->filename}}" name="rfilename" >
                                <input type="hidden" class="comment_id" value="{{$comment->id}}" name="comment_id">
                                <input class="form-control border border-0 border-white bg-transparent replybody" name="replybody" id="replybody"
                                    placeholder="Reply a comment...">
                                    <x-error name="replybody" />
                          </div>
                          <div class="col-2">
                                <button type="submit" id="replySubmit" class="border border-0 bg-transparent replySubmit">
                                    <img src="/images/sendicon.png" alt="" style="width:80%;height:80%;">
                                </button>
                          </div>
</div>

</div>

<div class="ps-5 replycontainer" style="display:none;">
@foreach($replies as $reply)
<div class="my-2 replyparent" style="position:relative;">
<div class="replyedittemplate" style="position:absolute; top:0;left:150px;z-index:1;display:none;">
<ul class="bg-white border border-1" style="width:120px;list-style:none;padding:0;">
    <li><a class="dropdown-item editreply" data-reply_body="{{ $reply->replybody }}" 
    data-reply_id="{{ $reply->id }}"><i class="bi bi-pen-fill"></i>Edit</a>
</li>
    <li><a class="dropdown-item deletereply"><i class="bi bi-trash-fill"></i>Delete</a></li>
  </ul>
</div>

<div class="card ps-2 my-2 m-auto border" style="border-radius:20px;background-color:#E8E9EA;width:70%;">
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <div>
            <img
                src="/storage/{{$reply->user->avatar}}"
                width="25"
                height="25"
                class="rounded-circle"
                alt=""
            >
            </div>
            <div class="ms-3 mb-2">
            <p style="padding:0;margin:0;">{{$reply->user->name}}</p>
            <small class="text-secondary">{{$reply->created_at->diffForHumans()}}</small>
            </div>
        </div>
        <div>
            @auth
            @if ($reply->user_id==auth()->user()->id)
        <button class="border border-0 text-primary bg-transparent showreplyedittemplate"><i class="bi bi-pencil-square"></i></button>
        @endif
        @else
        @endauth
        </div>
    </div>
    <p class="">
      {{$reply->replybody}}
    </p>
    <p class="replyid" style="display:none;"> {{$reply->id}}</p>
    <p class="replyslug" style="display:none;">{{$blogpost->filename}}</p>
</div>

<form class="border replyeditsection" style="border-radius:20px;background-color:#E8E9EB;width:70%;padding:0;display:none;">
@csrf
                        <div class="row" style="padding:0;">
                          <div class="col-10">
                          <input type="hidden" class="urfilename" name="urfilename" value="{{ $blogpost->filename }}">
                                <input type="hidden" value="{{old('newr_id')}}" class="newr_id" name="newr_id" id="newr_id">
                                <input class="form-control border border-0 border-white bg-transparent replyeditbody" 
                                value="{{old('replyeditbody')}}" name="replyeditbody" id="replyeditbody">
                          </div>
                          <div class="col-2">
                                <button type="submit" id="replyUpdate" class="border border-0 bg-transparent replyUpdate">
                                    <img src="/images/sendicon.png" alt="" style="width:80%;height:80%;">
                                </button>
                          </div>
</form>

</div>

</div>
@endforeach
</div>
</div>

