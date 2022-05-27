@extends("user.main.mainPage")
@section("title","Vape VN")
@section("content")
    <div class="slide">
        <div class="one-slide one-slide--active" style="background-image: url('{{url('/')}}/public/assets/img/slide/index_slider_img_1.webp');">
            
        </div>
        <div class="one-slide" style="background-image: url('{{url('/')}}/public/assets/img/slide/index_slider_img_3.webp');">

        </div>
        <div class="one-slide" style="background-image: url({{url('/')}}/public/assets/img/slide/index_slider_img_5.webp);">
            
        </div>
        <ul class="slide__list">
            <li class="slide__item slide__item--active">1</li>
            <li class="slide__item">2</li>
            <li class="slide__item">3</li>
        </ul>
    </div>

    <div class="category">
        <div class="grid">
            <div class="category__heading">
                <h3 class="category__heading-text common-heading__text">Danh mục sản phẩm</h3>
            </div>
            <div class="category__list" id="category-list">         
                    <div class="category__item category__item-sale" style="background-image: url('{{url('/')}}/public/assets/img/category/sale.webp');">
                        <a href="{{route('show_product_with_category','sale')}}"><h4 class="category__item-text">sale</h4></a>
                    </div>
                
                <div class="category__item category__item-pod" style="background-image: url('{{url('/')}}/public/assets/img/category/iqos_iluma_prime_f07535657d9f4c729ace5fe8cbf6036a.webp');">
                    <a href="{{route('show_product_with_category','iqos-lil')}}"><h4 class="category__item-text">iqos-lil</h4></a>
                </div>
                <div class="category__item category__item-saltnic" style="background-image: url('{{url('/')}}/public/assets/img/category/relx_logo_vapepro_52a6288dbe1e4ec0a095811d5599d18a.webp');">
                    <a href="{{route('show_product_with_category','pod-relx-juul')}}"><h4 class="category__item-text">pod relx | juul</h4></a>
                </div>
                <div class="category__item category__item-vape" style="background-image: url('{{url('/')}}/public/assets/img/category/saltnic_vapepro_99908fffdf0e4aaf99e8c4058e648a58.webp');">
                    <a href="{{route('show_product_with_category','tinh-du-saltnic')}}"><h4 class="category__item-text">Tinh dầu saltnic</h4></a>
                </div>
                <div class="category__item category__item-vape" style="background-image: url('{{url('/')}}/public/assets/img/category/voopoo_vinci_pnp_vm4_0.webp');">
                    <a href="{{route('show_product_with_category','phu-kien-pod')}}"><h4 class="category__item-text">phụ kiện pod</h4></a>
                </div>
                <div class="category__item category__item-vape" style="background-image: url('{{url('/')}}/public/assets/img/category/smok_rpm4_main_1b5f45695dee4f6fb4a357615bd416e7.webp');">
                    <a href="{{route('show_product_with_category','may-pod-system')}}"><h4 class="category__item-text">máy pod system</h4></a>
                </div>
                <div class="category__item category__item-vape" style="background-image: url('{{url('/')}}/public/assets/img/category/1.webp');">
                    <a href="{{route('show_product_with_category','du-vape')}}"><h4 class="category__item-text">dầu vape</h4></a>
                </div>
                <div class="btn-prev" onclick="prev()"><i class="icon-prev-slide fa-solid fa-angle-left"></i></div>
                <div class="btn-next" onclick="next()"><i class="icon-next-slide fa-solid fa-angle-right"></i></div>
            </div>
            <div class="category__footer">
                <div class="category__footer-item">
                    <div class="category__footer-item-img">
                        <i class="category__footer-item-icon fa-solid fa-car"></i>
                    </div>
                    <div class="category__footer-item-desc">
                        <a href="" class="category__footer-item-link">
                            <h3 class="title-desc">Giao hàng cod nhanh chóng</h3>
                            <p class="content-desc">Sản phẩm được giao từ 30 - 60 phút với các đơn hàng nội thành</p>
                        </a>
                    </div>
                </div>
                <div class="category__footer-item">
                    <div class="category__footer-item-img">
                        <i class="category__footer-item-icon fa-solid fa-dollar-sign"></i>
                    </div>
                    <div class="category__footer-item-desc">
                        <a href="" class="category__footer-item-link">
                            <h3 class="title-desc">Bảo hành</h3>
                            <p class="content-desc">Bảo hành  07 ngày nếu phát sinh lỗi từ nhà sản xuất</p>
                        </a>
                    </div>
                </div>
                <div class="category__footer-item">
                    <div class="category__footer-item-img">
                        <i class="category__footer-item-icon fa-solid fa-phone"></i>
                    </div>
                    <div class="category__footer-item-desc">
                        <a href="" class="category__footer-item-link">
                            <h3 class="title-desc">Hotline hỗ trợ</h3>
                            <p class="content-desc">HCM: 0833379934 - Bình Dương: 0398855263</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="product">
        <div class="grid">
            <div class="sale-off__heading">
                <h3 class="sale-off__heading-text common-heading__text">Sản phẩm khuyễn mãi</h3>
            </div>
            <div class="row">
                @foreach ($productHome as $item)
                    <div class="col-3 one-product">
                        <a href="{{route('detail_product',$item->slug)}}">
                            <img src="{{url('/')}}/public/images/products/{{$item->image}}" alt="{{$item->name}}" class="product__img">
                            <h3 class="product__name text-color">{{$item->name}}</h3>
                            <p class="product__price text-color">{{$item->price}}đ</p>
                        </a>
                        <div class="action-product">                       
                            <div class="action-product__icon">
                                {{-- button add to cart  --}}
                                <button class="js-get-data" data-id={{$item->id}} data-image={{$item->image}} data-name={{$item->name}} data-price={{$item->price}} data-bs-toggle="modal" data-bs-target="#modalCart" style="background-color: black;border:none;">
                                    <i class="fa-solid fa-cart-arrow-down" style="color: white"></i>
                                </button>
                            </div>                                         
                            <a href="{{route('detail_product',$item->slug)}}">
                                <div class="action-product__icon">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                            </a>
                            <a href="">
                                <div class="action-product__icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </a>
                        </div>
                    </div> 
                @endforeach               
            </div>
        </div>
    </div>

    <div class="news">
        <div class="grid">
            <div class="news__heading">
                <h3 class="news__heading-text common-heading__text">Tin tức</h3>
            </div>
            <div class="row">
                <div class="col-4 md-news">
                    <a href="">
                        <div class="box-img" style="height: 260px;">
                            <img class="news__img" src="{{url('/')}}/public/assets/img/news/steamwork.webp" alt="">
                        </div>
                        <h3 class="news__title">STEAMWORK ỔI - LỰA CHỌN HOÀN HẢO DÀNH CHO DÂN MÊ KHÓI</h3>
                    </a>
                    <p class="news__desc">
                        Một mùa nóng bức thì các bạn giải nhiệt cho bản thân như thế nào? Nay VapePro mang đến cho các bạn một dòng tinh dầu thuốc lá điện tử...
                    </p>
                    <a href="" class="news__detail">
                        <i class="fa-solid fa-angle-right"></i>
                        Xem chi tiết
                    </a>
                </div>
                <div class="col-4 md-news">
                    <a href="">
                        <div class="box-img" style="height: 260px;">
                            <img class="news__img" src="{{url('/')}}/public/assets/img/news/hannya-nano.webp" alt="">
                        </div>
                        <h3 class="news__title">LẠC LỐI TRONG KHÔNG GIAN MA MỊ CÙNG POD BÁCH QUỶ HANNYA NANO</h3>
                    </a>
                    <p class="news__desc">
                        Pod bách quỷ mới nhất đến từ nhà Vapelusion đang nổi như cồn sau Vape quỷ Hannya 230w. Với thiết kế cực kì đẹp mắt và cao cấp chắc chắn...
                    </p>
                    <a href="" class="news__detail">
                        <i class="fa-solid fa-angle-right"></i>
                        Xem chi tiết
                    </a>
                </div>
                <div class="col-4 md-news">
                    <a href="">
                        <div class="box-img" style="height: 260px;">
                            <img class="news__img" src="{{url('/')}}/public/assets/img/news/vape-vinci.webp" alt="">
                        </div>
                        <h3 class="news__title">CHƠI KHÓI CÓ NÊN MUA VAPE VINCI X HAY KHÔNG?</h3>
                    </a>
                    <p class="news__desc">
                        Mua Vape Vinci X anh em sẽ được sở hữu dòng thuốc lá điện tử nhỏ gọn, sử dụng Pod System thay tank hay đầu đốt. Điểm nhấn ấn tượng...
                    </p>
                    <a href="" class="news__detail">
                        <i class="fa-solid fa-angle-right"></i>
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
        <div class="see-more-news">
            <a href="" class="see-more-news--link">
                <i class="fa-solid fa-chevron-down"></i>
                Xem thêm
            </a>
        </div>   
    </div>
@stop