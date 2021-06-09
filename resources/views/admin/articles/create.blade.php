@section('pageTitle','Create Article')
@include('layouts.partials.editor',['id' => 'content'])

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Article') }}
            </h2>
            <a href="{{ route('admin.articles') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Back to all Articles</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4"
                                           :status="session('status')"
                                           :type="session('type')"/>

                    <x-auth-validation-errors class="mb-4"
                                              :errors="$errors"/>

                    <form method="POST"
                          action="{{ route('admin.articles.store') }}">
                        @csrf

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="name"
                                     class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right"
                                     :value="__('Pinned')"/>


                            <div class="block mt-1 w-full col-span-5 flex items-center">
                                <div>
                                    <label for="pinned-1" class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</label>
                                    <input id="pinned-1" type="radio"
                                           {{ old('pinned') === true ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                           name="pinned" value="1">
                                </div>


                                <div>
                                    <label for="pinned-0" class="ml-2 text-sm text-gray-600">{{ __('No') }}</label>
                                    <input id="pinned-0" type="radio" {{ old('pinned') === false ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                           name="pinned" value="0">
                                </div>

                            </div>
                        </div>



                        @if(!$categories->isEmpty())
                            <div class="mt-4 md:grid grid-cols-6 gap-8 items-top">
                                <x-label for="name"
                                         class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right"
                                         :value="__('Category')"/>
                                <x-select id="name"
                                          class="block mt-1 w-full col-span-5"
                                          type="text"
                                          name="categories[]"
                                          multiple>
                                    <option value="">Select a related category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>

                        @endif

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="name"
                                     class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right"
                                     :value="__('Name')"/>
                            <x-input id="name"
                                     class="block mt-1 w-full col-span-5"
                                     type="text"
                                     name="name"
                                     :value="old('name')"
                                     autofocus
                                     placeholder="Enter article name"/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="name"
                                     class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right"
                                     :value="__('Slug')"/>
                            <x-input id="slug"
                                     class="block mt-1 w-full col-span-5"
                                     type="text"
                                     name="slug"
                                     :value="old('slug')"
                                     autofocus
                                     placeholder="Enter article slug"/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8">
                            <x-label for="post" class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right" :value="__('Content')" />
                            <div class="col-span-5">
                                <x-textarea id="post" class="block mt-1 w-full h-48" name="content" :value="old('content')">{{ old('content') }}</x-textarea>
                            </div>
                        </div>

                        <div class="md:flex items-center justify-end mt-8">
                            <x-button class="block md:inline-flex w-full md:w-auto text-center justify-center">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
