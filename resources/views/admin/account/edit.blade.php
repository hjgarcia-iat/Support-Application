@section('pageTitle','Update Account Account')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                    <form method="POST" action="{{ route('admin.account.update') }}">
                        @csrf

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="name" class="col-span-1 font-bold uppercase tracking-wide" :value="__('Name')"/>
                            <x-input id="name" class="block mt-1 w-full col-span-5" type="name" name="name" :value="old('name', auth()->user()->name)"
                                     autofocus/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="email" class="col-span-1 font-bold uppercase tracking-wide" :value="__('Email')"/>
                            <x-input id="email" class="block mt-1 w-full col-span-5" type="email" name="email"
                                     :value="old('email', auth()->user()->email)" autofocus/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="password" class="col-span-1 font-bold uppercase tracking-wide" :value="__('Password')"/>
                            <x-input id="password" class="block mt-1 w-full col-span-5"
                                     type="password"
                                     name="password"
                                     autocomplete="current-password"/>
                        </div>

                        <div class="mt-4 md:grid grid-cols-6 gap-8 items-center">
                            <x-label for="password_confirmation" class="col-span-1 font-bold uppercase tracking-wide" :value="__('Confirm Password')"/>
                            <x-input id="password_confirmation" class="block mt-1 w-full col-span-5"
                                     type="password"
                                     name="password_confirmation"
                                     autocomplete="current-password"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
