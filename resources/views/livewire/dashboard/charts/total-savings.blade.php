<div class="col-12 mb-4">

    {{-- {{ dd($totalSavings) }} --}}
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                        <h5 class="text-nowrap mb-2">Total Savings</h5>
                        <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                    </div>
                    <div class="mt-sm-auto">
                        <h3 class="mb-0">${{ $totalSavings['total'] }}</h3>
                    </div>
                </div>
                <div id="totalSavingsChart"></div>
            </div>
        </div>
    </div>
</div>

<script>
    window.total_savings = @json($totalSavings);    
</script>