@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;

    // Helper: safe date parsing (works whether $event->date is string or Carbon)
    $toDate = function ($value) {
        return $value ? Carbon::parse($value) : null;
    };
@endphp

<style>
    .events-hero {
        background: radial-gradient(1200px circle at 10% 10%, rgba(13,110,253,.18), transparent 55%),
                    radial-gradient(900px circle at 90% 0%, rgba(25,135,84,.18), transparent 60%),
                    linear-gradient(180deg, rgba(248,249,250,1), rgba(255,255,255,1));
        border: 1px solid rgba(0,0,0,.06);
    }
    .event-card {
        transition: transform .18s ease, box-shadow .18s ease;
        border: 1px solid rgba(0,0,0,.06);
    }
    .event-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 .75rem 2rem rgba(0,0,0,.08);
    }
    .event-date-pill {
        background: rgba(13,110,253,.08);
        border: 1px solid rgba(13,110,253,.20);
        color: #0b5ed7;
        font-weight: 600;
    }
</style>

<div class="container py-4">

    {{-- HERO --}}
    <div class="events-hero rounded-4 p-4 p-md-5 mb-4">
        <div class="row align-items-center g-3">
            <div class="col-md-7">
                <h1 class="h3 mb-2 fw-bold">Events</h1>
                <p class="mb-0 text-secondary">
                    Explore upcoming activities, announcements, and community events.
                </p>
            </div>

            <div class="col-md-5">
                {{-- Search (optional). This works if you add ?q= to your controller filter --}}
                <form method="GET" action="{{ url('/events') }}" class="d-flex gap-2">
                    <input
                        type="text"
                        name="q"
                        class="form-control form-control-lg"
                        placeholder="Search events..."
                        value="{{ request('q') }}"
                    >
                    <button class="btn btn-primary btn-lg px-4" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- TOP BAR --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
        <div class="text-secondary">
            @isset($events)
                <span class="fw-semibold text-dark">
                    {{ method_exists($events, 'total') ? number_format($events->total()) : count($events) }}
                </span>
                events found
            @endisset
        </div>

        {{-- Optional quick filters (needs controller support) --}}
        <div class="d-flex gap-2">
            <a href="{{ url('/events') }}" class="btn btn-outline-secondary {{ request('type') ? '' : 'active' }}">
                All
            </a>
            <a href="{{ url('/events?type=upcoming') }}" class="btn btn-outline-secondary {{ request('type')==='upcoming' ? 'active' : '' }}">
                Upcoming
            </a>
            <a href="{{ url('/events?type=past') }}" class="btn btn-outline-secondary {{ request('type')==='past' ? 'active' : '' }}">
                Past
            </a>
        </div>
    </div>

    {{-- EVENTS GRID --}}
    <div class="row g-3 g-md-4">
        @forelse($events as $event)
            @php
                $d = $toDate($event->date ?? null);
                $isUpcoming = $d ? $d->isToday() || $d->isFuture() : false;
            @endphp

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card event-card h-100 rounded-4">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-start justify-content-between gap-2 mb-3">
                            <span class="badge {{ $isUpcoming ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} rounded-pill px-3 py-2">
                                {{ $isUpcoming ? 'Upcoming' : 'Past' }}
                            </span>

                            <span class="badge event-date-pill rounded-pill px-3 py-2">
                                {{ $d ? $d->format('M d, Y') : 'TBA' }}
                            </span>
                        </div>

                        <h5 class="card-title fw-bold mb-2">
                            {{ $event->title }}
                        </h5>

                        <p class="card-text text-secondary mb-4">
                            {{ $event->description ? Str::limit($event->description, 140) : 'No description available.' }}
                        </p>

                        <div class="mt-auto d-flex align-items-center justify-content-between">
                            <div class="text-secondary small">
                                @if($d)
                                    <i class="bi bi-clock-history me-1"></i>
                                    {{ $d->diffForHumans() }}
                                @else
                                    <i class="bi bi-info-circle me-1"></i>
                                    Date not set
                                @endif
                            </div>

                            {{-- If you later create a detail page, change this to route('events.show', $event->id) --}}
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->id }}">
                                View
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal (nice UX without needing /events/{id} route) --}}
            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content rounded-4">
                        <div class="modal-header border-0 pb-0">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge {{ $isUpcoming ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                        {{ $isUpcoming ? 'Upcoming' : 'Past' }}
                                    </span>
                                    <span class="text-secondary small">
                                        {{ $d ? $d->format('l, M d, Y') : 'TBA' }}
                                    </span>
                                </div>
                                <h5 class="modal-title fw-bold">{{ $event->title }}</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pt-3">
                            <div class="text-secondary">
                                {!! nl2br(e($event->description ?? 'No description available.')) !!}
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="border rounded-4 p-5 text-center bg-light">
                    <h5 class="fw-bold mb-2">No events found</h5>
                    <p class="text-secondary mb-0">Try another keyword or check back later.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if(method_exists($events, 'links'))
        <div class="mt-4 d-flex justify-content-center">
            {{ $events->withQueryString()->links() }}
        </div>
    @endif

</div>
@endsection



