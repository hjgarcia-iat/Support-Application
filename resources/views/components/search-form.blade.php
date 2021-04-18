@props(['route','query','placeholder'])

<form action="{{ $route }}" class="my-4 flex items-center" method="get">
    <x-input id="name" class="block w-full" type="name" name="query"
            :value="request()->get($query)" :placeholder="$placeholder"/>
    @if(request()->has($query))
        <a href="{{ $route }}" class="ml-4 hover:underline text-lightBlue-600 hover:text-lightBlue-700">Clear</a>
    @endif
</form>