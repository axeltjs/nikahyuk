@foreach ($data as $item)

    @if ($item->user_id == $user_id)
        <!-- Reciever Message-->
        <div class="media w-50 ml-auto mb-3">
            <div class="media-body">
                <div class="bg-primary rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-white">{!! $item->message !!}</p>
                </div>
                <p class="small text-muted">{{ $item->send_date }}</p>
            </div>
        </div>
    @else
        <!-- Sender Message-->
        <div class="media w-50 mb-3">
            <img src="{{ $item->user->photo_format_url }}" alt="user" width="50" class="rounded-circle">
            <div class="media-body ml-3">
                <div class="bg-light rounded py-2 px-3 mb-2">
                <p class="text-small mb-0 text-muted">{!! $item->message !!}</p>
                </div>
                <p class="small text-muted">{{ $item->send_date }}</p>
            </div>
        </div>
    @endif
@endforeach