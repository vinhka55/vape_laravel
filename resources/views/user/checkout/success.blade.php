<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/base.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/main.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/reponsive.css">

    <script src="{{url('/')}}/public/backend/assets/vendor/libs/jquery/jquery.js"></script>

    <title>VapeVN - Cảm ơn bạn đã mua hàng</title>
</head>
<body>
    <div class="grid">
        <div class="checkout">
            <div class="info-shipping">
                <div class="content-top__logo logo-checkout">
                    <a href="{{route('home')}}"><img src="{{url('/')}}/public/assets/img/logo/logo.webp" alt="logo" class="img-logo"></a>
                </div>
                <h3>Đặt hàng thành công</h3>
                <span>Mã đơn hàng: {{$order_code}}</span>
                <p>Cảm ơn bạn đã mua hàng!</p>
                <div class="info-order">
                    <h3>Thông tin đơn hàng</h3>
                    <h4>Thông tin giao hàng</h4>
                    <p>{{Session::get('shipping')->name}}</p>
                    <p>{{Session::get('shipping')->phone}}</p>
                    <p>{{Session::get('shipping')->address}}</p>
                    <p>Phương thức thanh toán</p>
                    <p>
                        @php
                            if(Session::get('shipping')->method=='atm') echo 'Thanh toán chuyển khoản';
                            else{
                                echo 'Thanh toán khi nhận hàng COD';
                            }
                        @endphp
                    </p>
                </div>
                <div class="footer">
                    <div class="need-support">
                        <span class="text-color">Cần hỗ trợ? <a href="mailto:yeuthethao37@gmail.com">Liên hệ chúng tôi</a></span>
                    </div>
                    <a href="{{route('home')}}" class="btn btn-primary">
                        Tiếp tục mua hàng
                    </a>
                </div>
            </div>
            <div class="info-cart">
                <table class="table product-checkout">
                    <thead>
                    </thead>
                    <tbody>
                        <?php $total_money=0; ?>
                        @foreach (Session::get('cart') as $item)
                            <tr>
                            <td class="img">
                                <img class="product-checkout__img" src="{{url('/')}}/public/images/products/{{$item['image']}}" alt="{{$item['name']}}">
                                <div class="qty-product-buy">{{$item['qty']}}</div>
                            </td>
                            <td class="name">{{$item['name']}}</td>
                            <td class="price">{{number_format($item['price']*$item['qty'])}}đ</td>
                            <?php $total_money += $item['price']*$item['qty']; ?>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                <div class="money mt-3">
                    <div class="total-money">
                        <span>Tạm tính</span>
                        <span>{{number_format($total_money)}}đ</span>
                    </div>
                    <div class="shipping">
                        <span>Phí vận chuyển</span>
                        <span>Thanh toán cho nhà phát hành</span>
                    </div>
                </div>
                <div class="final-money">
                    <span style="font-weight: 500">Tổng cộng</span>
                    <span>VND {{number_format($total_money)}}đ</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>