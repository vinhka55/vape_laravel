@extends("admin.main.mainPage")
@section("content")
    <table class="table table-hover mt-2 ms-2 me-s">
        <thead>
        <tr>
            <th scope="col">Index</th>
            <th scope="col">Tên</th>
            <th scope="col">Slug</th>
            <th scope="col">Danh mục cha</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @php
            $index=1; 
            @endphp
            @foreach ($subCategoryProducts as $item)
                <tr id="{{$item->id}}">
                <th scope="row">{{$index}}</th>
                <td contenteditable="true" onblur="changeName({{$item->id}})" title="click để sửa" id="name-sub-category-id-{{$item->id}}">{{$item->name}}</td>
                <td id="slug-id-{{$item->id}}">{{$item->slug}}</td>
                <td>{{$item->categoryProduct->name}}</td>
                <td>
                <a href="#" title="xóa"><i onclick="deleteSubCategoryProduct({{$item->id}})" class="fa-solid fa-trash text-danger ms-2"></i></a>
                </td>
                </tr>
                @php
                    $index++; 
                @endphp
            @endforeach
        </tbody>
    </table>
    <script>
        function deleteSubCategoryProduct(id) {
            $.ajax({
                type: 'POST',
                url: '{{route("delete_sub_category_product")}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },
                success: function(data) {
                    $('#'+id).remove()
                    new Notify ({
                        title: 'Thành công',
                        text: 'Xóa danh mục con sản phẩm thành công',
                        status: 'success',
                        autoclose: true,
                        autotimeout: 1000
                    })
                }
            })
        }
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
        function changeName(id){
            var nameSubCategory = $('#name-sub-category-id-'+id).html()
            var slugSubCategory = $('#slug-id-'+id).html(slug(nameSubCategory)).text()
            $.ajax({
                type: 'POST',
                url: '{{route("edit_name_sub_category_product")}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id,
                    nameSubCategory:nameSubCategory,
                    slugSubCategory:slugSubCategory,
                },
                success: function(data) {         
                    $('#slug-id-'+id).html(slug(nameSubCategory))      
                    new Notify ({
                        title: 'Thành công',
                        text: 'Đổi tên danh mục con sản phẩm thành công',
                        status: 'success',
                        autoclose: true,
                        autotimeout: 1000
                    })
                }
            })
        }
    </script>
@endsection