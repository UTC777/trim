<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('jquery-seo-preview/css/jquery-seopreview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <link href="{{ asset('admin/css/prism.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/prism-live.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/prism-line-numbers.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/codemirror.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/monokai.css') }}" rel="stylesheet" type="text/css">
    <style>
        .input-group > .select2-container--default {
            width: auto !important; /* Allow the select2 container to size according to content */
            flex-grow: 1; /* Allow it to grow as needed */
        }

        .input-group > .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da; /* Match Bootstrap's input border */
            padding: .375rem .75rem; /* Match Bootstrap's input padding */
            height: auto; /* Adjust height as needed */
            min-height: 38px; /* Match Bootstrap's input height */
        }

        .input-group-append {
            margin-left: -1px; /* Align the button with the select2 container */
        }
        .input-group-text, input, select, textarea{ border-radius: 0!important; background-color: #8b8888 !important; color: #fff!important; }
        .uploaded-media .nav-tabs{
                width: 100%
            }
            .uploaded-media .tab-content{
                width: 100%
            }
            .media-images img {
    width: 100%;
}
.media-images {
    border: 2px solid #ddd;
    margin: 10px 0;
    min-height: 200px;
    position: relative;
}

.media-images img {
    width: 100%;
}

.copy-btn {
    position: absolute;
    bottom: 0;
    width: 100%;
}

.copy-btn .btn-info {
    width: 100%;
    border-radius: 0;
}

.copy-btn .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
}

.copy-btn .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.copy-btn:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}

.media-images .tooltiptextimg {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 100%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
}

.media-images .tooltiptextimg::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.media-images:hover .tooltiptextimg {
    visibility: visible;
    opacity: 1;
}
    </style>
    @yield('styles')
</head>

<body class="c-app">
    @include('partials.menu')
    <div class="c-wrapper">
        <header class="c-header c-header-fixed px-3">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>

            <button class="c-header-toggler mfs-3 d-md-down-none" type="button" responsive="true">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <ul class="c-header-nav ml-auto">
                @if(count(config('panel.available_languages', [])) > 1)
                    <li class="c-header-nav-item dropdown d-md-down-none">
                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach(config('panel.available_languages') as $langLocale => $langName)
                                <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                            @endforeach
                        </div>
                    </li>
                @endif
                <li class="adminbuttonbar">
                  <div class="btn-group">

                    {{-- @if(Auth::user()->isAdmin())
                     <a type="button"  target="_blank" href="{{ url('r') }}" class="btn btn-outline-success" title="Route Endpoints">Routes</a>
                    @endif

                     <a type="button" href="{{ url('clear-cache') }}" class="btn btn-outline-success" title="Clear Cache">Clear Cache</a> --}}

                    <a target="_blank" href="{{ url('/') }}" type="button" class="btn btn-info" title="View The Live Site">Live Site</a>

                    </div>
                </li>

            </ul>
        </header>

        <div class="c-body">
            <main class="c-main">


                <div class="container-fluid">
                    @if(session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                    @endif
                    @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')

                </div>


            </main>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/jquery-characters-caculator.js') }}"></script>
    <script src="{{ asset('textcounter/textcounter.js') }}"></script>
    <script src="{{ asset('jquery-seo-preview/js/jquery-seopreview.js') }}"></script>

    <script src="{{ asset('admin/js/bliss.shy.min.js') }}"></script>
    <script src="{{ asset('admin/js/prism.js') }}"></script>
    <script src="{{ asset('admin/js/prism-live.js') }}"></script>
    <script src="{{ asset('admin/js/prism-live-css.js') }}"></script>
    <script src="{{ asset('admin/js/prism-live-javascript.js') }}"></script>
    <script src="{{ asset('admin/js/prism-live-markup.js') }}"></script>
    <script src="{{ asset('admin/js/prism-line-numbers.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>

    <script>
      $(document).ready(function () {
           $('.seotitle').textcounter({

               type                     : "character",            // "character" or "word"
               min                      : 30,                      // minimum number of characters/words
               max                      : 60,                    // maximum number of characters/words, -1 for unlimited, 'auto' to use maxlength attribute
               countContainerElement    : "span",                  // HTML element to wrap the text count in
               countContainerClass      : "text-count-wrapper",   // class applied to the countContainerElement
               inputErrorClass          : "error",                // error class appended to the input element if error occurs
               counterErrorClass        : "error",                // error class appended to the countContainerElement if error occurs
               counterText              : "%d",        // counter text
               errorTextElement         : "span",                  // error text element
               minimumErrorText         : "Minimum not met",      // error message for minimum not met,
               maximumErrorText         : "Maximum exceeded",     // error message for maximum range exceeded,
               displayErrorText         : true,                   // display error text messages for minimum/maximum values
               stopInputAtMaximum       : false,                   // stop further text input if maximum reached
               countSpaces              : true,                  // count spaces as character (only for "character" type)
               countDown                : false,                  // if the counter should deduct from maximum characters/words rather than counting up
               countDownText            : "Remaining: %d",          // count down text
               countExtendedCharacters  : false,                  // count extended UTF-8 characters as 2 bytes (such as Chinese characters)
               maxcount                 : function(el){},         // Callback: function(element) - Fires when the counter hits the maximum word/character count
               mincount                 : function(el){
                   // $('#seoSave').prop('disabled',false);
               },         // Callback: function(element) - Fires when the counter hits the minimum word/character count
               minunder                 : function(el){
                   // $('#seoSave').prop('disabled',true);
               },         // Callback: function(element) - Fires when the counter hits the minimum word/character count
               init                     : function(el){}          // Callback: function(element) - Fires after the counter is initially setup
           });

           $('.seodescription').textcounter({
               type                     : "character",            // "character" or "word"
               min                      : 120,                      // minimum number of characters/words
               max                      : 320,                    // maximum number of characters/words, -1 for unlimited, 'auto' to use maxlength attribute
               countContainerElement    : "span",                  // HTML element to wrap the text count in
               countContainerClass      : "text-count-wrapper",   // class applied to the countContainerElement
               inputErrorClass          : "error",                // error class appended to the input element if error occurs
               counterErrorClass        : "error",                // error class appended to the countContainerElement if error occurs
               counterText              : "%d",        // counter text
               errorTextElement         : "span",                  // error text element
               minimumErrorText         : "Minimum not met",      // error message for minimum not met,
               maximumErrorText         : "Maximum exceeded",     // error message for maximum range exceeded,
               displayErrorText         : true,                   // display error text messages for minimum/maximum values
               stopInputAtMaximum       : false,                   // stop further text input if maximum reached
               countSpaces              : true,                  // count spaces as character (only for "character" type)
               countDown                : false,                  // if the counter should deduct from maximum characters/words rather than counting up
               countDownText            : "Remaining: %d",          // count down text
               countExtendedCharacters  : false,                  // count extended UTF-8 characters as 2 bytes (such as Chinese characters)
               maxcount                 : function(el){},         // Callback: function(element) - Fires when the counter hits the maximum word/character count
               mincount                 : function(el){
                   // $('#seoSave').prop('disabled',false);
               },         // Callback: function(element) - Fires when the counter hits the minimum word/character count
               // minunder                 : function(el){
               //     $('#seoSave').prop('disabled',true);
               // },
               init                     : function(el){}          // Callback: function(element) - Fires after the counter is initially setup
           });
       });

      $(document).ready(function () {
           $.seoPreview({
               google_div: "#seopreview-google",
               facebook_div: "#seopreview-facebook",
               metadata: {
                   title: $('#meta_title'),
                   desc: $('#meta_description'),
                   url: {
                       full_url: $('#meta-url')
                   }
               },
               google: {
                   show: true,
                   date: false
               },
               facebook: {
                   show: true,
                   featured_image: $('#meta-featured-image')
               }
           });
       });
   </script>

    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        },
        action: function(e, dt) {
          e.preventDefault()
          dt.rows().deselect();
          dt.rows({ search: 'applied' }).select();
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'colvis',
        className: 'btn-default',
        text: colvisButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
    @yield('scripts')
</body>

</html>
