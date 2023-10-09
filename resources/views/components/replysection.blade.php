@props(['replies','blogpost'])     

        @foreach($replies as $reply)
            <div class="my-2 replyparent" style="position:relative;">
                <div class="replyedittemplate" style="position:absolute; top:0;left:150px;z-index:1;display:none;">
                    <ul class="bg-white border border-1" style="width:120px;list-style:none;padding:0;">
                        <li><a class="dropdown-item editreply" data-reply_body="{{ $reply->replybody }}" data-reply_id="{{ $reply->id }}"><i class="bi bi-pen-fill"></i>Edit</a></li>
                        <li><a class="dropdown-item deletereply"><i class="bi bi-trash-fill"></i>Delete</a></li>
                    </ul>
                </div>

                <div class="card ps-2 my-2 m-auto border" style="border-radius:20px;background-color:#E8E9EA;width:70%;">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div>
                                <img src="/storage/{{$reply->user->avatar}}" width="25" height="25" class="rounded-circle" alt="">
                            </div>
                            <div class="ms-3 mb-2">
                                <p style="padding:0;margin:0;">{{$reply->user->name}}</p>
                                <small class="text-secondary">{{$reply->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        <div>
                            @auth
                                @if ($reply->user_id == auth()->user()->id)
                                    <button class="border border-0 text-primary bg-transparent showreplyedittemplate"><i class="bi bi-pencil-square"></i></button>
                                @endif
                            @else
                            @endauth
                        </div>
                    </div>
                    <p class="">{{$reply->replybody}}</p>
                    <p class="replyid" style="display:none;">{{$reply->id}}</p>
                    <p class="replyslug" style="display:none;">{{$blogpost->filename}}</p>
                </div>

                <x-replyeditbox :blogpost="$blogpost"/>

            </div>
        @endforeach