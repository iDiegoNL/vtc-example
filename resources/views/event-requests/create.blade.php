@extends('layouts.app')

@section('title', 'Request Event Server')

@section('breadcrumbs')
    <x-breadcrumb name="Home" href="{{ route('home') }}"/>
    <x-breadcrumb name="Event Request" href="{{ route('event-request.index') }}"/>
    <x-breadcrumb name="Create" active/>
@endsection

@push('scripts-top')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flatpickr-themes/dark.css') }}">
    <script src="{{ asset('assets/js/flatpickr.min.js') }}"></script>
    <script type="text/javascript">
        flatpickr("#start_at, #end_at", {
            enableTime: true,
            minDate: new Date().fp_incr(14),
            time_24hr: true,
            altInput: true,
            altFormat: "d M Y H:00 \\U\\T\\C",
            dateFormat: "Y-m-d H:i:00",
        });
    </script>

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/easymde.dark.css') }}">
@endpush

@section('content')
    <div class="container content">
        <p>
            If you are an event organiser and interested in a dedicated server, you have come to the right place.
            TruckersMP love to see community events, and are happy to support them in the best way necessary. If an
            event you are planning meets the requirements, please complete the below submission form.
        </p>

        <p class="autolink margin-bottom-25">
            <strong>Community Events Info &amp; Requirements:</strong>
            <a href="https://truckersmp.com/kb/671" target="_blank" rel="noopener">https://truckersmp.com/kb/671</a>
            <br>
            <strong>Reminder: All requests must be submitted at a minimum of 14 days in advance!</strong>
        </p>

        @if($errors->any())
            <x-alert title="Fix the errors below and try again" type="danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="autolink">{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <form action="{{ route('event-request.store') }}" method="post" class="sky-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="start_at">Server start date and time - typically one hour prior to the event's scheduled
                    start (UTC Time Zone required)</label>
                <input type="hidden" name="start_at" id="start_at" class="form-control flatpickr-input"
                       value="{{ old('start_at') }}" required="">
            </div>
            <div class="form-group margin-bottom-5">
                <label for="end_at">Server stop date and time - typically one hour after the event is scheduled to
                    finish (UTC Time Zone required)</label>
                <input type="hidden" name="end_at" id="end_at" class="form-control flatpickr-input"
                       value="{{ old('end_at') }}" required="">
            </div>
            <p class="margin-bottom-30">
                Servers can be requested only for selected hours since they are configured automatically.
            </p>
            <div class="form-group">
                <label for="name">Displayed name of the event</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required=""
                       maxlength="64">
            </div>
            <div class="form-group">
                <label for="event_link">Link to RSVP page or other proof of participants</label>
                <input type="url" name="event_link" id="event_link" class="form-control" value="{{ old('event_link') }}"
                       required="" maxlength="255">
                <small class="text-muted">The linked page should prove that the event meets the required amount of
                    participants</small>
            </div>
            <div class="form-group">
                <label for="info">Event description (for example the purpose of the event)</label>
                <x-easy-mde name="info" id="info" rows="8" class="form-control">{{ old('info') }}</x-easy-mde>
            </div>
            <div class="form-group margin-bottom-30">
                <label for="rules">Temporary rules for the event (list any TruckersMP rule exceptions, or add custom
                    rules to be enforced)</label>
                <x-easy-mde name="rules" id="rules" rows="8" class="form-control">{{ old('rules') }}</x-easy-mde>
                <p class="autolink">
                    All approved temporary rules are posted here:
                    <a href="https://forum.truckersmp.com/index.php?/topic/14237-temporary-rules-valid-during-an-event-or-a-convoy/"
                       target="_blank" rel="noopener">https://forum.truckersmp.com/index.php?/topic/14237-temporary-rules-valid-during-an-event-or-a-convoy/</a>
                </p>
            </div>
            <div class="form-group">
                <label for="header_image">Header image of the event</label>
                <label class="input input-file">
                    <div class="button">
                        <input name="header_image" type="file" accept="image/*"
                               onchange="this.parentNode.nextSibling.nextSibling.value = this.value.replace('C:\\fakepath\\', '')">
                        Browse
                    </div>
                    <input type="text" readonly="">
                </label>
                <small><strong>Accepted file types:</strong> gif, jpeg, jpe, jpg, png · <strong>Max file size:</strong>
                    4MB · <strong>Recommended size:</strong> 1920x500</small>
            </div>
            <div class="form-group">
                <label for="comment">Comment for event staff or requesting special features</label>
                <x-easy-mde name="comment" id="comment" rows="4" class="form-control">{{ old('comment') }}</x-easy-mde>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="1" name="hide">
                <i></i>
                The event is private and thus, no details will be shown publicly
            </label>
            <hr>
            <h2>Server configuration</h2>
            <div class="form-group">
                <label for="server_name">Server name (maximum 32 characters)</label>
                <input type="text" name="server_name" id="server_name" class="form-control" value="{{ old('server_name') }}" required=""
                       maxlength="32">
            </div>
            <div class="form-group">
                <label for="game">Game</label>
                <select name="game" id="game" class="form-control" required="">
                    <option value="ETS2">ETS2</option>
                    <option value="ATS">ATS</option>
                </select>
            </div>
            <div class="form-group">
                <label for="max_players">Maximum of players that can connect to the server</label>
                <input type="number" name="max_players" id="max_players" class="form-control" value="{{ old('max_players') }}" required=""
                       min="100" max="4000">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="1" name="afk">
                <i></i>
                Enable AFK kick after 10 minutes
            </label>
            <label class="checkbox">
                <input type="checkbox" value="1" name="speedlimiter">
                <i></i>
                Enable speed limiter (simulation server)
            </label>
            <label class="checkbox">
                <input type="checkbox" value="1" name="collisions" checked="">
                <i></i>
                Enable player collisions
            </label>
            <label class="checkbox">
                <input type="checkbox" value="1" name="cars_for_players">
                <i></i>
                Enable use of cars
            </label>
            <label class="checkbox">
                <input type="checkbox" value="1" name="map" checked="">
                <i></i>
                Enable live map
            </label>
            <label class="checkbox">
                <input type="checkbox" value="1" name="promods">
                <i></i>
                <img src="https://truckersmp.com/assets/img/promods_logo.png" alt="ProMods logo" class="emojione-w"
                     title="ProMods">
                Enable ProMods <small class="text-muted">(an optional map modification for <span
                        class="text-danger">ATS</span>)</small>
            </label>
            <hr>
            <div class="alert alert-info margin-bottom-0">
                This system is for serious and legitimate requests for an event server. Each request will be taken
                seriously and dealt with in a respectful and serious manner. Any event server requests you make must
                meet the requirements at the top of this form, and you will be required to provide proof that these
                requirements have been met. Each user can only request one event server at any time. Only the event
                organiser may request an event server, if you are not the organiser, you must provide proof that you
                have been nominated by the event organiser to do so. If a request is declined, you are not permitted to
                send a second request unless circumstances have changed, for example requirements being met.
            </div>
            <label class="checkbox">
                <input type="checkbox" value="1" name="agreement" required="">
                <i></i>
                I agree with the statement above
            </label>
            <button type="submit" class="btn btn-u margin-top-20">Request server</button>
        </form>
    </div>
@endsection
