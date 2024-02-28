@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
 	<div class="row justify-content-center">
 		<div class="col-md-8">
 			<div class="card">
 				<div class="card-header">{{ __('Dashboard') }}</div>

 				<div class="card-body">
 					@if (session('status'))
 					<div class="alert alert-success" role="alert">
 						{{ session('status') }}
 					</div>
 					@endif

 					{{ __('You are logged in!') }}
 				</div>
 			</div>

			@php
				use App\Models\Restaurant;
				$currentUser = Auth::id();
				// prendo l'id del ristorante collegato all'utente
				$restaurant = Restaurant::select('id')->where('user_id', $currentUser)->first();
		 	@endphp
			@if ($restaurant)
			 <!-- Il ristorante è stato creato -->
			@else
				<!-- Il ristorante non è stato creato -->
				<div class="py-3">
					<a class="nav-link text-white {{ Route::currentRouteName() == 'admin.restaurants.create' ? 'bg-secondary' : '' }}"
						href="{{ route('admin.restaurants.create') }}">
						<button type="button" class="btn btn-dark">Crea ristorante</button>
					</a>
				</div>
			@endif


 		</div>
 	</div>
@endsection