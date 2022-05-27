<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/base.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/main.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/reponsive.css">

    <script src="{{url('/')}}/public/backend/assets/vendor/libs/jquery/jquery.js"></script>

    <title>VapeVN - Thanh toán đơn hàng</title>
</head>
<body>
    <div class="grid">
        <form action="{{route('checkout_success')}}" method="post" class="mt-3">
            <div class="checkout">
                <div class="info-shipping">
                    <div class="content-top__logo logo-checkout">
                        <a href="{{route('home')}}"><img src="{{url('/')}}/public/assets/img/logo/logo.webp" alt="logo" class="img-logo"></a>
                    </div>
                    <div class="breabrum breabrum-checkout">
                        <div class="grid content-breabrum">
                            <a href="{{route('home')}}" class="link-home">Giỏ hàng</a>
                            <span style="color: black;margin:0 5px;font-size:1.5rem;">></span>
                            <span class="text-collections" style="color: black">Thông tin giao hàng</span>
                            <span style="color: black;margin:0 5px;font-size:1.5rem;">></span>
                            <span class="text-collections" style="color: black">Phương thức thanh toán</span>
                        </div>
                    </div>
                    <h3>Thông tin giao hàng</h3>
                    <span>Bạn đã có tài khoản?</span><a href="{{route('login')}}">Đăng nhập</a>
                    <?php
                        $order_code = '#'.strtotime("now").rand(1,1000);
                    ?>         
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="fullName" id="fullname" placeholder="Họ và tên">
                        </div>
                        <div class="mb-3" style="display:flex;">
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="mb-3" style="display:flex">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="provincial-select" name="provincial">
                                <option selected>-- Tỉnh,Thành Phố --</option>
                                @foreach ($provincial as $item)
                                    <option value="{{$item->matp}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="district-select" name="district">
                                <option selected>-- Quận,Huyện --</option>
                            </select>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="ward-select" name="ward">
                                <option selected>-- Xã,Phường --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="detail_address" id="address" placeholder="Địa chỉ chi tiết">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="note" id="note" placeholder="Ghi chú">
                        </div>
                        <div class="form-check mt-3" id="pay-method-form">
                            <input class="form-check-input" type="radio" name="method_pay" id="cod" value="cash" checked>
                            <label class="form-check-label" for="cod">
                                Thanh toán khi nhận hàng
                            </label><br>
                            <input class="form-check-input" type="radio" name="method_pay" id="atm" value="atm">
                            <label class="form-check-label" for="atm">
                                Chuyển khoản qua ngân hàng
                            </label>                       
                            <input type="hidden" value="{{$order_code}}" id="order-code" name="order_code">
                        </div>
                        <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </div>
                <div class="info-cart">
                    <table class="table product-checkout">
                        <thead>
                        </thead>
                        <tbody>
                            <?php $total_money=0; ?>
                            @if (Session::get('cart'))
                                @foreach (Session::get('cart') as $item)
                                    <tr>
                                    <td class="img" style="position: relative">
                                        <img class="product-checkout__img" src="{{url('/')}}/public/images/products/{{$item['image']}}" alt="{{$item['name']}}">
                                        <div class="qty-product-buy">{{$item['qty']}}</div>
                                    </td>
                                    <td class="name">{{$item['name']}}</td>
                                    <td class="price" style="width:40%;">{{$item['qty']}} x {{number_format($item['price'])}}đ</td>
                                    <?php $total_money += $item['price']*$item['qty']; ?>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    <div class="mb-3 coupon">
                        <input type="text" class="form-control input-coupon" id="coupon" aria-describedby="emailHelp" placeholder="Mã giảm giá">
                        <button class="btn-coupon btn btn-primary" disabled>Sử dụng</button>
                    </div>
                    <div class="money">
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
                        <input type="hidden" name="total_money" value="{{$total_money}}">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $('input[type=radio][name=method_pay]').change(function() {
            var order_code=$('#order-code').val()
            $( ".show-id-bank" ).remove();
            if (this.value == 'atm') {
                $('#pay-method-form').append('<div class="show-id-bank"><p>Chủ tài khoản: Lê Hữu Vinh STK: 189200331 Ngân hàng: VPBANK </p><p>Chủ tài khoản: Lê Hữu Vinh STK: 123456778 Ngân hàng: VIETCOMBANK </p><p class="text-danger h4">Nội dung chuyển khoản là mã đơn hàng của bạn: '+order_code+'</p></div>')
            }           
        });
        $('#provincial-select').change(function(){
            var matp = $('#provincial-select').val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{route("choose_address")}}',
                data: {
                    matp:matp
                },
                success: function(data) {  
                    $('#district-select').html('')
                    $('#district-select').append(data)
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            })
        })
        $('#district-select').change(function(){
            var maqh = $('#district-select').val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{route("choose_ward")}}',
                data: {
                    maqh:maqh
                },
                success: function(data) {  
                    $('#ward-select').html('')
                    $('#ward-select').append(data)
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            })
        })
    </script>
</body>
</html>