@section('pageTitle','Tickets')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tickets') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-session-status class="mb-4"
                                           :status="session('status')"
                                           :type="session('type')"/>

                    <div class="my-4">
                        {{ $tickets->links() }}
                    </div>

                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="bg-gray-100 border text-left px-8 py-4">ID</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Created On</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Name</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Email</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Subject</th>
                            <th class="bg-gray-100 border text-left px-8 py-4 text-center">Is Processed</th>
                            <th class="bg-gray-100 border text-left px-8 py-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td class="border px-8 py-4">{{ $ticket->id }}</td>
                                <td class="border px-8 py-4">{{ $ticket->created_at->format('m/d/Y') }}</td>
                                <td class="border px-8 py-4">{{ $ticket->name }}</td>
                                <td class="border px-8 py-4">{{ $ticket->email }}</td>
                                <td class="border px-8 py-4">{{ $ticket->subject }}</td>
                                <td class="border px-8 py-4 text-center">
                                    @if($ticket->email_processed)
                                        <svg class="w-5 h-5 inline-block"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        @else
                                        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    @endif
                                </td>

                                <td class="border px-8 py-4">
                                    <div class="items-center flex h-full items-center">
                                        <a href="{{ route('admin.tickets.delete', $ticket) }}"
                                           class="p-1 mx-2 hover:text-red-600">
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
