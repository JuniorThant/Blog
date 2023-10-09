<x-layout>
    <x-slot name="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card p-5 my-5 shadow-sm">
                        <h3 class="text-center">Blog Create Form</h3>
                        <form id="blogForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputTitle1" class="form-label">Title</label>
                                <input type="text" name="blogtitle" value="{{ old('blogtitle') }}" class="form-control blogtitle" aria-describedby="titleHelp">
                                <x-error name="blogtitle"/>
                            </div>
                            <div class="mb-3">
                                <label for="editor" class="form-label">Blog</label>
                                <textarea name="blogbody" cols="30" rows="10" class="form-control blogbody" id="editor">{{ old('blogbody') }}</textarea>
                                <x-error name="blogbody"/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputThumbnail1" class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" value="{{ old('thumbnail') }}" class="form-control thumbnail" id="thumbnail" aria-describedby="thumbnailHelp">
                                <x-error name="thumbnail"/>
                            </div>
                            <div id="thumbnail-preview"></div>
                            <div class="mb-3">
                                <label for="exampleInputDuration1" class="form-label">Read Duration (minutes/hours)</label>
                                <input type="text" name="read_duration" value="{{ old('read_duration') }}" class="form-control read_duration" aria-describedby="durationHelp">
                                <x-error name="read_duration"/>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="form-control category_id">
                                    @foreach($categories as $category)
                                    <option {{ $category->id == old('category_id') ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-error name="category_id"/>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" id="buttonBlog">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    </x-slot>
</x-layout>
