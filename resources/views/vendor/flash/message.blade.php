@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div style="top: 0;
    position: fixed;
    width: 100%;">

            <div style="width: 50%;margin-left: 25%;
            border-color: #000000;border-width: 2px;"
                 class="alert
                        alert-{{ $message['level'] }}
                 {{ $message['important'] ? 'alert-important' : '' }}"
                 role="alert"
            >
                {{--            @if ($message['important'])--}}
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            {{--@endif--}}

                {!! $message['message'] !!}
            </div>

        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
