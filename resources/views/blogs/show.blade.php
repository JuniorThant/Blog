<x-layout>
    <x-slot name="content">
        <!-- Single blog section -->
        <section id="showeachblog">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8" style="position:relative;">
                        <div class="card my-5" >
                           <div class="p-3">
                           <img src="/storage/{{ $blogpost->thumbnail }}" class="card-img-top" alt="...">
                            <h3 class="my-3">{{ $blogpost->blogtitle }}</h3>
                            <div class="row my-2">
                                <div class="col-md-6 mt-3">
                                    <div>Written By - <a href="/blogposts/?author={{ $blogpost->author->username }}" class="text-dark" style="text-decoration:none;">{{ $blogpost->author->name }}</a></div>
                                    <div class="text-secondary">{{ $blogpost->created_at->diffForHumans() }}</div>
                                    <div class="text-secondary">{{ $blogpost->read_duration }} read</div>
                                </div>
                                <!-- Like Section -->
                                <div class="col-md-6 mt-3 d-flex justify-content-end pt-3">
                                <x-likesection :blogpost="$blogpost"/>
                                
                            </div>
                           </div>
                        <div>
                        <div class="horizontalline"></div>
                        <div class="p-3">
                            <p class="lh-md">{!! $blogpost->blogbody !!}</p>
                        </div>    
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-4">
                        <div style="position:relative;">
                            <x-comments :comments="$blogpost->comments" :blogpost="$blogpost" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subscribe to new blogs -->
        <div class="container" style="position:relative;">
            <div class="row">
                <x-byml :randomBlogs="$randomBlogs" />
            </div>
        </div>
        <!-- Include JavaScript libraries -->
        <script src="{{ asset('js/comment.js') }}" defer></script>
        <script src="{{ asset('js/reply.js') }}" defer></script>
        <script src="{{ asset('js/commentupdate.js') }}" defer></script>

    </x-slot>
</x-layout>

