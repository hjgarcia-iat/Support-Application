@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'appearance-none block w-full bg-gray-100 text-grey-darker border py-3 px-4 focus:outline-none focus:bg-white']) !!}>
    {{$slot}}
</select>
