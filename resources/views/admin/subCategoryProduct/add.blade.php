@extends("admin.main.mainPage")
@section("content")
    <form action="{{route('handle_add_sub_category_product')}}" method="POST" class="mt-3 ms-3 w-75">
        @csrf
        <label for="category-product">Tên danh mục con</label>
        <input name="nameSubCategoryProduct" onchange="createSlug()" id="category-product" class="form-control form-control-sm" type="text" placeholder="Tên danh mục con sản phẩm">
        <label for="slug-category-product" class="mt-3">Slug danh mục con</label>
        <input name="nameSlugSubCategoryProduct" type="text" id="slug-category-product" class="form-control form-control-sm">
        <label class="mt-3">Danh mục cha</label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="categoryProduct">
            <option selected>Chọn danh mục cha</option>
            @foreach ($categoryProducts as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
          </select>
        <button type="submit" class="btn btn-primary mt-3">Thêm</button>
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
            var nameCategoryProduct = document.getElementById('category-product').value
            var nameSlug = slug(nameCategoryProduct)
            document.getElementById('slug-category-product').value = nameSlug
        }
    </script>
@endsection