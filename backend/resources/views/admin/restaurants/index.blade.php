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
							<div class="col-4 mb-4 rounded d-flex flex-column align-items-center" id="card">
								<div class="imgBoxIndex rounded">
									<img class="cardImg rounded" src={{$restaurant->img}} alt="">
								</div>
								<p class="text-capitalize fw-bold text-center my-2">{{ $restaurant->name }}</p>
								<p> {{$restaurant->description}}</p>
								<p> {{$restaurant->city}}</p>
								<p> {{$restaurant->address}}</p>
								<p> {{$restaurant->telephone}}</p>
								<p> {{$restaurant->website}}</p>

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