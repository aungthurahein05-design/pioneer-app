@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;

    // Helper: safe date parsing (works whether $event->date is string or Carbon)
    $toDate = function ($value) {
        return $value ? Carbon::parse($value) : null;
    };

    // Helper: normalize YouTube URLs to embed URL
    $toYoutubeEmbed = function ($url) {
        if (!$url) return null;

        // youtube.com/watch?v=xxxx
        if (Str::contains($url, 'youtube.com/watch')) {
            parse_str(parse_url($url, PHP_URL_QUERY) ?? '', $q);
            if (!empty($q['v'])) return 'https://www.youtube.com/embed/' . $q['v'];
        }

        // youtu.be/xxxx
        if (Str::contains($url, 'youtu.be/')) {
            $id = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');
            if ($id) return 'https://www.youtube.com/embed/' . $id;
        }

        // already embed
        if (Str::contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        return null;
    };
@endphp

<style>
    /* =========================
   EVENTS PAGE DESIGN
========================= */

.events-hero {
  background:
    radial-gradient(1200px circle at 10% 10%, rgba(13,110,253,.18), transparent 55%),
    radial-gradient(900px circle at 90% 0%, rgba(25,135,84,.18), transparent 60%),
    linear-gradient(180deg, rgba(248,249,250,1), rgba(255,255,255,1));
  border: 1px solid rgba(0,0,0,.06);
}

.event-card {
  transition: transform .18s ease, box-shadow .18s ease;
  border: 1px solid rgba(0,0,0,.06);
  background: #fff;
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

.event-cover {
  width: 100%;
  height: 200px;
  object-fit: cover;
  background: #f1f3f5;
}

.event-cover-empty {
  height: 200px;
  background: #f1f3f5;
}

.event-modal-image {
  max-height: 380px;
  object-fit: cover;
}

.text-truncate-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
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
                {{-- Search --}}
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

        {{-- Filters --}}
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
                $isUpcoming = $d ? ($d->isToday() || $d->isFuture()) : false;

                // Video handling
                $youtubeEmbed = $toYoutubeEmbed($event->video ?? null);
                $isYoutube = !is_null($youtubeEmbed);

                // If video is a storage path (example: "events/videos/a.mp4")
                // set $videoSrc = asset('storage/'.$event->video) instead.
                $videoSrc = $event->video ?? null;
            @endphp

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card event-card h-100 rounded-4 overflow-hidden">

                    {{-- IMAGE THUMBNAIL --}}
                    @if(!empty($event->image))
                        <img src="{{ asset('storage/'.$event->image) }}"
                             class="event-cover"
                             alt="event image">
                    @else
                        <div class="event-cover d-flex align-items-center justify-content-center text-secondary">
                            No Image
                        </div>
                    @endif

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

                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#eventModal{{ $event->id }}">
                                View
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL --}}
            <div class="modal fade" id="eventModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content rounded-4 overflow-hidden">
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

                            {{-- IMAGE FULL --}}
                            @if(!empty($event->image))
                                <div class="mb-3">
                                    <img src="{{ asset('storage/'.$event->image) }}"
                                         class="img-fluid rounded-3 w-100"
                                         style="max-height:380px; object-fit:cover;"
                                         alt="event image">
                                </div>
                            @endif

                            {{-- VIDEO --}}
                            @if(!empty($event->video))
                                <div class="mb-3">
                                    @if($isYoutube)
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $youtubeEmbed }}" allowfullscreen></iframe>
                                        </div>
                                    @else
                                        {{-- If you stored MP4 inside storage, change to: asset('storage/'.$event->video) --}}
                                        <video controls class="w-100 rounded-3" style="max-height:380px;">
                                            <source src="{{ $videoSrc }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>
                            @endif

                            {{-- DESCRIPTION --}}
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
