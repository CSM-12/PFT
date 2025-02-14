<div id="toast_container" class="vstack gap-3 fixed-bottom align-items-end p-2">

    @if (session()->has('alerts'))
        @foreach (session('alerts') as $status => $messageList)
            @foreach ($messageList as $message)
                <x-toast class="bg-{{ $status }}" name="toast-name">{{ $message }}</x-toast>
            @endforeach
        @endforeach
    @endif

</div>