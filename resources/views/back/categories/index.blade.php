@extends('back.layouts.master')
@section('title', 'Tüm Kategoriler')
@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.category.create')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td>
                                    <input class="switch" veri="{{$category->id}}" type="checkbox" data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" @if($category->status==1) checked @endif
                                    >
                                </td>
                                <td>
                                    <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click" title="Düzenle"> <i class="fa fa-edit text-white"></i> </a>
                                    <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->articleCount()}}" class="btn btn-sm btn-danger remove-click" title="Sil"> <i class="fa fa-times text-white"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Düzenle</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form action="{{route('admin.category.update')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Kategori Adı</label>
                        <input id="category" type="text" class="form-control" name="category">
                        <input type="hidden" name="id" id="category_id">
                    </div>

                    <div class="form-group">
                        <label for="">Kategori Slug</label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div>


                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>

                </form>

            </div>


        </div>
    </div>
</div>

<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Sil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <div id="articleAlert" class="aler alert-danger">

                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                <form action="{{route('admin.category.delete')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="deleteId">
                    <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {

        $('.edit-click').click(function() {

            id = $(this)[0].getAttribute('category-id')
            $.ajax({
                type: 'GET',
                url: '{{route("admin.category.getData")}}',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#category').val(data.name);
                    $('#slug').val(data.slug);
                    $('#category_id').val(data.id);
                    $('#editModal').modal();
                }
            });
        });

        $('.remove-click').click(function() {
            id = $(this)[0].getAttribute('category-id');
            count = $(this)[0].getAttribute('category-count');
            name = $(this)[0].getAttribute('category-name');

            $('#deleteId').val(id);
            $('#articleAlert').html('');

            if(id==1){
                $('#articleAlert').html(name + ' kategorisi silinemez. Silinen diğer katogorilere ait makaleler buraya eklenecektir.');
                $('#deleteButton').hide();
                $('#deleteModal').modal();
                return;
            }

            $('#deleteButton').show();
            if (count > 0) {
                $('#articleAlert').html('Bu kategoriye ait ' + count + ' makale bulunmaktadır. Silmek istediğinize emin misiniz?');
            } else {
                $('#articleAlert').html('Kategoriyi silmek istediğinize emin misiniz?');
            }

            $('#deleteModal').modal();
        });

        $('.switch').change(function() {
            id = $(this)[0].getAttribute('veri')
            statu = $(this).prop('checked');
            $.get("{{route('admin.category.switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {});
        });
    })
</script>
@endsection