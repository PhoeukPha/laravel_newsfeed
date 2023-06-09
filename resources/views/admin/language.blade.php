<!DOCTYPE html>
<html>
<head>
    <title>Language Setting</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <link rel="shortcut icon" href="{{asset('admin/dist/img/logo/favicon.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Battambang&display=swap" rel="stylesheet">
</head>
<style>
    body{
        font-family: "Helvetica Neue",'Battambang', Helvetica, Arial, sans-serif;
    }
</style>
<body>

<div class="container">
    <h1 class="text-center">{{ __('Language Translation') }}: <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a></h1>
    <form method="POST" action="{{ route('translations.create') }}">
        @csrf
        <div class="row">
            <div class="col-md-4 form-group">
                <label>{{ __('Key Name') }}</label><span style="color: red">*</span>
                <input type="text" name="key" class="form-control" placeholder="Enter Key..." required>
            </div>
            <div class="col-md-4 form-group">
                <label>{{ __('Name English') }}</label><span style="color: red">*</span>
                <input type="text" name="value" class="form-control" placeholder="Enter Value..." required>
            </div>
            <div class="col-md-4 form-group">
                <label>{{ __('Action') }}:</label>
                <button class="form-control btn btn-success align-bottom" type="submit">{{ __('Save') }}</button>
            </div>
        </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Key Name</th>
            @if($languages->count() > 0)
                @foreach($languages as $language)
                    <th>{{ $language->name }}({{ $language->code }})</th>
                @endforeach
            @endif
            <th width="80px;">Action</th>
        </tr>
        </thead>
        <tbody>
        @if($columnsCount > 0)
            @foreach($columns[0] as $columnKey => $columnValue)
                <tr>
                    <td>
                        {{ $columnKey }}
                    </td>
                    @for($i=1; $i<=$columnsCount; ++$i)
                        <td>
                            <a href="#" data-title="Enter Translate" class="translate" data-code="{{ $columns[$i]['lang'] }}" data-type="textarea" data-pk="{{ $columnKey }}" data-url="{{ route('translation.update.json') }}">{{ isset($columns[$i]['data'][$columnKey]) ? $columns[$i]['data'][$columnKey] : '' }}</a>
                        </td>
                    @endfor
                    <td>
                        <button data-action="{{ route('translations.destroy', $columnKey) }}" class="btn btn-danger btn-xs remove-key">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.translate').editable({
        params: function(params) {
            params.code = $(this).editable().data('code');
            return params;
        }
    });

    $('.translate-key').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Key is required';
            }
        }
    });

    $('body').on('click', '.remove-key', function(){
        var cObj = $(this);

        if (confirm("Are you sure want to remove this item?")) {
            $.ajax({
                url: cObj.data('action'),
                method: 'DELETE',
                success: function(data) {
                    cObj.parents("tr").remove();
                    // alert("Your imaginary file has been deleted.");
                }
            });
        }
    });
</script>
</body>
</html>
