@extends("admin.main.mainPage")
@section("content")
<table class="table table-hover mt-2 ms-2 me-s">
    <thead>
    <tr>
        <th scope="col">Index</th>
        <th scope="col">Mã đơn</th>
        <th scope="col">Thời gian</th>
        <th scope="col">Tiền</th>
        <th scope="col">Giảm giá</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Id khách</th>
        <th scope="col">Chi tiết</th>
    </thead>
    <tbody>
        @php
        $index=1; 
        @endphp
        @foreach ($all as $item)
            <th scope="row">{{$index}}</th>
            <td>{{$item->order_code}}</td>
            <td>{{$item->time}}</td>
            <td>{{number_format($item->money)}} VND</td>
            <td>{{$item->discount}} VND</td>
            <td>{{$item->status}}</td>
            <td>{{$item->customer_id}}</td>        
            <td><a href="{{route('order_detail',$item->id)}}">Chi tiết</a></td>        
            </tr>
            @php
                $index++; 
            @endphp
        @endforeach
    </tbody>
</table>
<div class="pagination-center" style="display: flex;justify-content: center;">{{ $all->links() }}</div>
@endsection