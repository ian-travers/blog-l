@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'excerpt' );
        CKEDITOR.replace( 'body' );

        $("#input-image").fileinput({
            theme: "fas",
            showUpload: false,
            showCaption: false,
            showRemove: false,
            showCancel: false,
            maxFileSize: 2000,
        });
    </script>
@endsection
