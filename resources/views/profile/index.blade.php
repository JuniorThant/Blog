<x-layout>
    <x-slot name="content">
        <section id="showprofile" class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 my-5">
                        <div>
                            <img src="/storage/{{ auth()->user()->avatar }}" width="100" height="100" class="rounded-circle" alt="">
                            <b class="fs-1 ms-3">{{ auth()->user()->name }}</b>
                                @if(auth()->user()->job)
                                <small class="fs-3 ms-1">({{auth()->user()->job}})</small>
                                @else

                                @endif
                            
                        </div>
                        @if(auth()->user()->bio)
                        <div class="my-5 ms-1">
                        <h3>Bio</h3>
                                <p class="fs-5">{{auth()->user()->bio}}</p>   
                        </div>
                        @else
                        @endif
                    </div>
                    <div class="col-md-4 my-5">
    <div class="d-flex justify-content-end">
        <a href="/blogposts/profile/editprofile" class="btn btn-primary mx-2"><i class="bi bi-gear"></i> Account Settings</a>
    </div>
</div>
                </div>
            </div>
        </section>

        @props(['blogposts'])

        <section class="container text-center my-5" id="blogs">
            <h1 class="display-5 fw-bold m-5">My Blogs</h1>
            <div>
                <x-category-dropdown />
            </div>
            <form action="/blogposts/profile" class="my-3">
                <div class="input-group mb-3">
                    @if(request('category'))
                        <input name="category" type="hidden" value="{{ request('category') }}" />
                    @endif
                    <input name="search" value="{{ request('search') }}" type="text" autocomplete="false" class="form-control" placeholder="Search Blogs..." />
                    <button class="input-group-text bg-primary text-light" id="basic-addon2" type="submit">Search</button>
                </div>
            </form>
            <div class="row">
                @forelse($blogposts as $blogpost)
                    <div class="col-md-4 mb-4">
                        <x-blog-card :blogpost="$blogpost" :isProfilePage="$isProfilePage"/>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h3 class="text-center text-danger mt-2 mb-5">No Blogs Found! <a href="/blogposts/create">Create</a> One!</h3>
                    </div>
                @endforelse
                <div class="col-md-12">
                    {{ $blogposts->links() }}
                </div>
            </div>
        </section>
    </x-slot>
</x-layout>
