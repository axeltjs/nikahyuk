<!-- Reciever Message-->
<div class="media w-50 ml-auto mb-3">
    <div class="media-body">
        <div class="bg-primary rounded py-2 px-3 mb-2">
        <p class="text-small mb-0 text-white">{!! $item->message !!}</p>
        </div>
        <p class="small text-muted">{{ $item->send_date }}</p>
    </div>
</div>