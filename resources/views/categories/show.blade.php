@extends('layouts.categories')
@section('pageTitle',$category->name)
@section('content')
    <div class="m-4">
        <h1 class="font-bold text-blue-brand-medium text-3xl mb-2">{{ $category->name }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 mx-4 py-4 gap-x-12">

        @if($category->children->isNotEmpty())
        <div class="md:col-span-3">
            <ul>
                @foreach($category->children as $child)
                    <li><a href="{{ route('categories.articles.show', $child->slug) }}" class="w-full bg-gray-100 rounded mb-2 py-2 px-2 block hover:bg-gray-200">{{ $child->name }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="md:col-span-9">
            @foreach($category->articles as $article)
                <h2 class="text-2xl mb-6">
                    <a href="" class="hover:text-orange-600 hover:underline">{{ $article->name }}</a>
                </h2>
            @endforeach
        </div>
    </div>
@endsection

