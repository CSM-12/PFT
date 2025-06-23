<!-- Order Statistics -->
<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    {{-- @json($transactionCategoriesChartData) --}}
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
                <h5 class="m-0 me-2">Transaction Categories</h5>
                <small class="text-muted">{{ $transactionCategoriesChartData['total_amount'] }} Total</small>
            </div>
            <div class="dropdown">
                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                    <a class="dropdown-item" href="javascript:void(0);"
                        wire:click.prevent="setPeriod('today')">Today</a>
                    <a class="dropdown-item" href="javascript:void(0);" wire:click.prevent="setPeriod('this_week')">This
                        Week</a>
                    <a class="dropdown-item" href="javascript:void(0);"
                        wire:click.prevent="setPeriod('this_month')">This Month</a>
                    <a class="dropdown-item" href="javascript:void(0);"
                        wire:click.prevent="setPeriod('this_quarter')">This Quarter</a>
                    <a class="dropdown-item" href="javascript:void(0);" wire:click.prevent="setPeriod('this_year')">This
                        Year</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex flex-column align-items-center gap-1">
                    <h2 class="mb-2">{{ $transactionCategoriesChartData['total_categories'] }}</h2>
                    <span>Total Categories</span>
                </div>
                <div id="orderStatisticsChart"></div>
            </div>
            <ul class="p-0 m-0">

                @forelse  ($transactionCategoriesChartData['data'] as $transactionCategoryChartData)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span
                                class="avatar-initial rounded {{ $transactionCategoryChartData['id'] ? 'bg-label-primary' : 'bg-label-secondary' }}">
                                <i class="bx {{ $transactionCategoryChartData['icon'] ?? 'bx-category-alt' }}"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $transactionCategoryChartData['title'] }}</h6>
                                <small class="text-muted">Mobile, Earbuds, TV</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">{{ config('currency')[Auth::user()->currency]['symbol'] }} {{ $transactionCategoryChartData['total_amount'] }}</small>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="d-flex mb-4 pb-1">
                        <span class="w-100 text-center">No transactions yet!</span>
                    </li>
                @endforelse

            </ul>
        </div>
    </div>
</div>

<script>
    window.transaction_categories_chart = @json($transactionCategoriesChartData);
</script>
