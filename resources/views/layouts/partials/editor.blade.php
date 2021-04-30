@section('scripts')
<script src="https://cdn.tiny.cloud/1/3j5blf69sp3fcwle545j2cglnb7mzdn5cfom7scfbm6jnk9x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
        tinymce.init({
        selector: 'textarea#post',
        skin: 'oxide',
        height: 300,
        min_height: 300,
        branding: false,
        browser_spellcheck: true,
        fontsize_formats: '14px 16px 18px 20px',
        menubar: false,
        elementpath: false,
        style_formats:[
        {title: "Header 2",format: "h2"},
        {title: "Header 3",format: "h3"},
        {title: "Paragraph",format: "p"}
        ],
        plugins: [
        'advlist autolink autoresize link image lists charmap searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking table template paste fullscreen imagetools ',
        ],
        toolbar1: 'styleselect | fontsizeselect | link unlink | table media charmap | code fullscreen',
        toolbar2: 'undo redo | bold italic superscript subscript removeformat | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent',
        content_css: '../resources/tinycontent.css',
        autoresize_bottom_margin: 0,
        statusbar: false,
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
</script>
@stop
