@extends('layouts.categories')
@section('pageTitle',$category->name)
@section('content')
    <div class="m-4">
        <h1 class="text-center font-bold text-blue-brand-medium text-3xl mb-2">{{ $category->name }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 mx-4 py-4 gap-x-12">
        <div class="md:col-span-3">
            <ul>
                @foreach($category->children as $child)
                    <li>{{ $child->name }}</li>
                @endforeach
            </ul>
        </div>

        <div class="md:col-span-9">
            <h2 class="font-bold text-gray-600 mb-4 text-2xl">Articles</h2>
            @foreach($category->articles as $article)
                <p>{{ $article->name }}</p>
            @endforeach
        </div>
    </div>
@endsection

