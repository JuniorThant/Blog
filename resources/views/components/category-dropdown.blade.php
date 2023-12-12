<div class="dropdownbig" id="dropdownbig">
        <button class="dropdown-button">
            {{ isset($currentCategory) ? $currentCategory->name : 'Filter By Category' }} <i class="bi bi-caret-down-fill text-white"></i>
        </button>
        <div class="dropdown-content">
                <a style="text-decoration:none;" href="/blogposts#blogs"><div class="listsection">
                    All
                </div></a>  
        @foreach($categories as $category)
            <div class="listsection">
                <a class="dropdown-item category-link" data-category="{{ $category->filename }}">
                    {{ $category->name }}
                </a>
            </div>
        @endforeach
        </div>
</div>
