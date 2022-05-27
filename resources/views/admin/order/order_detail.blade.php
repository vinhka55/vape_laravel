@extends("admin.main.mainPage")
@section("content")
    <div class="shipping-info">
        <h3>Thông tin nhận hàng</h3>
        @foreach ($shipping as $item)
            <p>Họ tên: {{$item->name}}</p>
            <p>Email: {{$item->email}}</p>
            <p>Số điện thoại: {{$item->phone}}</p>
            <p>Địa chỉ: {{$item->address}}</p>
            <p>Phương thức thanh toán : {{$item->method}}</p>
        @endforeach
    </div>
    <div class="product-info">
        <h3>Thông tin sản phẩm</h3>
        <div class="info-cart">
            <table class="table product-checkout">
                <tbody>                
                    @foreach ($product as $item)
                        <tr>
                            <td class="img" style="position: relative">
                                <img style="width: 25%;" class="product-checkout__img" src="{{url('/')}}/public/images/products/{{$item->product_image}}" alt="{{$item->product_name}}">
                                <div class="qty-product-buy">{{$item->product_qty}} sản phẩm</div>
                            </td>
                            <td class="name">{{$item->product_name}}</td>
                            <td class="price">{{$item->product_qty.' x '.number_format($item->product_price)}}đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="final-money">
                <span style="font-weight: 500">Tổng cộng</span>
                <span>VND {{number_format($priceOrder)}}đ</span>
            </div>
        </div>
    </div>
@endsection