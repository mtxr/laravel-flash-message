@if (session()->has('flash_notification.messages'))
    @foreach(session('flash_notification.messages') as $messageData)
    <div class="flash-message alert alert-{{ $messageData['level'] }} {{ $messageData['important'] ? 'alert-important' : '' }}">
        @if ($messageData['icon'])
            <i class="{{ $messageData['icon'] }}"></i>
        @endif
        {!! trans($messageData['message']) !!}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
    @endforeach
@endif
