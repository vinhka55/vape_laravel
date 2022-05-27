@extends("admin.main.mainPage")
@section("content")
    <form class="mt-3 ms-3 w-75" enctype="multipart/form-data" id="form-add-product">
        @csrf
        <label for="category-product">Tên sản phẩm</label>
        <input required name="nameProduct" onchange="createSlug()" id="category-product" class="form-control form-control-sm" type="text" placeholder="Tên danh mục sản phẩm">

        <label for="slug-category-product" class="mt-3">Slug</label>
        <input name="nameSlugProduct" type="text" id="slug-category-product" class="form-control form-control-sm">

        <label for="price" class="mt-3">Giá</label>
        <input required type="number" name="price" id="price" class="form-control" value="0">

        <label for="origin" class="mt-3">Xuất xứ</label>
        <input type="text" name="origin" class="form-control form-control-sm" placeholder="Hồ Chí Minh">

        <img id="preview-image" width="300px" class="mt-3"><br>
        <label class="mt-3">Hình ảnh</label>
        <input required type="file" name="image" id="img-product" class="form-control">

        <label for="information" class="mt-3">Thông tin</label>
        <textarea name="information" class="form-control" id="information"></textarea>

        <label class="mt-3">Danh mục cha</label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="categoryProduct" id="category-select">
            <option selected>Chọn danh mục cha</option>
            @foreach ($categoryProduct as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
          </select>

        <label class="mt-3">Danh mục con</label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="subCategoryProduct" id="subCategory-select">
            <option selected>Chọn danh mục con</option>
          </select>
        <button type="submit" class="btn btn-primary mt-3" id="btn-add-product">Thêm</button>
    </form>
    <script>
        var slug = function(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ơởợớờưừứụẹêệđãấàáäâẽèéëêìịíïîõòóöôùúüûñç·/_,:;";
            var to   = "ooooouuuueeedaaaaaaeeeeeiiiiiooooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

            return str;
        }
        function createSlug(){
            var nameProduct = document.getElementById('category-product').value
            var nameSlug = slug(nameProduct)
            document.getElementById('slug-category-product').value = nameSlug
        }

        $('#img-product').change(function(){    
            let reader = new FileReader();  
            reader.onload = (e) => { 
                $('#preview-image').attr('src', e.target.result); 
            }   
            reader.readAsDataURL(this.files[0]);       
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form-add-product').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{route('handle_add_product')}}",
                data: formData,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    new Notify ({
                        title: 'Thành công',
                        text: 'Thêm sản phẩm thành công',
                        status: 'success',
                        autoclose: true,
                        autotimeout: 1000
                    })
                },
                error: function(response){
                    new Notify ({
                        title: 'Thất bại',
                        text: 'Thêm sản phẩm thất bại',
                        status: 'error',
                        autoclose: true,
                        autotimeout: 1000
                    })
                }
            })
        })
        $('#category-select').change(function(){
            var category = $('#category-select').val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{route("choose_category")}}',
                data: {
                    category:category
                },
                success: function(data) {  
                    $('#subCategory-select').html('')
                    $('#subCategory-select').append(data)
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            })
        })
    </script>
@endsection