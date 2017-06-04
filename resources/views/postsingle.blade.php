@extends('layouts/app') @section('script')
<script>
    var post_id={{$id}};
    $(_ => $.getJSON('/api/posts/'+post_id, data =>{
        $('#title').html(data.title);
        $('#body').html(data.content);
        $('#body').append('<hr>'+data.created_at);
    }));
</script>
@endsection 
@section('content')
<div class="container">
    <div class="col-md-8 col-md-offest-2">
        <div class="panel panel-default">
            <div class="panel-heading" id='title'>標題</div>
            <div class="panel-body" id='body'>
            </div>
        </div>
    </div>
</div>
@endsection
