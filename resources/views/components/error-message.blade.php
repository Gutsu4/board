@props(['messages'])
@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-12 text-red font-bold']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
