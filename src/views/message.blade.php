@if (session()->has('flash_notification.messages'))
    @foreach(session('flash_notification.messages') as $messageData)
    <div class="alert alert-{{ $messageData['level'] }} {{ $messageData['important'] ? 'alert-important' : '' }}">
    @if(!$messageData['important'])
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @endif

        {!! trans($messageData['message']) !!}
    </div>
    @endforeach
@endif
