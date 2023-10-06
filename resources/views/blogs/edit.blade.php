<x-layout>
<x-slot name="content">
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class="card p-5 my-5 shadow-sm">
                   <form method="POST" 
                   enctype="multipart/form-data" id="updateblogForm">
                    @csrf
                    <h3 class="text-center">Blog Edit Form</h3>
                    <input type="hidden" name="filename" value="{{ $blogpost->filename }}">
        <div class="mb-3">
            <label for="exampleInputTitle1" class="form-label">Title</label>
            <input type="text" name="blogtitle" value="{{old('blogtitle',$blogpost->blogtitle)}}" class="form-control" id="exampleInputTitle1" aria-describedby="titleHelp">
            <x-error name="blogtitle"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Blog</label>
            <textarea name="blogbody" class="editor" cols="30" rows="10" class="form-control" id="editor">{!!old('blogbody',$blogpost->blogbody)!!}</textarea>
            <x-error name="blogbody"/>
        </div>
        <div class="mb-3">
            <label for="exampleInputDuration1" class="form-label">Read Duration (minutes/hours)</label>
            <input type="text" name="read_duration" value="{{old('read_duration',$blogpost->read_duration)}}" class="form-control" id="exampleInputDuration1" aria-describedby="introHelp">
            <x-error name="read_duration"/>
        </div>
<div class="mb-3">
    <label for="exampleInputThumbnail1" class="form-label">Avatar</label>
    
    <!-- Display the existing image and add a click event to trigger the file input -->
    <img src="{{ old('thumbnail',asset('storage/' . $blogpost->thumbnail)) }}" alt="Blog Image" class="img-thumbnail" id="avatarImage" style="cursor: pointer;">
    
    <!-- Hidden input field for updating the image -->
    <input type="file" name="thumbnail" id="avatarInput" style="display: none;">
    
    <x-error name="thumbnail"/>
</div>

        <div class="mb-3">
            <select name="category_id" id="" class="form-control">
                @foreach($categories as $category)
                <option {{$category->id == old('category_id', $blogpost->category_id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <x-error name="category_id"/>
        </div>
        <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary mx-2">Update</button>
        <a href="{{ url('/article/edit/' . $blogpost->filename . '/' . $blogpost->id) }}" class="btn btn-danger mx-2">Delete</a>

        </div>
        </form>
                   </div>
    </div>
    <div class="col-md-3"></div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script src="{{ asset('js/blogupdate.js') }}" defer></script>
</x-slot>
</x-layout>