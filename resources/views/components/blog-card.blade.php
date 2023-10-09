<div class="card" style="height: 680px;">
    <div style="height: 400px;">
        @auth
        @if ($blogpost->user_id == auth()->user()->id)
        <a href="/article/edit/{{ $blogpost->filename }}" style="position: absolute; left: 92%;">
            <i class="bi bi-pencil-square fs-3 text-primary"></i>
        </a>
        @endif
        @endauth
        <img src="/storage/{{ $blogpost->thumbnail }}" class="blogimage" @auth
        @if ($blogpost->user_id == auth()->user()->id)
        style="border-top-right-radius: 35% 20%;"
        @endif
        @endauth>
    </div>
    <div class="card-body">
        <h5 class="card-title mb-2" style="line-height: 30px;">{{ $blogpost->blogtitle }}</h5>
        <p class="card-text">
            {{ Illuminate\Support\Str::limit(strip_tags($blogpost->blogbody), 180) }}
            <a href="/article/{{ $blogpost->filename }}" class="text-primary" style="text-decoration:none;">Read More</a>
        </p>
    </div>
    <div class="card-footer border border-0 bg-white">
        <div class="tags d-flex justify-content-between">
            <a href="/blogposts?category={{ $blogpost->category->filename }}"><span class="badge bg-dark">{{ $blogpost->category->name }}</span></a>
            <p class="fs-6 text-secondary">
                <a href="/blogposts/?author={{ $blogpost->author->username }}" class="text-dark" style="text-decoration:none;">{{ $blogpost->author->name }}</a>
                <span> - {{ $blogpost->created_at->diffForHumans() }}</span>
            </p>
        </div>
    </div>
</div>


