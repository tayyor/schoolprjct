@extends('dashboard.unit.layout')
    @section('sub-body')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Add/Edit A Unit</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['unit.save', $jetty?$jetty->id:null]]) !!}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(old('success'))
                                <div class="alert alert-success text-center">Request was Successful</div>
                            @endif
							
        <div class="row">
            <div class="col-sm-6">
                            <div class="form-group form-group--float">
                                {!! Form::text('name', $jetty?$jetty->name:null, ['class'=>'form-control']) !!}
                                <label>Name</label>
                                <i class="form-group__bar"></i>
								
                            </div>
							
							<div class="form-group form-group--float">
                                <label>Apartment</label><br />
                                {!! Form::select('apartment_id', \App\Apartment::getApartments(), $jetty?$jetty->apartment_id:null, ['placeholder'=>'Apartment that the unit belongs to','class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
                           </div>
						   <div class="col-sm-6">
						   <div class="form-group form-group--float">
							<label>Contact</label>
							<br>
                                {!! Form::text('contact', $jetty?$jetty->contact:null, ['class'=>'form-control']) !!}
                                
                                <i class="form-group__bar"></i>
                            </div>



                               <div class="form-group form-group--float">
                                   <label>Rental Amount</label>
                                   <br>
                                   {!! Form::number('rental_amount', $jetty?$jetty->rental_amount:null, ['class'=>'form-control']) !!}

                                   <i class="form-group__bar"></i>
                               </div>

							</div>
            <div class="col-sm-12">
                <div class="form-group form-group--float">
                    <label>Security Deposit</label>
                    <br>
                    {!! Form::number('security_deposit', $jetty?$jetty->security_deposit:null, ['class'=>'form-control']) !!}

                    <i class="form-group__bar"></i>
                </div>
            </div>
							</div>
                            <div class="card-block center-block text-center align-content-center">
                                <input type="submit" value="Add /Edit Unit" class="btn btn-default waves-effect" />
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">

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
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdPuT9tawnuhygYPncDc6RVAbXB3DYXI0&libraries=places"></script>

<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('address');
		var options = {
  componentRestrictions: {country: 'nga'}
};

        var autocomplete = new google.maps.places.Autocomplete(input,options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();


        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
	<script>
        var state = "";
        $(document).ready(function(){
            $('#jetty_type').change(function(ev){
                var type = $(this).val();
				
                $.LoadingOverlay("show");
                $.ajax({
                    url: "{{ route('unit.home') }}"+"?jetty_type="+type,
                    type: 'GET',
                    dataType: 'json',
                    data: {},
                    beforeSend: setHeader,
                    success: function(data){
                        var dropdown_data = "<option value='UNKNOWN'>UNKNOWN OPERATOR</option>";
                        _.each(data.data, function(value, key){
                            dropdown_data+="<option value='"+key+"'>"+value+"</options>";
                        });
                        $('#operator-select').html(dropdown_data);
                        $.LoadingOverlay("hide");
                    }
                });
            });
        });
    </script>
	
@endpush