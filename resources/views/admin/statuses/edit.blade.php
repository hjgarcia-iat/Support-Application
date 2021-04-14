@section('pageTitle','Edit Status')
@include('layouts.partials.editor',['id' => 'post'])

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Status Update') }}
            </h2>
            <a href="{{ route('admin.statuses') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Back to Main Page </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4"
                                           :status="session('status')"/>

                    <x-auth-validation-errors class="mb-4"
                                              :errors="$errors"/>

                    <form method="POST"
                          action="{{ route('admin.statuses.update', $status->id) }}">
                        @csrf

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="name"
                                     class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right"
                                     :value="__('Type')"/>
                            <x-select id="name"
                                      class="block mt-1 w-full col-span-5"
                                      type="text"
                                      name="type">
                                <option value="">Select a severity level</option>
                                <option value="High"
                                        @if (old('type', $status->type) == 'High') selected="selected" @endif>High
                                </option>
                                <option value="Medium"
                                        @if (old('type', $status->type) == 'Medium') selected="selected" @endif>Medium
                                </option>
                                <option value="Low"
                                        @if (old('type', $status->type) == 'Low') selected="selected" @endif>Low
                                </option>
                                <option value="Default"
                                        @if (old('type', $status->type) == 'Default') selected="selected" @endif>Default
                                </option>
                            </x-select>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8">
                            <x-label for="post"
                                     class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right"
                                     :value="__('Status Content')"/>
                            <div class="col-span-5">
                                <x-textarea id="post"
                                            class="block mt-1 w-full h-48"
                                            type="text"
                                            name="post">
                                    {{ old('post', $status->post) }}
                                </x-textarea>
                            </div>
                        </div>

                        <div class="md:flex items-center justify-end mt-8">
                            <x-button class="block md:inline-flex w-full md:w-auto text-center justify-center">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

