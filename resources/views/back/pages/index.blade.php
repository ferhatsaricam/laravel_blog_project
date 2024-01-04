@extends('back.layouts.master')

@section('title', 'Tüm Sayfalar')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-right text-primary"><strong>{{$pages->count()}}</strong> makale bulundu.
    </h6>
    </div>
    <div class="card-body">
        <div id="orderSuccess" style="display:none;" class="aler alert-success">
            Sıralama başarıyla güncellendi.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>

                <tbody id="orders">

                    @foreach($pages as $page)
                    <tr>
                        <td id="page_{{$page->id}}" class="text-center" style="width: 5px;"><i class="fa fa-arrows-alt-v fa-3x handle" style="cursor:move"></i></td>
                        <td>
                            <img src="{{asset($page->image)}}" width="200" alt="">
                        </td>
                        <td>{{$page->title}}</td>
                        <td>
                            <input class="switch" veri="{{$page->id}}" type="checkbox" data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" @if($page->status==1) checked @endif
                            >
                        </td>
                        <td>
                            <a target="_blank" href="{{route('page', $page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>
                            <a href="{{route('admin.page.edit', $page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i> </a>
                            <a href="{{route('admin.page.delete', $page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection



@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.1/Sortable.min.js" integrity="sha512-3N7dD+tlndNxwAC0PwGNWnnEpzHQwgNl6/c9XW6+nqptoMhbI9Rb6kQiUFtYmXrox60oIELVSFAO0dCSfKb2tw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>
    $('#orders').sortable({
        handle:'.handle',
        update:function(){
            $('#orderSuccess').show().delay(1000).fadeOut();
        }
        
    });

</script>
<script>
    $(function() {
        $('.switch').change(function() {
            id = $(this)[0].getAttribute('veri')
            statu=$(this).prop('checked');
            $.get("{{route('admin.page.toggle')}}", {id:id, statu:statu}, function(data, status){});
        })
    })
</script>
@endsection