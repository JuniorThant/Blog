@props(['blogposts'])

<!-- Blogs section -->
<section class="container text-center" id="blogs">
    <h1 class="display-5 fw-bold mb-4">Blogs</h1>
    <div></div>
    <div>
        <x-category-dropdown />
    </div>
    <form action="/blogposts" class="my-3">
        <div class="input-group mb-3">
            @if(request('category'))
                <input name="category" type="hidden" value="{{request('category')}}"/>
            @endif
            <input
                name="search" value="{{request('search')}}" type="text" autocomplete="false" class="form-control" placeholder="Search Blogs..." />
            <button class="input-group-text bg-primary text-light" id="searchButton" type="submit">
                Search
            </button>
        </div>
    </form>
    <div id="categoryPostsContainer">
        <x-blogcards :blogposts="$blogposts"></x-blogcards>
    </div>
</section>

   