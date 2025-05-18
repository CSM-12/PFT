@props(['items'])

<div class="w-100 breadcrumb-container"  style="overflow-x: auto">
    <h4 class="fw-bold py-3 mb-4 mb-sm-2 d-inline-block text-nowrap">
        @foreach ($items as $item)
            @php
                $label = $item[0];
                $url = $item[1] ?? null;
            @endphp

            @if (!$loop->last)
                <span class="fw-light">
                    @if ($url)
                        <a href="{{ $url }}" class="text-muted text-decoration-none">
                            {{ $label }}
                        </a>
                    @else
                        {{ $label }}
                    @endif
                    /
                </span>
            @else
                {{ $label }}
            @endif
        @endforeach
    </h4>
</div>
