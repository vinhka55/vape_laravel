@extends("user.main.mainPage")
@section("title","Vape VN - Collections")
@section("content")
    <div class="breabrum">
        <div class="grid content-breabrum">
            <a href="{{route('home')}}" class="link-home">Trang chủ</a>
            <span style="color: white;margin-right:5px;font-size:1.5rem;">/</span>
            <span class="text-collections">Tài khoản</span>
            <span style="color: white;margin-right:5px;font-size:1.5rem;">/</span>
            <span class="text-collections">Lịch sử đơn hàng</span>
        </div>
    </div>
    <div class="grid">
        <h2>TÀI KHOẢN</h2>
        <h4>ĐƠN ĐẶT HÀNG TRƯỚC ĐÓ</h4>
        <table class="table table-hover mt-2 ms-2 me-s">
            <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Mã đơn</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Tiền</th>
                <th scope="col">Giảm giá</th>
                <th scope="col">Trạng thái</th>

            </thead>
            <tbody>
                @php
                $index=1; 
                @endphp
                @foreach ($order as $item)
                    <th scope="row">{{$index}}</th>
                    <td>{{$item->order_code}}</td>
                    <td>{{$item->time}}</td>
                    <td>{{number_format($item->money)}} VND</td>
                    <td>{{$item->discount}} VND</td>
                    <td>{{$item->status}}</td>
      
                    </tr>
                    @php
                        $index++; 
                    @endphp
                @endforeach
            </tbody>
        </table>
        <h4>THÔNG TIN TÀI KHOẢN</h4>
        @php
            echo '<p style="font-size:1.5rem;"> Họ và tên: '.Auth::user()->name.'</p>';
            echo '<p style="font-size:1.5rem;"> Email: '.Auth::user()->email.'</p>';
        @endphp
        <a href="{{route('logout')}}" style="background-color: black;padding:8px 16px;color:white">Đăng xuất</a>
    </div>
@stop