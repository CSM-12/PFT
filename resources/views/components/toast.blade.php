<div {{ $attributes->merge(['class' => 'toast align-items-center ' . ($class ?? '')]) }} role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            {{ $slot }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
