<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/mms.min.js') }}"></script>
<script src="{{ asset('js/application.min.js') }}"></script>
{{-- <script src="{{ asset('js/myscripts.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/dropzone.js') }}"></script> --}}
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script>
$(document).ready(function(){
    function hideMsg(){
        $(".alert-dismissible").fadeOut();
    }
    setTimeout(hideMsg,5000);
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
