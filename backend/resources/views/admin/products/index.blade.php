@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
	<div class="row justify-content-center">

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Prodotti') }}</div>
				<div class="card-body">
					<div id="cardBox" class="container">
						<div class="row">
							@foreach ($products as $product)

							<div class="col-4 mb-4 rounded d-flex flex-column align-items-center card" id="card">
								<div class="imgBoxIndex rounded">
									<img class="cardImg rounded" src={{$product->img}} alt="">
								</div>
								<p class="text-capitalize fw-bold text-center my-2">{{ $product->name }}</p>
								<p> {{$product->description}}</p>
								<p> {{$product->price}}</p>
								<p> {{$product->visible}}</p>
								
								<img src="{{$product->img}}" alt="product-img">

								<div class="d-flex justify-content-center align-items-center">
									<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
	
									<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline-block">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger inline-block">
											<i class="fa-solid fa-trash-can"></i>
										</button>
									</form>
	
									<a href="{{ route('admin.products.show', $product->id) }}" class="btn info-btn my-3"><i class="fa-solid fa-circle-info fa-2xl"></i></a>
								</div>

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