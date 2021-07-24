@section('title','Reportes')
@section('contenido')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		@foreach($reports as $report)
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<a href="{{ route($report['route']) }}">{{ $report['name'] }}</a>
						<p>{{$report['descripcion']}}</p>
					</div>
				</div>
			</div>
		@endforeach	
	</div>
</div>

@endsection
@include('templates.main2')