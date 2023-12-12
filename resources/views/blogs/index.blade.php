<x-layout>
    <x-slot name="content">
		        @if(session('success'))
		        <div class="alert alert-success text-center">{{session('success')}}</div>
		        @endif
    		<x-hero />
    		<x-blog-section :blogposts="$blogposts"/>
			<script src="{{ asset('js/dropdown.js') }}" defer></script>
    </x-slot>
</x-layout>

