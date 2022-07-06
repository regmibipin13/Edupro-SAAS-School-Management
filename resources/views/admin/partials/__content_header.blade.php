 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row">
             <div class="col-sm-6">
                 <h3 class="m-0">{{ __($header) }}</h3>
             </div><!-- /.col -->
         </div><!-- /.row -->
         @if (session('success'))
             <div class="row">
                 <div class="col-md-12">
                     <div class="alert alert-success">
                         {{ session('success') }}
                     </div>
                 </div>
             </div>
         @endif
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
