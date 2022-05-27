<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/base.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/main.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/reponsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/fonts/fontawesome-6.1.1/css/all.min.css">

    {{-- jquery  --}}
    <script src="{{url('/')}}/public/backend/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <title>@yield('title')</title>
</head>
<body>
    <div class="wrapper-nav-small-screen" id="js-wrapper-navigation">
        <div class="nav-small-screen" id="js-nav-small-screen">
            <h3 class="heading-text text-center">Menu</h3>
            <ul class="nav-list">
                <li class="nav-item"><a class="nav-item__link" href="">home</a></li>
                @foreach ($categoryProduct as $item)
                <li class="nav-item">
                    <a class="nav-item__link" href="{{route('show_product_with_category',$item->slug)}}">{{$item->name}}</a>
                    <?php
                        if($item->hasChildren){
                            echo '<i class="fa-solid fa-plus" onclick="showCategoryMobile('.$item->id.')"></i>';
                        }
                    ?>
                    <ul id="sub-nav-list-{{$item->id}}" class="sub-nav-list-mobile">
                        @foreach ($subCategoryProduct as $subItem)
                            @if ($item->id == $subItem->category_product_id)
                                <li class="nav-item"><a class="nav-item__link" href="{{route('show_product_with_category',$subItem->slug)}}">{{$subItem->name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>              
                @endforeach
            </ul>
        </div>
    </div>
    <div class="header">
        <div class="grid content-top">
            <div class="content-top__logo">
                <a href="{{route('home')}}"><img src="{{url('/')}}/public/assets/img/logo/logo.webp" alt="logo" class="img-logo"></a>
            </div>
            <div class="content-top__middle">
                <div class="top-social">
                    <a href="#">
                        <i class="top-social__icon fa-brands fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="top-social__icon fa-brands fa-instagram-square"></i>
                    </a>
                    <a href="#">
                        <i class="top-social__icon fa-brands fa-youtube"></i>
                    </a>
                </div>
                <div class="top-search">
                    <input type="text" class="input-search" placeholder="Tìm kiếm">
                    <button class="btn-top-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div class="content-top__end">
                <div class="address">
                    <i class="fa-solid fa-phone"></i>
                    Hồ Chí Minh: 0833379934
                </div>
                <div class="table-nav" id="js-show-nav">
                    <i class="icon-md-nav fa-solid fa-bars"></i>
                </div>
                <div class="top-user">
                    <button class="js-get-data" data-bs-toggle="modal" data-bs-target="#modalCart" style="background-color: black;border:none;">
                        <i class="fa-solid fa-cart-arrow-down cart-link">
                            <div id="count-cart">0</div>
                        </i>
                    </button>
                    @if(Auth::check())
                        <a href="{{route('profile')}}"><i class="fa-solid fa-user"></i></a>
                        <br>
                        Hi! {{Auth::user()->name}}
                    @else
                        <a href="{{route('login')}}"><i class="fa-solid fa-user"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="navigation">
        <div class="grid">
            <nav class="top-menu">
                <ul class="top-menu-list">                    
                    <li class="top-menu-item">
                        <a href="{{route('home')}}" class="top-menu-item__link">Home</a>
                    </li>
                    @foreach ($categoryProduct as $item)
                        <li class="top-menu-item">
                            <a href="{{route('show_product_with_category',$item->slug)}}" class="top-menu-item__link">
                                {{$item->name}}
                                @if ($item->hasChildren==true)
                                    <i class="fa-solid fa-chevron-down"></i>
                                @endif
                            </a>     
                            @if ($item->hasChildren==true)
                                <ul class="sub-menu-list">
                                    @foreach ($subCategoryProduct as $subItem)
                                        <li class="sub-menu">
                                            <a href="{{route('show_product_with_category',$subItem->slug)}}" class="sub-menu__link">
                                                @php
                                                    if($subItem->category_product_id==$item->id){
                                                        echo $subItem->name;
                                                    }
                                                @endphp
                                            </a></li>                                 
                                    @endforeach
                                </ul>
                            @endif                      
                        </li>
                    @endforeach                    
                    <li class="top-menu-item">
                        <a href="#" class="top-menu-item__link">Tin tức</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    {{-- modal cart  --}}
    <div class="modal fade" id="modalCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container-cart">
                    <h3 class="text-center"> GIỎ HÀNG </h3>
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="content-cart-ajax">
                        {{-- nội dung trong này nằm ở hàm show trong cart controller --}}
                    </tbody>
                    </table>
                    <div class="direct-modal">
                        <a class="link-to-product" href="{{route('all_product')}}">Mua tiếp</a>
                        <a class="link-to-checkout" href="{{route('checkout')}}">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield("content")
    <div class="footer">
        <div class="grid">
            <div class="row mobile-footer">
                <div class="footer__introduce md-footer">
                    <h2 class="title">Giới thiệu VAPEPRO</h2>
                    <p class="desc">VapePro chuyên cung cấp các sản phẩm iQOS Pod System Tinh dầu Salt Nic, Thân máy, đầu đốt, Phụ kiện Pod System chính hãng với sự phục vụ chuyên nghiệp và uy tín. VapePro mở cửa và phục vụ khách hàng từ 9:00 - 21:00 hàng ngày, kể cả Chủ nhật.
                    </p>
                </div>
                <div class="footer__address md-footer">
                    <h2 class="title">Địa chỉ VAPEPRO</h2>
                    <p class="desc">
                        <p class="detail-address">
                            <span class="location">hồ chí minh</span>
                            # 343 Phan Đình Phùng, P15, Q Bình Thạnh 090 464 8689
                        </p>
                        <p class="detail-address">
                            <span class="location">BÌNH DƯƠNG</span>
                            # 117, Phường Đông Hòa, Thị xã Dĩ An, Tỉnh Bình Dương 0398855263
                        </p>                      
                    </p>
                </div>
                <div class="footer__support md-footer">
                    <h2 class="title">Chăm sóc khách hàng</h2>
                    <ul>
                        <li class="footer__support-item"><a class="footer__support-link" href="">Sản phẩm khuyễn mãi</a> </li>
                        <li class="footer__support-item"><a class="footer__support-link" href="">Sản phẩm nổi bật</a> </li>
                        <li class="footer__support-item"><a class="footer__support-link" href="">Tất cả sản phẩm</a> </li>
                        <li class="footer__support-item"><a class="footer__support-link" href="">Ưu đãi thành viên</a> </li>
                        <li class="footer__support-item"><a class="footer__support-link" href="">Khuyễn mãi</a></li>
                        <li class="footer__support-item"><a class="footer__support-link" href="">Chính sách vận chuyển</a> </li>
                        <li class="footer__support-item"><a class="footer__support-link" href="">Chính sách bảo hành</a></li>
                    </ul>
                </div>
                <div class="footer__connect">
                    <h2 class="title">Kết nối với chúng tôi</h2>
                    <ul class="footer__connect-list">
                        <li class="footer__connect-item">
                            <a href="#">
                                <i class="top-social__icon fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <li class="footer__connect-item">
                            <a href="#">
                                <i class="top-social__icon fa-brands fa-instagram-square"></i>
                            </a>
                        </li>
                        <li class="footer__connect-item">
                            <a href="#">
                                <i class="top-social__icon fa-brands fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{url('/')}}/public/assets/js/main.js"></script>

{{-- js bootstrap  --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<script>
    function countItemCart(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: '{{route("count_item_cart")}}',
            success: function(data) {         
                document.getElementById('count-cart').innerText = data
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        })
    }
    countItemCart()

    var categoryList=document.getElementById('category-list')
    var categoryItem=document.getElementsByClassName('category__item')
    function next(){
        categoryList.append(categoryItem[0])
    }
    function prev(){
        categoryList.prepend(categoryItem[categoryItem.length-1])
    }
    var btnShowNav=document.getElementById('js-show-nav')
    var jsNavSmallScreen=document.getElementById('js-nav-small-screen')
    var wrapperNavigation=document.getElementById('js-wrapper-navigation')
    btnShowNav.onclick=function(){
        wrapperNavigation.style.display="block"
        wrapperNavigation.classList.add("animation-nav-small-screen")
    }
    // When the user clicks anywhere outside of the nav mobile or tablet, close it
    window.onclick = function(event) {
        if (event.target == wrapperNavigation) {
            wrapperNavigation.classList.remove("animation-nav-small-screen")
        }
    }
    $('.js-get-data').click(function(){
            var id = $(this).data('id')
            var image = $(this).data('image')
            var name = $(this).data('name')
            var price = $(this).data('price')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{route("show_cart")}}',
                data: {
                    id:id,
                    image:image,
                    name:name,
                    price:price
                },
                success: function(data) {      
                    document.getElementById('content-cart-ajax').innerHTML = data
                    countItemCart()
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            })
        }
    )
    function delete_product_in_cart(idProduct){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{route("delete_product_in_cart")}}',
            data: {
                idProduct:idProduct,
            },
            success: function(data) {         
                $("#product-in-cart-"+idProduct).remove()
                countItemCart()
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        })
    }
    function showCategoryMobile(idCategory){
        document.getElementById('sub-nav-list-'+idCategory).classList.toggle('sub-nav-list-mobile')
    }
</script>
</html>