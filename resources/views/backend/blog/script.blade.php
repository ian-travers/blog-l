@section('style')
    <link rel="stylesheet" href="/backend/plugins/tag-editor/jquery.tag-editor.css">
@endsection

@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/backend/plugins/tag-editor/jquery.caret.min.js"></script>
    <script src="/backend/plugins/tag-editor/jquery.tag-editor.min.js"></script>
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

        @if($post->exists)
            options = {
                initialTags: {!! $post->tags_list !!},
            };
        @endif

        $('input[name=post_tags]').tagEditor(options);
    </script>
@endsection
