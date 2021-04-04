@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Update Info Promo</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="col-sm-6" action="{{ route('infopromo.saveupdate') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Code</label>
                        <input name="hcode" value="{{ $data->code }}" type="text" class="form-control" placeholder="Enter Code" required readonly>
                     </div>
                     <div class="form-group">
                        <label>Title</label>
                        <input name="code" value="{{ $data->title }}" type="text" class="form-control" placeholder="Enter Title" required readonly>
                     </div>
                     <div class="form-group">
                        <label>Subtitle</label>
                        <input name="subtitle" value="{{ $data->subtitle }}" type="text" class="form-control" placeholder="Enter Subtitle">
                     </div>
                     <div class="form-group">
                        <label>Syarat & Ketentuan</label>
                        <textarea name="sk" value="{{ $data->sk }}" type="text" class="form-control" placeholder="Enter Syarat Ketentuan">{{ $data->sk }}</textarea>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Picture</label>
                        <div class="col-sm-9 pl-0">
                           <img height="90px" src="{{ url('public/'.$data->picture) }}" alt="">
                           <input id="picture_old" name="picture_old" type="text" class="form-control hidden" value="{{ $data->picture }}">
                           <input name="picture" type="file" class="form-control">
                        </div>
                     </div>
                     <div class="reset-button">
                        <a href="{{ route('infopromo') }}" class="btn btn-warning">Cancel</a>
                        <input type="submit" class="btn btn-success" value="Save" />
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection