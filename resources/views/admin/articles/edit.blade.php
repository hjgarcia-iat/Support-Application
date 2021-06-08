@foreach($categories as $category)
    {{ $category->id }}
    {{ $category->name }}
@endforeach

{{ $article->id }}
{{ $article->name }}
{{ $article->slug }}
{{ $article->content }}
{{ $article->pinned }}
{{ $article->views }}
{{ $article->rating }}
