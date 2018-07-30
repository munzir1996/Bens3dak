<form action="{{ route('test.store') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}

    Order ID: <input type="text" name="order_id">
    Select images: <input type="file" name="picture[]" multiple>
    <input type="submit">

</form>



@foreach($pictures as $picture)
{{ $picture }}
@endforeach

