@extends("admin.main.mainPage")
@section("content")
<table class="table table-hover mt-2 ms-2 me-s">
    <thead>
    <tr>
        <th scope="col">Index</th>
        <th scope="col">Ảnh</th>
        <th scope="col">Tên</th>
        <th scope="col">Giá</th>
        <th scope="col">Xuất xứ</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
        @php
        $index=1; 
        @endphp
        @foreach ($product as $item)
            <tr id="{{$item->id}}">
                <th scope="row">{{$index}}</th>
                <td style="width: 200px;"><img style="width:50%;" src="{{url('/')}}/public/images/products/{{$item->image}}" alt="{{$item->name}}"></td>
                <td>{{$item->name}}</td>
                <td>{{number_format($item->price)}}</td>
                <td>{{$item->origin}}</td>
                <td>
                <a href="#" title="xóa"><i onclick="deleteProduct({{$item->id}})" class="fa-solid fa-trash text-danger ms-2"></i></a>
                </td>
            </tr>
            @php
                $index++; 
            @endphp
        @endforeach
    </tbody>
</table>
<div class="pagination-center" style="display: flex;justify-content: center;">{{ $product->links() }}</div>
<script>
    function deleteProduct(id) {
            $.ajax({
                type: 'POST',
                url: '{{route("delete_product")}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },
                success: function(data) {
                    $('#'+id).remove()
                    new Notify ({
                        title: 'Thành công',
                        text: 'Xóa sản phẩm thành công',
                        status: 'success',
                        autoclose: true,
                        autotimeout: 1000
                    })
                }
            })
        }
</script>
@endsection