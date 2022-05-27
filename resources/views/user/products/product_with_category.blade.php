{{-- controller collections  --}}
@extends("user.main.mainPage")
@section("title","Vape VN - Collections")
@section("content")

    <div class="breabrum">
        <div class="grid content-breabrum">
            <a href="{{route('home')}}" class="link-home">Trang chủ</a>
            <span style="color: white;margin:0 5px;font-size:1.5rem;">/</span>
            <a href="{{route('index_collections')}}" class="text-collections">Danh mục</a>
            <span style="color: white;margin:0 5px;font-size:1.5rem;">/</span>
            <span class="text-collections">{{$thisSubCategoryProduct->name}}</span>
        </div>
    </div>

    <div class="grid collections-page">
        <div class="row">
            <div class="col-2 md-cateogry">
                <div class="category">
                    <h3>Danh mục</h3>
                    <ul class="list-category">
                        <li class="item-category"><a href="{{route('home')}}" class="link-category">HOME</a></li>
                        @foreach ($categoryProduct as $item)
                        <li class="item-category"><a href="{{route('show_product_with_category',$item->slug)}}" class="link-category">{{$item->name}}</a></li>                   
                        @endforeach
                        <li class="item-category"><a href="#" class="link-category">TIN TỨC</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-10 md-product" style="padding-left: 24px;">
                <div class="product">
                    <h3 class="name-category" style="text-transform: uppercase;font-size:2rem">{{$thisSubCategoryProduct->name}}</h3>
                    <div class="row">
                        @foreach ($product as $item)
                            <div class="col-2-5 one-product scale-product">
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
        </div>
    </div>
@stop