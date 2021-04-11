@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Create Users</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="col-sm-6" action="{{ route('users.save') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control" placeholder="Enter Email" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Enter Password"/>
                     </div>
                     <div class="form-group">
                        <label>No Phone</label>
                        <input name="no_phone" type="text" class="form-control" placeholder="Enter No Phone">
                     </div>
                     <div class="form-group">
                        <label>NIK</label>
                        <input name="nik" type="text" class="form-control" placeholder="Enter NIK">
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Photo</label>
                        <div class="col-sm-9">
                           <input name="photo" type="file" class="form-control">
                        </div>
                     </div>
                     <div class="reset-button">
                        <a href="{{ route('users') }}" class="btn btn-warning">Cancel</a>
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