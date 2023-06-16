
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Summernote -->
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('admin/plugins/chart.js/Chart.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>

<!-- date-range-picker -->
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
{{-- Axios --}}
{{--<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>--}}
<!-- daterangepicker -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
<script  type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $(document).on('select2:open', (event) => {
            const searchField = document.querySelector(
                `.select2-search__field[aria-controls="select2-${event.target.getAttribute('data-select2-id')}-results"]`,
            );
            if (searchField) {
                searchField.focus();
            }
        });
        $('.select2').select2();
        $(document).ready(function() {
            $('#body').summernote();
        });
    });
    $(document).ready(function () {
        $('#category_id').on('change',function(e) {
            var cat_id = e.target.value;
            if (cat_id){
                $.ajax({
                    url:'/admin/getSubCategory',
                    type: "GET",
                    dataType: "json",
                    data: {
                        cat_id: cat_id
                    },
                    success:function (data) {
                        $('#sub_category_id').empty().append('<option value="">{{ __('Select') }}</option>');
                        $.each(data.sub_cat_id, function (key, sub_cat){
                            $('#sub_category_id').append('<option value="'+ sub_cat.id+'">' +sub_cat.name +'</option>');
                        });
                    }
                })
            }

        });
    });
</script>

</html>
