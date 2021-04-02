@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Create Video Tutorial</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="col-sm-6" action="{{ route('videotutorial.save') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="type" class="form-control" required="required" hint="Choose Type">
                        </select>
                        {{-- <input name="hcode" type="text" class="form-control" placeholder="Enter HCode" required> --}}
                     </div>
                     <div class="form-group">
                        <label>Level</label>
                        <select name="level" id="level" class="form-control" required="required" hint="Choose Level">
                        </select>
                        {{-- <input name="code" type="text" class="form-control" placeholder="Enter Code" required> --}}
                     </div>
                     <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Enter Title">
                     </div>
                     <div class="form-group">
                        <label>Description</label>
                        <textarea name="title" type="text" class="form-control"></textarea>
                     </div>
                     <div class="form-group">
                        <label>URL Youtube</label>
                        <input name="url_youtube" type="text" class="form-control" placeholder="Enter URL Youtube">
                     </div>
                     <div class="form-group">
                        <label>URL ZOOM</label>
                        <input name="url_zoom" type="text" class="form-control" placeholder="Enter URL Zoom">
                     </div>
                     <div class="reset-button">
                        <a href="{{ route('videotutorial') }}" class="btn btn-warning">Cancel</a>
                        <input type="submit" class="btn btn-success" value="Save"></input>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $.get("{{ route('videotutorial.getlevellist') }}", function(data) {
         $('#level').html(data)
      });

      $.get("{{ route('videotutorial.gettypelist') }}", function(data) {
         $('#type').html(data)
      });
   });
</script>
@endsection