@extends("admin.main.mainPage")
@section("content")
    <form action="{{route('handle_add_category_product')}}" method="POST" class="mt-3 ms-3 w-75">
        @csrf
        <label for="category-product">Tên danh mục sản phẩm</label>
        <input name="nameCategoryProduct" onchange="createSlug()" id="category-product" class="form-control form-control-sm" type="text" placeholder="Tên danh mục sản phẩm">
        <label for="slug-category-product" class="mt-3">Slug danh mục</label>
        <input name="nameSlugCategoryProduct" type="text" id="slug-category-product" class="form-control form-control-sm">
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