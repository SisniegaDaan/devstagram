<div>
    @if ($posts->count() > 0)
        <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$post->user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen - Post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach

        </div>
        <div>
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="uppercase text-gray-600 text-sm font-bold text-center">No hay publicaciones aún</p>
    @endif
</div>