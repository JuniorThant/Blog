<div class="dropdownbig">
        <button class="dropdown-button">
            {{ isset($currentCategory) ? $currentCategory->name : 'Filter By Category' }} <i class="bi bi-caret-down-fill text-white"></i>
        </button>
        <div class="dropdown-content">
        @foreach($categories as $category)
            <div class="listsection">
                <a class="dropdown-item category-link" data-category="{{ $category->filename }}">
                    {{ $category->name }}
                </a>
            </div>
        @endforeach
        </div>
</div>
