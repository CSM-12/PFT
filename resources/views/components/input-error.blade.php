@props(['errors', 'field'])

@if (isset($errors) && isset($field) && $errors->has($field))
    <p class="text-danger bg-danger-subtle p-1 mt-1 rounded">
        {{ $errors->first($field) }}
    </p>
@endif