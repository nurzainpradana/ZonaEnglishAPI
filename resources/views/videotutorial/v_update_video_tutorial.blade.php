@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Update Video Tutorial</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="col-sm-6" action="{{ route('commoncode.saveupdate') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Code</label>
                        <input name="hcode" value="{{ $data->code }}" type="text" class="form-control" placeholder="Enter HCode" required readonly>
                     </div>
                     <div class="form-group">
                        <label>Type</label>
                        <select name="type" data-code="{{$data->type}}" id="type" class="form-control" required="required" hint="Choose Type">
                        </select>
                        {{-- <input name="hcode" type="text" class="form-control" placeholder="Enter HCode" required> --}}
                     </div>
                     <div class="form-group">
                        <label>Level</label>
                        <select name="level" data-code="{{$data->level}}" id="level" class="form-control" required="required" hint="Choose Level">
                        </select>
                        {{-- <input name="code" type="text" class="form-control" placeholder="Enter Code" required> --}}
                     </div>
                     <div class="form-group">
                        <label>Title</label>
                        <input name="remark_1" value="{{ $data->title }}" type="text" class="form-control" placeholder="Enter Remark 1">
                     </div>
                     <div class="form-group">
                        <label>Description</label>
                        <input name="description" value="{{ $data->desc }}" type="text" class="form-control" placeholder="Enter Remark 2">
                     </div>
                     <div class="form-group">
                        <label>Remark</label>
                        <input name="remark_1" value="{{ $data->remark_1 }}" type="text" class="form-control" placeholder="Enter Remark 2">
                     </div>
                     {{-- <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Photo</label>
                        <div class="col-sm-9 pl-0">
                           <img height="90px" src="{{ url('public/'.$data->remark_2) }}" alt="">
                           <input id="remark_2_old" name="remark_2_old" type="text" class="form-control hidden" value="{{ $data->remark_2 }}">
                           <input name="remark_2" type="file" class="form-control">
                        </div>
                     </div> --}}
                     <div class="reset-button">
                        <a href="{{ route('commoncode') }}" class="btn btn-warning">Cancel</a>
                        <input type="submit" class="btn btn-success" value="Save" />
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
      var url = "{{ route('videotutorial.getlevellist') . '?selectedCode=:scode' }}";
        url = url.replace(':scode', $('#level').attr('data-code'));
        $.get(url, function(data) {
            $('#level').html(data)
        });

        var url = "{{ route('videotutorial.gettypelist') . '?selectedCode=:scode' }}";
        url = url.replace(':scode', $('#type').attr('data-code'));
        $.get(url, function(data) {
            $('#type').html(data)
        });
   });
</script>
@endsection