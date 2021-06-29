@extends('layouts.categories')
@section('pageTitle','Search')
@section('content')

    <div class="m-4 flex justify-between">
        <h1 class="font-bold text-blue-brand-medium text-3xl mb-2">Search Results</h1>
        <div>
            Number of Results: <strong>{{ $categories->total() }}</strong>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-y-4 mx-4">
        @foreach($categories as $category)
            <h2 class="text-2xl">
                <a class="hover:text-orange-500 hover:underline" href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
            </h2>
        @endforeach
    </div>

    <div class="m-4">
        {{ $categories->withQueryString()->links() }}
    </div>
@endsection


