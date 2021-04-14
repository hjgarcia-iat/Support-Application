@props(['status','type'])

@if ($status and $type === 'success')
    <div {{ $attributes->merge(['class' => 'text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500']) }}>
        <span class="capitalize mr-1">Success :</span> <span>{{ $status }}</span>
    </div>
@endif

@if ($status and $type === 'error')
    <div {{ $attributes->merge(['class' => 'text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500']) }}>
        <span class="capitalize mr-1">Error :</span> <span>{{ $status }}</span>
    </div>
@endif

@if ($status and $type === 'info')
    <div {{ $attributes->merge(['class' => 'text-white px-6 py-4 border-0 rounded relative mb-4 bg-lightBlue-500']) }}>
        <span class="capitalize mr-1">Information :</span> <span>{{ $status }}</span>
    </div>
@endif