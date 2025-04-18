<div>
    {{-- Type --}}
    <div class="row mb-3">
        <label class="col-sm-2 form-label" for="category_type">Type</label>

        <div class="col-sm-10">
            {{-- Transactions --}}
            <input type="radio" class="btn-check" name="category_type" id="transaction" value="transaction"
                wire:model.change="type">
            <label class="btn btn-outline-primary" for="transaction">Transaction</label>

            {{-- Savings --}}
            <input type="radio" class="btn-check" name="category_type" id="saving" value="saving"
                wire:model.change="type">
            <label class="btn btn-outline-success" for="saving">Saving</label>

            {{-- Investment --}}
            <input type="radio" class="btn-check" name="category_type" id="investment" value="investment"
                wire:model.change="type">
            <label class="btn btn-outline-info" for="investment">Investment</label>
        </div>

        {{-- field error --}}
        <x-input-error :errors="$errors" :field="'category_type'"></x-input-error>
    </div>

    {{-- Category --}}
    <div class="row mb-3">
        <label for="category_id" class="col-sm-2 form-label">Category</label>

        <div class="col-sm-10">
            <select name="category_id" class="form-select">

                {{-- Options for categories --}}
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $category_id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- field error --}}
        <x-input-error :errors="$errors" :field="'category_id'"></x-input-error>
    </div>

    {{-- Direction --}}
    {{-- Labels --}}
    @php
        switch ($type) {
            case 'saving':
                $incomeLabel = 'Deposit';
                $expenseLabel = 'Withdraw';
                break;
            case 'investment':
                $incomeLabel = 'Invest';
                $expenseLabel = 'Redeem';
                break;
            default:
                $incomeLabel = 'Income';
                $expenseLabel = 'Expense';
        }
    @endphp

    {{-- Direction Input --}}
    <div class="row mb-3">
        <label class="col-sm-2 form-label" for="direction">Actions</label>

        <div class="col-sm-10">
            <div>
                {{-- Transactions --}}
                <input type="radio" class="btn-check" name="direction" id="income" value="1" {{ $direction ? 'checked' : ''}}
                    autocomplete="off">
                <label class="btn btn-outline-success" for="income">{{ $incomeLabel }}</label>

                {{-- Savings --}}
                <input type="radio" class="btn-check" name="direction" id="expence" value="0" {{ !$direction ? 'checked' : ''}}
                    autocomplete="off">
                <label class="btn btn-outline-danger" for="expence">{{ $expenseLabel }}</label>
            </div>
        </div>

        {{-- field error --}}
        <x-input-error :errors="$errors" :field="'direction'"></x-input-error>
    </div>
</div>
