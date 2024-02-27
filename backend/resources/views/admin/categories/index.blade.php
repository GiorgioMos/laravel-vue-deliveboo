@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
	<div class="row justify-content-center">

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Categorie') }}</div>
				<div class="card-body">
					<div id="cardBox" class="container">
						<div class="row">
							@foreach ($categories as $category)

							<div class="col-4 mb-4 rounded d-flex flex-column align-items-center card" id="card">
								
								<p class="text-capitalize fw-bold text-center my-2">{{ $category->name }}</p>
								<p> {{$category->description}}</p>
								
								<img src="{{$category->img}}" alt="category-img">

								<div class="d-flex justify-content-center align-items-center">
									<a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
	
									<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline-block">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger inline-block">
											<i class="fa-solid fa-trash-can"></i>
										</button>
									</form>
	
									<a href="{{ route('admin.categories.show', $category->id) }}" class="btn info-btn my-3"><i class="fa-solid fa-circle-info fa-2xl"></i></a>
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