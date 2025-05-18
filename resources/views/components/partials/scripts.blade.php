<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('js/dashboards-analytics.js') }}"></script>

{{-- jQuery validation --}}
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

{{-- Toasts --}}
<script>
    // Get all toasts by class name
    const toastElements = document.querySelectorAll('.toast');

    // Loop through each toast and initialize it
    toastElements.forEach(toastElement => {
        const toast = new bootstrap.Toast(toastElement);
        toast.show(); // Show each toast
    });
</script>

{{-- Currency input --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currencyInputs = document.querySelectorAll(".currency-input");

        currencyInputs.forEach(input => {
            // Add attributes
            input.setAttribute("step", "0.01");
            input.setAttribute("min", "0");

            // Add on blur effect
            input.addEventListener("blur", function () {
                let value = parseFloat(input.value);
                if (!isNaN(value)) {
                    input.value = value.toFixed(2);
                } else {
                    input.value = '';
                }
            });
        });
    });
</script>

{{-- Scroll breadcrumb to the end --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const el = document.querySelector('.breadcrumb-container');
        if (el) {
            el.scrollLeft = el.scrollWidth;
        }
    });
</script>


{{-- Livewire script --}}
@livewireScripts
