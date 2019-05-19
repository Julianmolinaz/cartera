@section('title','Reporte Asis-data')
@section('contenido')

<form action="{{ route('data.data_asis') }}" method="POST" enctype="multipart/form-data">
    Select image to upload:
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>


@endsection
@include('templates.main2')