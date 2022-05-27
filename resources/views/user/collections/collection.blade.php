@extends("user.main.mainPage")
@section("title","Vape VN - Collections")
@section("content")
    <div class="breabrum">
        <div class="grid content-breabrum">
            <a href="{{route('home')}}" class="link-home">Trang chủ</a>
            <span style="color: white;margin-right:5px;font-size:1.5rem;">/</span>
            <span class="text-collections">Collections</span>
        </div>
    </div>
    <div class="grid all-category">
        <h3 class="title">Danh mục</h3>
        <div class="row">
            @foreach ($categoryProduct as $item)
            <div class="col-3 mt-2 one-category md-33 ms-100">
                <a href="{{route('show_product_with_category',$item->slug)}}">
                    <img src="{{url('/')}}/public/assets/img/product/ice-grape.webp" alt="" class="product__img">
                    <h3 class="category__name text-color text-center">{{$item->name}}</h3>
                    <p class="product__count text-color text-center">0 sản phẩm</p>
                </a>
            </div>
            @endforeach
            @foreach ($subCategoryProduct as $item)
            <div class="col-3 mt-2 one-category">
                <a href="{{route('show_product_with_category',$item->slug)}}">
                    <img src="{{url('/')}}/public/assets/img/product/ice-grape.webp" alt="" class="product__img">
                    <h3 class="category__name text-color text-center">{{$item->name}}</h3>
                    <p class="product__count text-color text-center">0 sản phẩm</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@stop