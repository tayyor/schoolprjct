@extends('layouts.app' )
@section('content')
    <div class="login"
         style='background: url("{{ asset('roadzoft-bg.jpg') }}") no-repeat; background-size: 100%;'>

        <div class="col-sm-12">
            <div class="card">
                {{--<div class="card-header">--}}
                {{--<h2 class="card-title">Manage Offices</h2>--}}
                {{--<small class="card-subtitle"></small>--}}
                {{--</div>--}}

                <div class="card-block">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@push('scripts')
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush