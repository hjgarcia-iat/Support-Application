@extends('layouts.categories')@section('pageTitle','Search')
@section('content')

    <div class="m-4 flex justify-between">
        <h1 class="font-bold text-blue-brand-medium text-3xl mb-2">Search Results</h1>
        <div>
            Number of Results: <strong>{{ $articles->total() }}</strong>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-y-4 mx-4">
        @foreach($articles as $article)
            <h2 class="text-2xl">
                <a class="hover:text-orange-500 hover:underline"
                    href="{{ route('categories.show', $article->categories->first()->slug) }}">{{ $article->name }}</a>
            </h2>

            {!!  \Illuminate\Support\Str::limit($article->content,$words = 200, $end='...') !!}

            <p>
                <a href="{{ route('categories.show', $article->categories->first()->slug) }}" class="hover:underline">View Article</a>
            </p>
        @endforeach
    </div>

    <div class="m-4">
        {{ $articles->withQueryString()->links() }}
    </div>
@endsection


