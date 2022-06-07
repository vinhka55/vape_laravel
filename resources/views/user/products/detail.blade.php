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
    <div class="comment-product p-8">
        <div class="comment-product__header text-center">
            <h3>BẠN CÓ THẮC MẮC VỀ SẢN PHẨM NÀY?</h3>
            <p>Đừng lo, bình luận không ảnh hưởng tới thông tin của bạn.</p>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
              <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    @if (Auth::check())
                        <form class="form-outline mb-4" id="form-comment">
                            @csrf
                            <input type="text" id="addANote" name="content" class="form-control" placeholder="Bình luận của bạn ...."/>
                            <input type="hidden" id="productId" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <button type="submit" class="btn btn-primary mt-2" id="btnAddComment">Gửi</button>
                        </form>                 
                    @else
                        <input type="hidden" id="productId" name="product_id" value="{{$product->id}}">
                        <p class="text-center notify-error"><a href="{{route('login')}}">Đăng nhập</a> để bình luận</p>
                    @endif               
                        
                    <div id="show-comment">
                        
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script>
        var apiUrl = window.location.origin+'/vape/api/comment';
        var idProduct = $('#productId').val()
        function renderComment(){
            $.get(apiUrl+'/'+idProduct,function(res){
                let comment = ''
                for(let item in res){
                    comment += `
                    <div class="card mb-4">
                        <div class="card-body">
                            <p><span style="font-size:1.3rem;">${res[item].user.name}</span> ${res[item].time}</p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <p class="small mb-0" style="font-size:1.5rem;">${res[item].content}</p>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <i class="far fa-thumbs-up mx-2 text-black" style="margin-top: -0.16rem;cursor: pointer;"></i>
                                    <p class=" text-muted mb-0">${res[item].like}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                }
                var showCommet = document.getElementById('show-comment')
                showCommet.innerHTML = comment
            })
        }
        renderComment()
        $('#form-comment').on('submit',function(e){
            e.preventDefault()
            var data = $('#form-comment').serialize()
            $.post(apiUrl,data,function(res){
                $('#addANote').val('')
                renderComment()
            })
        })
    </script>
@stop