<div class="row">
        @forelse($blogposts as $blogpost)
        <div class="col-md-4 mb-4">
            <x-blog-card :blogpost="$blogpost"/>
        </div>
        @empty
        <h3 class="text-center text-danger mt-2 mb-5">Not Blogs Found!</h3>   
        @endforelse
        {{$blogposts->links()}}
</div>