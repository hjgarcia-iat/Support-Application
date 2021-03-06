<header class="page-header mb-10 relative z-20">
    <div class="overlay h-full">
        <div class="h-full py-2 px-3 flex justify-between items-center md:py-10 md:px-5 container mx-auto relative">
            <div class="md:hidden text-white" x-show="search===false">
                <a href="" @click.prevent="mobile_nav = true" x-show="mobile_nav === false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </a> <a href="" @click.prevent="mobile_nav = false" x-show="mobile_nav === true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>

            <div class="md:hidden" x-show="search===false">
                <a href="https://www.activatelearning.com/"> <img src="{{ asset('img/logo-w.png') }}"
                            class="w-48 md:w-64" alt="Activate Learning"> </a>
            </div>
            <div class="hidden md:block">
                <a href="https://www.activatelearning.com/"> <img src="{{ asset('img/logo-w.png') }}"
                            class="w-48 md:w-64" alt="Activate Learning"> </a>
            </div>
            <nav class="flex flex-col bg-white border-b w-full absolute top-12 left-0 shadow" x-show.transition="mobile_nav" x-on:click.away="mobile_nav=false"
                    x-transition:enter="transition-transform ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-end="transform -translate-y-3">
                <a class="text-gray-700 px-5 py-3 border-b block hover:text-orange-500 hover:bg-blue-50"
                        href="{{ route('home') }}">Home</a>

                <a class="text-gray-700 px-5 py-3 border-b block hover:text-orange-500 hover:bg-blue-50"
                        href="{{ route('system_status.index') }}">System Status</a>

                <a class="text-gray-700 px-5 py-3 border-b block hover:text-orange-500 hover:bg-blue-50"
                        href="{{ route('support_ticket.create') }}">Contact Support</a>
            </nav>


        <nav class="hidden md:block flex ml-auto" x-show.transition="search===false">
                <a class="text-white text-lg inline-block sm:mx-1 lg:mx-6 hover:opacity-90 {{ request()->is('/') ? 'border-blue-400 border-b-2' : '' }}"
                        href="{{ route('home') }}">Home</a>

                <a class="text-white text-lg inline-block sm:mx-1 lg:mx-6 hover:opacity-90 {{ request()->is('system-status') ? 'border-blue-400 border-b-2' : '' }}"
                        href="{{ route('system_status.index') }}">System Status</a>

                <a class="text-white text-lg inline-block sm:mx-1 lg:mx-6 hover:opacity-90 {{ request()->is('support-ticket/create') ? 'border-blue-400 border-b-2' : '' }}"
                        href="{{ route('support_ticket.create') }}">Contact Support</a>
            </nav>

            <div x-show="search === true" class="flex items-center md:ml-auto w-full md:w-100">
                <input id="search-field" placeholder="Search..." type="text"
                        class="rounded-full mr-2 bg-white text-gray-700 px-4 py-1 border-gray-600 focus:outline-none flex-1">
                <a href="" @click.prevent="search = false" class="cursor-pointer text-white" x-show="search === true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>

            <div class="text-white sm:ml-2 lg:ml-4" x-show="search === false">
                <a @click.prevent="search = true" class="cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>
