@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Update Users</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="col-sm-6" action="{{ route('users.saveupdate') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>ID</label>
                        <input name="id" value="{{ $data->id }}" type="text" class="form-control" placeholder="Enter Code" required readonly>
                     </div>
                     <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{ $data->name }}" type="text" class="form-control" placeholder="Enter Name" required>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input name="email" value="{{ $data->email }}" type="email" class="form-control" placeholder="Enter Name" required>
                     </div>
                     <div class="form-group">
                        <label>New Password</label>
                        <input name="password_new" type="password" class="form-control" placeholder="Enter New Password">
                     </div>
                     
                     <div class="form-group">
                        <label>NIK</label>
                        <input name="nik" value="{{ $data->nik }}" type="text" class="form-control" placeholder="Enter NIK">
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Photo</label>
                        <div class="col-sm-9 pl-0">
                           <?php if (isset($data->photo)) { ?>
                              <img height="90px" src="{{ url($data->photo) }}" alt="">
                              <?php } ?>
                           
                           <input id="photo_old" name="photo_old" type="text" class="form-control hidden" value="{{ $data->photo }}">
                           <input name="photo" type="file" class="form-control">
                        </div>
                     </div>
                     <div class="reset-button">
                        <a href="{{ route('users') }}" class="btn btn-warning">Cancel</a>
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