@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Create Info Promo</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="col-sm-6" action="{{ route('infopromo.save') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Enter Title" required>
                     </div>
                     <div class="form-group">
                        <label>Sub Title</label>
                        <input name="subtitle" type="text" class="form-control" placeholder="Enter Sub Title" required>
                     </div>
                     <div class="form-group">
                        <label>Syarat & Ketentuan</label>
                        <textarea name="sk" type="text" class="form-control" placeholder="Enter Syarat & Ketentuan"></textarea>
                     </div>
                     <div class="form-group">
                        <label>Expired Date</label>
                        <input name="expired_date" type="date" class="form-control" placeholder="Enter Expired Date">
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Picture</label>
                        <div class="col-sm-9">
                           <input name="picture" type="file" class="form-control">
                        </div>
                     </div>
                     <div class="reset-button">
                        <a href="{{ route('infopromo') }}" class="btn btn-warning">Cancel</a>
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
@endsection