<!doctype html>
<html lang="en">
<head>
    <title>@yield('page-title',config('app.name','Fix and Fine'))</title>

    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon/favicon-32x32.png') }}" type="image/gif" sizes="32x32">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('vendors/bootstrap-5.0.0-beta3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-5-all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("vendors/DataTables/datatables.css") }}">

    {{--        ck editor min and max height--}}
    <style>
        .ck-editor__editable_inline {
            min-height: 100px;
            max-height: 200px;
        }
    </style>

    <!-- CSS for file -->
@stack('css')


<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


</head>
@include('layouts.nav')
<div id="app" class="container">
    @yield('app-content')
</div>
@include('snippets.footer')
</body>

<!-- Scripts -->
<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/popper-2.4.4.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-5.0.0-beta3-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('js/fontawesome-5-all.js') }}" defer></script>
<script src="{{ asset('js/bootbox.all.js') }}"></script>
<script src="{{ asset('js/helpers.js') }}"></script>
<script src="{{ asset("vendors/DataTables/datatables.js") }}"></script>
<script src="{{ asset("js/ckeditor.js") }}"></script>
<script>
    $(function () {
        var editor = ClassicEditor
            .create(document.querySelector('.ckeditor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                height: 300,
                heading: {
                    options: [
                        {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
        // console.log(ClassicEditor.builtinPlugins.map( plugin => plugin.pluginName ));
    });
</script>

{{--    thoo clock for the analog clock--}}
<script
    src="{{ asset('vendors/Customizable-Analog-Alarm-Clock-with-jQuery-Canvas-thooClock/js/jquery.thooClock.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    jQuery(function ($) {
        $('.datatable').DataTable({
            "scrollY": "300px",
            "scrollX": true,
            "scrollCollapse": false,
            stateSave: true,

            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [':visible']
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            fixedColumns: {
                leftColumns: 3,
                //     rightColumns: 1
            },
        }).columns.adjust();
    });
</script>
<!-- JS for file -->
@stack('js')
</html>
