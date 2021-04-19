@section('pageTitle','Create User')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create User') }}
            </h2>
            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Back to all Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4" :status="session('status')" :type="session('type')"/>

                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="name" class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right" :value="__('Name')"/>
                            <x-input id="name" class="block mt-1 w-full col-span-5" type="name" name="name" :value="old('name')" placeholder="Enter name"/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="email" class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right" :value="__('Email')"/>
                            <x-input id="email" class="block mt-1 w-full col-span-5" type="email" name="email"
                                     :value="old('email')" placeholder="Enter email"/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="password" class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right" :value="__('Password')"/>
                            <x-input id="password" class="block mt-1 w-full col-span-5"
                                     type="password"
                                     name="password"
                                     autocomplete="current-password" placeholder="Enter password"/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="password_confirmation" class="col-span-1 font-bold uppercase tracking-wide text-left md:text-right" :value="__('Confirm Password')"/>
                            <x-input id="password_confirmation" class="block mt-1 w-full col-span-5"
                                     type="password"
                                     name="password_confirmation"
                                     autocomplete="current-password" placeholder="Confirm Password"/>
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
