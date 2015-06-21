@extends('admin.layouts.default')

{{-- Content --}}
@section('main')

    <div class="page-header">
        <h3>
            Admin : {{ Auth::user()->name }}
        </h3>
    </div>

    <div class="panel-body">
		Welkom op het admin-paneel, hier kan u producten toevoegen, wijzigen.
  		Aan de linkerkant vind u het menu om al deze zaken uit te voeren.
   
      </div>

@endsection
