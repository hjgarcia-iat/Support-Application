@section('pageTitle','Articles')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4"
                                           :status="session('status')"
                                           :type="session('type')"/>

                    <x-search-form :placeholder="'Search for an article...'"
                                   :route="route('admin.articles')"
                                   :query="'query'"/>

                    @if($articles->count() > 0)
                        <div class="my-4">
                            {{ $articles->links() }}
                        </div>

                        <table class="w-full">
                            <thead>
                            <tr>
                                <th class="bg-gray-100 border text-left px-8 py-4 text-center">ID</th>
                                <th class="bg-gray-100 border text-left px-8 py-4">Created On</th>
                                <th class="bg-gray-100 border text-left px-8 py-4">Name</th>
                                <th class="bg-gray-100 border text-left px-8 py-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="border px-8 py-4 text-center">{{ $article->id }}</td>
                                    <td class="border px-8 py-4">{{ $article->created_at->format('m/d/Y') }}</td>
                                    <td class="border px-8 py-4">{{ $article->name }}</td>
                                    <td class="border px-8 py-4">
                                        <div class="items-center flex h-full items-center">
                                            <a href="{{ route('admin.articles.edit', $article) }}"
                                               class="p-1 mx-2 hover:text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>


                                            <form action="{{ route('admin.articles.delete', $article) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="p-1 mx-2 hover:text-red-600" type="submit">
                                                    <svg class="w-5 h-5"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">No articles found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
