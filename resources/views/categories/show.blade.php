{{ $category->name }}
@foreach ($category->children as $children)
    {{ $children->name }}
@endforeach

@foreach ($category->articles as $article)
{{ $article->name }}
@endforeach
