<!-- Transactions -->
<div class="col-md-6 col-lg-4 order-2 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Transactions</h5>

            <a href="{{ route('transactions.index') }}">
                <button class="btn btn-sm btn-primary">View All</button>
            </a>
        </div>
        <div class="card-body">
            <ul class="p-0 m-0">
                @forelse ($transactions as $transaction)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="bx {{ $transaction->category->icon }}" data-toggle="tooltip" data-placement="top" title="{{ $transaction->category->title }}"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $transaction->title }}</h6>
                                <small
                                    class="text-muted d-block mb-1">{{ $transaction->created_at->format('h:i A, d M Y') }}</small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0">{{ $transaction->amount }}</h6>
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
