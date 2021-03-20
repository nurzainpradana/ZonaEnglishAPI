@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Create Common Code</h1><br>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="col-sm-6" action="{{ route('commoncode.save') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>HCode</label>
                        <input name="hcode" type="text" class="form-control" placeholder="Enter HCode" required>
                     </div>
                     <div class="form-group">
                        <label>Code</label>
                        <input name="code" type="text" class="form-control" placeholder="Enter Code" required>
                     </div>
                     <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter Name">
                     </div>
                     <div class="form-group">
                        <label>Remark 1</label>
                        <input name="remark_1" type="text" class="form-control" placeholder="Enter Remark 1">
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Remark 2 (Icon)</label>
                        <div class="col-sm-9">
                           <input name="remark_2" type="file" class="form-control">
                        </div>
                     </div>
                     <div class="reset-button">
                        <a href="{{ route('commoncode') }}" class="btn btn-warning">Cancel</a>
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