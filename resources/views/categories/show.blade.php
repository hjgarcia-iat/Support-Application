{{ $category->name }}
@foreach($category->children as $child)
    {{ $child->name }}
@endforeach

@foreach($category->articles as $article)
    {{ $article->name }}
@endforeach
