@php
    $icons = config('category_icons');
@endphp

<div class="row mb-3">

    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">
        Icon
    </label>

    <div class="col-sm-10" data-bs-toggle="modal" data-bs-target="#icon-selector">
        <span class="h3 border border-1 p-2 rounded bx {{ $name }}" id="icon-selector-preview"></span>

        <input type="hidden" name="icon" id="icon-selector-input" value="{{ $name }}">

        {{-- field error --}}
        <x-input-error :errors="$errors" :field="'icon'"></x-input-error>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="icon-selector" tabindex="-1" aria-labelledby="iconSelectorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Icon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($icons as $icon)
                        <button type="button" class="btn btn-icon btn-primary"
                            onclick="setIcon('{{ $icon }}')" data-bs-dismiss="modal">
                            <span class="bx {{ $icon }}"></span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function setIcon(iconName) {
            const iconSpan = document.getElementById('icon-selector-preview');
            const iconInput = document.getElementById('icon-selector-input');

            // Remove all existing bx- classes
            iconSpan.className = iconSpan.className
                .split(' ')
                .filter(c => !c.startsWith('bx-'))
                .join(' ');

            // Add the new icon class
            iconSpan.classList.add(iconName);

            // Update the hidden input
            iconInput.value = iconName;
        }
    </script>

</div>
