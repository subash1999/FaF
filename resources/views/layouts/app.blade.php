<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon/favicon-32x32.png') }}" type="image/gif" sizes="32x32">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="{{ asset('vendors/bootstrap-5.0.0-beta3-dist/css/bootstrap.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset("vendors/DataTables/datatables.css") }}">

        <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('js/popper-2.4.4.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap-5.0.0-beta3-dist/js/bootstrap.js') }}"></script>
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
                    // fixedColumns:   {
                    //     leftColumns: 2,
                    //     rightColumns: 1
                    // },
                }).columns.adjust();
            });
        </script>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @include('layouts.nav')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @include('snippets.footer')
    </body>
</html>
