@include('admin.layouts.header')
@include('admin.layouts.navigation')
@include('admin.layouts.sweetalert2')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('Dashboard')}}</a></li>
                        <li class="breadcrumb-item ">{{__('Articles')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php $array = array();?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header width-icon">
                                <div class="float-right">
                                    <a href="" class="btn btn-sm btn-success" title="Filter" data-toggle="modal" data-placement="bottom" data-target="#filter_article">
                                        <i class="fas fa-filter" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{route('articles.create')}}" class="btn btn-sm btn-add" title="Add New">
                                        <i class=" fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <i class="mr-2 fa fa-gg" aria-hidden="true"></i>
                            <span class="text-uppercase text-blue-steel text-bold">{{__('List all')}} {{__('Sub Category')}}</span>
                        </div>
                        <div class="card-body">
                            @include('admin.articles.partials.search')
                            <div class="table-responsive-sm">
                                <div class="dataTabkes_wrapper ">
                                    <table id="table_categories" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th class="th-header" style="width: 50px">{{__('No')}}</th>
                                            <th class="th-header">{{__('Title')}}</th>
                                            <th class="th-header" style="width: 130px">{{__('Category')}}</th>
                                            <th class="th-header" style="width: 130px">{{__('Sub Category')}}</th>
                                            <th class="th-header" style="width: 130px">{{__('Create at')}}</th>
                                            <th class="th-header" style="width: 50px">{{__('Viewer')}}</th>
                                            <th class="th-header" style="width: 50px">{{__('Status')}}</th>
                                            <th class="th-header" style="width: 80px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($data) && count($data) > 0)
                                                @foreach($data as $key => $value)
                                                    <tr>
                                                        <td class="tr-body text-center">{{$key+1}}</td>
                                                        <td class="tr-body">{{$value->title}}</td>
                                                        <td class="tr-body">{{$value->category->name}}</td>
                                                        <td class="tr-body">{{$value->subcategory->name ?? 'N/A'}}</td>
                                                        <td class="tr-body">{{ Carbon\Carbon::parse($value->created_at)->diffForHumans()}} </td>
                                                        <td class="tr-body">{{$value->viewer}}</td>
                                                        <td class="tr-body text-center">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        {{($value->status) ? 'checked' : ''}}
                                                                        onclick="changeCategoryStatus(event.target, {{ $value->id }});" id="status{{$value->id}}">
                                                                    <label class="custom-control-label pointer" for="status{{$value->id}}"></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="tr-body text-center">
                                                            <a href="{{route('articles.show',encrypt($value->id))}}" class="btn btn-sm" title="Edit">
                                                                <i class="fa fa-pencil text-blue" aria-hidden="true"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$value->id}}">
                                                                <i class="fa-solid fa-trash-can text-red"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Delete-->
                                                    <div class="modal fade" id="staticBackdrop{{$value->id}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{route('articles.destroy',encrypt($value->id))}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    {!! method_field('DELETE') !!}
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {{__('Are you sure!. Do you want to delete?')}}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                                                                        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                        array_push($array,array("No"=>$key+1,"Category" => $value->category->name,"Sub_Category" => $value->subcategory->name,"Title"=> $value->title,"Viewer"=> $value['viewer'],"Create_Date"=> $value['created_at']));
                                                    @endphp
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="10" align="center">
                                                        <span>{{ __('No Data') }}</span>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="col">
                                        {!! $data->links('vendor.pagination.bootstrap-4') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<div class="modal fade" id="filter_article" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content card card-gray">
            <form method="POST" action="{{route('article.date')}}">
                @csrf
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 pr-3 pl-3">
                            <div class="form-group">
                                <label class="mb-0">Date From/To</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                      </span>
                                    </div>
                                    <input type="text" class="float-right form-control" name="daterange" value="<?php echo date('m/d/Y'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger float-right"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?php
 $ecod = json_encode($array); ?>
@include('admin.layouts.footer')
<script>

    function changeCategoryStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        // let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `articles/change-status`,
            type: 'post',
            data: {
                _token: '{{csrf_token()}}',
                id: id,
                status: status
            },
            success: function (result) {
            }
        });
    }

</script>
<script type="text/javascript">
    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV file
        csvFile =  new Blob(["\uFEFF"+csv], {
            type: 'text/csv; charset=utf-8'
        });;

        // Download link
        downloadLink = document.createElement("a");

        // File name
        downloadLink.download = filename;

        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);

        // Hide download link
        downloadLink.style.display = "none";

        // Add the link to DOM
        document.body.appendChild(downloadLink);

        // Click download link
        downloadLink.click();
    }
    function exportTableToCSV(filename) {

        var csv = [];
        var myObj, i, x = "";
        myObj = <?php echo $ecod; ?>;
        x +='No,Category,Sub_Category,Title,Viewer,Create_Date\n';
        for (i in myObj) {
            x += myObj[i].No+ ',';
            x += myObj[i].Category+ ',';
            x += myObj[i].Sub_Category+ ',';
            x += myObj[i].Title+ ',';
            x += myObj[i].Viewer+ ',';
            x += myObj[i].Create_Date +'\n';
        }
        csv.push(x);
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }
    function loading() {
        //document.getElementById("ld").style.display="block";
        $(document).ready(function(){$("#mdload").modal("show");});
    }
</script>
