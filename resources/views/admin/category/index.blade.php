@foreach ($categories as $category)
    {{ $category->id }}
    {{ $category->name }}
@endforeach
