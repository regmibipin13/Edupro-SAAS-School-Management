 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
 <!-- Theme style -->
 <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 <style>
     .select2-container .select2-selection--single {
         box-sizing: border-box;
         display: block;
         height: 40px !important;
         user-select: none;
         -webkit-user-select: none;
     }

     .select2-container .select2-search--inline .select2-search__field {
         box-sizing: border-box;
         border: none;
         font-size: 100%;
         margin-top: 5px;
         margin-left: 5px;
         padding: 0;
         max-width: 100%;
         resize: none;
         height: 25px;
         vertical-align: bottom;
         font-family: sans-serif;
         overflow: hidden;
         word-break: keep-all;
     }
 </style>
 @yield('styles')
