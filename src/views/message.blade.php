@if (session()->has('flash_notification.messages'))
    @foreach(session('flash_notification.messages') as $messageData)
    <div class="flash-message alert alert-{{ $messageData['level'] }} {{ $messageData['important'] ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!! trans($messageData['message']) !!}
    </div>
    @endforeach
@endif
