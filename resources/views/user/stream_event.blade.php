@extends('layouts.app')

@section('container')
    @if(count($events) < 1)
        <div class="event">
            <div class="event_title">No event found.</div>
        </div>
    @else
        @foreach($events as $event)
            <div class="event">
                <div class="event_title">{{ $event->event_title }} <small>{{ $event->created_at }}</small></div>
                @if($event->event_body != "")
                    <div class="event_body">
                       <pre>{{ $event->event_body }}</pre>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
    {{ $events->links() }}
@endsection