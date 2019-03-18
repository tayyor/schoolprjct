@extends('layouts.app')
@php
    $title = 'Application Broke - '.Config::get('app.name');
@endphp

@section('content')
    <section class="error">
        <div class="error__inner">
            <h2 class="title text-center">Something went wrong !!!</h2>
            <div class='panel panel-primary'>
                <div class="panel-body text-center">
                    <p><strong>Don't panic, Our engineers are notified</strong> <br />
                        This could also be a work in progress page or broken link.
                        This will be resolved in less than <strong>24hrs</strong> </p>
                    <br />
                    <p>Kindly go back to the previous page. <br /><em>See button below</em> <i class='fa fa-arrow-down'></i></p>
                    <button class='btn btn-warning' onclick="return location.href='{{ URL::previous() }}'">Go back</button>
                </div>
            </div>
        @unless(empty($sentryID))
            <!-- Sentry JS SDK 2.1.+ required -->
                <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

                <script>
                    Raven.showReportDialog({
                        eventId: '{{ $sentryID }}',

                        // use the public DSN (dont include your secret!)
                        dsn: '{{ env('SENTRY_DSN', '') }}'
                    });
                </script>
            @endunless
        </div>
    </section>
@endsection