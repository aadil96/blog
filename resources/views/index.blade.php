@extends('layouts.app')

@section('content')

    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @forelse($posts as $post)
            <article class="flex flex-col shadow lg:w-full my-4">
                <!-- Article Image -->
                <a href="{{ route('blog.show', $post->slug) }}" class="hover:opacity-75">
                    <img src="{{ asset( $post->featured_image ) }}" alt="{{ $post->featured_image_caption }}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{ implode(',', $post->tags->pluck('name')->toArray() ) }}</a>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                    <p href="{{ route('blog.show', $post->slug) }}" class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->author->name }}</a>,
                        {{ $post->publish_date }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="pb-6">{{ $post->excerpt }}..</a>
                    <a href="{{ route('blog.show', $post->slug) }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        @empty
            {{ 'No posts available' }}
        @endforelse
        <!-- Pagination -->
        <div class="flex items-center py-8">
            {{ $posts->links() }}
{{--            <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>--}}
{{--            <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>--}}
{{--            <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>--}}
        </div>

    </section>
@endsection
