<!-- Transactions -->
<div class="col-md-6 col-lg-4 order-2 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Transactions</h5>
            <div class="dropdown">
                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true"
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
            <ul class="p-0 m-0">
                @forelse ($transactions as $transaction)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="bx {{ $transaction->icon }}"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Paypal</small>
                                <h6 class="mb-0">{{ $transaction->title }}</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0">{{ $transaction->total_amount }}</h6>
                                <span class="text-muted">USD</span>
                            </div>
                        </div>
                    </li>
                @empty
                    <li>
                        <span class="w-100">No Transactions Yet!</span>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
