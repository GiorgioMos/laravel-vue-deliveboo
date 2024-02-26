@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
	<div class="row justify-content-center">

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Ristoranti') }}</div>
				<div class="card-body">
					<div id="cardBox" class="container">
						<div class="row">
							@foreach ($restaurants as $restaurant)

							<div class="col-4 mb-4 rounded d-flex flex-column align-items-center card" id="card">
								<div class="imgBoxIndex rounded">
									<img class="cardImg rounded" src={{$restaurant->img}} alt="">
								</div>
								<p class="text-capitalize fw-bold text-center my-2">{{ $restaurant->name }}</p>
								<p> {{$restaurant->description}}</p>
								<p> {{$restaurant->city}}</p>
								<p> {{$restaurant->address}}</p>
								<p> {{$restaurant->telephone}}</p>
								<p> {{$restaurant->website}}</p>
								<a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>

								<form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST" class="d-inline-block">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger inline-block">
										<i class="fa-solid fa-trash-can"></i>
									</button>
								</form>

								<a href="{{ route('admin.restaurants.show', $restaurant->id) }}" class="btn info-btn my-3"><i class="fa-solid fa-circle-info fa-2xl"></i></a>

								{{-- chiusura card  --}}
							</div>

							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection