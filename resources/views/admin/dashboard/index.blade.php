@section('pageTitle','Admin Dashboard')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-12 gap-12">

                        <div class="col-span-4 text-center text-white shadow-sm">
                            <a href="{{ route('admin.categories') }}"
                               class="block w-full h-full p-8 bg-lightBlue-700 hover:bg-lightBlue-800">
                                <h3 class="text-3xl mb-8">Categories</h3>
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </div>
                            </a>
                        </div>

                        <div class="col-span-4 text-center text-white shadow-sm">
                            <a href="{{ route('admin.articles') }}"
                               class="block w-full h-full p-8 bg-lightBlue-700 hover:bg-lightBlue-800">
                                <h3 class="text-3xl mb-8">Articles</h3>
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            </a>

                        </div>

                        <div class="col-span-4 text-center text-white shadow-sm">
                            <a href="{{ route('admin.tickets') }}"
                               class="block w-full h-full p-8 bg-lightBlue-700 hover:bg-lightBlue-800">
                                <h3 class="text-3xl mb-8">Tickets</h3>
                                <div class="flex justify-center">
                                    <svg class="w-12 h-12"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                            </a>

                        </div>
                        <div class="col-span-4 text-center text-white shadow-sm">
                            <a href="{{ route('admin.statuses') }}"
                               class="block w-full h-full p-8 bg-lightBlue-700 hover:bg-lightBlue-800">
                                <h3 class="text-3xl mb-8">Status Updates</h3>
                                <div class="flex justify-center">
                                    <svg class="w-12 h-12"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>

                        <div class="col-span-4 text-center text-white shadow-sm">
                            <a href="{{ route('admin.users') }}"
                               class="block w-full h-full p-8 bg-lightBlue-700 hover:bg-lightBlue-800">
                                <h3 class="text-3xl mb-8">Users</h3>
                                <div class="flex justify-center">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                            </a>
                        </div>

                        <div class="col-span-4 text-center text-white shadow-sm">
                            <a href="{{ route('admin.account.edit') }}"
                               class="block w-full h-full p-8 bg-lightBlue-700 hover:bg-lightBlue-800">
                                <h3 class="text-3xl mb-8">Account</h3>
                                <div class="flex justify-center">
                                    <svg class="w-12 h-12"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
