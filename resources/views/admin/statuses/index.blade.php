@section('pageTitle','Status Updates')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('System Status') }}
            </h2>
            <a href="{{ route('admin.statuses.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <div class="my-4">
                        {{ $statuses->links() }}
                    </div>

                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="bg-gray-100 border text-left px-8 py-4">ID</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Created On</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Type</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Post</th>

                            <th class="bg-gray-100 border text-left px-8 py-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <td class="border px-8 py-4">{{ $status->id }}</td>
                                <td class="border px-8 py-4">{{ $status->created_at->format('m/d/Y') }}</td>
                                <td class="border px-8 py-4">{{ $status->type }}</td>
                                <td class="border px-8 py-4">{{ $status->post }}</td>
                                <td class="border px-8 py-4">
                                    <div class="items-center flex h-full justify-between">
                                        <a href="{{ route('admin.statuses.edit', $status) }}" class="p-1 hover:text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <a href="{{ route('admin.statuses.delete', $status) }}" class="p-1 hover:text-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
