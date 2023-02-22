<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('success'))
    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            // background:'#288e56',
            // color:'#fff',
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: '{{Session::get('success')}}'
        })
    </script>
@endif

@if(Session::has('error'))
    <script type="text/javascript">
        swal.fire({
            // position: 'top-end',
            title:"{{Session::get('error')}}",
            // text:"",
            timer:1500,
            showConfirmButton: false,
            icon:'error'
        }).then((value) => {
            //location.reload();
        }).catch(swal.noop);
    </script>
@endif

@if(Session::has('warning'))
    <script type="text/javascript">
        swal.fire({
            // position: 'top-end',
            title:"{{Session::get('warning')}}",
            // text:"",
            timer:1500,
            showConfirmButton: false,
            icon:'warning'
        }).then((value) => {
            //location.reload();
        }).catch(swal.noop);
    </script>
@endif

@if(Session::has('info'))
    <script type="text/javascript">
        swal.fire({
            // position: 'top-end',
            title:"{{Session::get('info')}}",
            // text:"",
            timer:1500,
            showConfirmButton: false,
            icon:'info'
        }).then((value) => {
            //location.reload();
        }).catch(swal.noop);
    </script>
@endif

@if(Session::has('question'))
    <script type="text/javascript">
        swal.fire({
            // position: 'top-end',
            title:"{{Session::get('question')}}",
            // text:"",
            timer:1500,
            showConfirmButton: false,
            icon:'question'
        }).then((value) => {
            //location.reload();
        }).catch(swal.noop);
    </script>
@endif
