@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-user"></i>
      </div>
      <div class="header-title">
         <h1>Create Tutor</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form class="" action="{{ route('tutor.save') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Name</label>
                           <input name="name" type="text" class="form-control" placeholder="Enter Name" required="required">
                        </div>
                        <div class="form-group">
                           <label>Title</label>
                           <select name="title" id="title" class="form-control" required="required" hint="Choose Title">
                           </select>
                           {{-- <input name="hcode" type="text" class="form-control" placeholder="Enter HCode" required> --}}
                        </div>
                        <div class="form-group">
                           <label>Country</label>
                           <select name="country" id="country" class="form-control" required="required" hint="Choose Country">
                           </select>
                           {{-- <input name="code" type="text" class="form-control" placeholder="Enter Code" required> --}}
                        </div>
                        <div class="form-group">
                           <label>Experience</label>
                           <select name="experience" id="experience" class="form-control" required="required" hint="Choose Experience">
                           </select>
                           {{-- <input name="code" type="text" class="form-control" placeholder="Enter Code" required> --}}
                        </div>
                        <div class="form-group">
                           <label>Experience Detail</label>
                           <textarea name="experience_detail" type="text" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group">
                           <label>Price</label>
                           <input name="price" type="text" class="form-control" placeholder="Enter Price" required="required">
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Discount</label>
                           <input name="discount" type="text" class="form-control" placeholder="Enter Discount" required="required">
                        </div>
                        <div class="form-group">
                           <label>Education</label>
                           <textarea name="education" type="text" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group">
                           <label>Interest</label>
                           <textarea name="interest" type="text" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group">
                           <label>Spoken</label>
                           <textarea name="spoken" type="text" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group">
                           <label>Video</label>
                           <input name="video" type="text" class="form-control" placeholder="Enter Video Link" required="required">
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Photo</label>
                           <div class="col-sm-9">
                              <input name="photo" type="file" class="form-control" required="required">
                           </div>
                        </div>
                        <div class="reset-button">
                           <a href="{{ route('tutor') }}" class="btn btn-warning">Cancel</a>
                           <input type="submit" class="btn btn-success" value="Save"></input>
                        </div>
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
      $.get("{{ route('videotutorial.gettitlelist') }}", function(data) {
         $('#title').html(data)
      });

      $.get("{{ route('videotutorial.getexperiencelist') }}", function(data) {
         $('#experience').html(data)
      });
      
      $.get("{{ route('videotutorial.getcountrylist') }}", function(data) {
         $('#country').html(data)
      });
   });
</script>
@endsection