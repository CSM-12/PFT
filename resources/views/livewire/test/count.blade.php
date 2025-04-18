<div>
    <button wire:click="addCount">Add</button>
    <button wire:click="subCount">Sub</button>
    <button wire:click="$refresh">Test</button>

    <input wire:model.change="negation" type="checkbox">

    <h4>Count:
        @if ($negation)
            -
        @endif
        {{ $count }}
    </h4>
</div>
