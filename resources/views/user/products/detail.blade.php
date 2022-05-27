@extends("user.main.mainPage")
@section("title","Vape VN - Collections")
@section("content")
    <div class="breabrum">
        <div class="grid content-breabrum">
            <a href="{{route('home')}}" class="link-home">Trang chủ</a>
            <span style="color: white;margin:0 5px;font-size:1.5rem;">/</span>
            <a href="{{route('index_collections')}}" class="text-collections">Danh mục</a>
            <span style="color: white;margin:0 5px;font-size:1.5rem;">/</span>
            <span class="text-collections">{{$product->name}}</span>
        </div>
    </div>
    <div class="grid mt-4">
        <div class="information-product">
            <div class="image-product">
                <img src="{{url('')}}/public/images/products/{{$product->image}}" alt="{{$product->name}}">
            </div>
            <div class="information-detail">
                <h2>{{$product->name}}</h2>
                <p>Giá: {{number_format($product->price)}}đ</p>
                <p>Xuất xứ: {{$product->origin}}</p>
                <p>{{$product->information}}</p>
                <p>Facebook: Vapepro.vn</p>
                <p>Zalo: 18 Nguyễn Thị Định Cầu Giấy Hà Nội 0899562222</p>
                <p>Zalo: 1C Tông Đản Hoàn Kiếm Hà Nội 0902210000</p>
                <p>Zalo: 43D/23 Hồ Văn Huê Q PN HCM 0904648689</p>
                <p>Zalo: 252 CMT8 Q10 HCM 0342065577</p>
                <p>Zalo: 117, Đường D1-Biconsi Phú Hòa, Thủ Dầu Một , Bình Dương 0707352299</p>
                <button class="js-get-data" data-id={{$product->id}} data-image={{$product->image}} data-name={{$product->name}} data-price={{$product->price}} data-bs-toggle="modal" data-bs-target="#modalCart" style="background-color: black;border:none; padding:8px 16px;">
                    <span style="color: white;">Thêm giỏi hàng</span>
                </button>
            </div>
        </div>
    </div>
@stop