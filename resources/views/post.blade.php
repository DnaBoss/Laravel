@extends('layouts/app') @section('script')
<script>
    function getQueryParams(qs) {
        qs = qs.split('+').join(' ');
        var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;
        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
        }
        return params;
    }
    var query = getQueryParams(document.location.search);
    var page = '';
    if (query.page !== undefined)
        page = '?page=' + query.page;
    $(_ => $.getJSON('/api/posts' + page, data => {
        data.data.map(obj => $('#tbody').append('<tr><td>' + obj.id + '</td><td><a href="/posts/' + obj.id + '">' + obj.title + '</a></td></tr>'));
        if (data.next_page_url === null)
            $('#btn-next').hide();
        if (data.prev_page_url === null)
            $('#btn-pre').hide();
        if (data.prev_page_url !== null)
            $('#btn-pre').attr('href', data.prev_page_url.replace('api/', ''));
        if (data.next_page_url !== null)
            $('#btn-next').attr('href', data.next_page_url.replace('api/', ''));
    }));
</script>
@endsection @section('content')
<div class="container">
    <div class="col-md-8 col-md-offest-2">
        <h1>GuestBook</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>標題</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <a className="btn btn-primary" id='btn-pre'>上一頁</button>
                <a className="btn btn-primary" id='btn-next'>下一頁</button>

            </tbody>
        </table>
    </div>
</div>
@endsection
