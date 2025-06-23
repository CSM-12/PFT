<div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income"
                        aria-selected="true">
                        Income
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-expence"
                        aria-controls="navs-tabs-line-card-expence">Expenses</button>
                </li>
            </ul>
        </div>
        <div class="card-body px-0">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-wallet"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Balance</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1">{{ config('currency')[Auth::user()->currency]['symbol'] }} 459.10</h6>
                                <small class="text-success fw-semibold">
                                    <i class="bx bx-chevron-up"></i>
                                    42.9%
                                </small>
                            </div>
                        </div>
                    </div>
                    <div id="incomeChart"></div>
                    <div class="d-flex justify-content-center pt-4 gap-2">
                        <div class="flex-shrink-0">
                            <div id="incomeOfQuarter"></div>
                        </div>
                        <div>
                            <p class="mb-n1 mt-1">Expenses This Quarter</p>
                            <small class="text-muted">
                                {{ config('currency')[Auth::user()->currency]['symbol'] }} {{ abs($Semester_transactions['difference']['income'] ?? 0) }}
                                {{ ($Semester_transactions['difference']['income'] ?? 0) >= 0 ? 'more' : 'less' }} than last quarter
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Expense --}}
                <div class="tab-pane fade show" id="navs-tabs-line-card-expence" role="tabpanel">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-wallet"></i>
                            </span>
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Balance</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1">{{ config('currency')[Auth::user()->currency]['symbol'] }} 459.10</h6>
                                <small class="text-success fw-semibold">
                                    <i class="bx bx-chevron-up"></i>
                                    42.9%
                                </small>
                            </div>
                        </div>
                    </div>
                    <div id="expenseChart"></div>
                    <div class="d-flex justify-content-center pt-4 gap-2">
                        <div class="flex-shrink-0">
                            <div id="expensesOfWeek"></div>
                        </div>
                        
                        <div>
                            <p class="mb-n1 mt-1">Expenses This Quarter</p>
                            <small class="text-muted">
                                {{ config('currency')[Auth::user()->currency]['symbol'] }} {{ abs($Semester_transactions['difference']['expense'] ?? 0) }}
                                {{ ($Semester_transactions['difference']['expense'] ?? 0) >= 0 ? 'more' : 'less' }} than last quarter
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.Semester_transactions = @json($Semester_transactions);
</script>
