@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Video Tutorial</h1>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                  <div class="btn-group">
                     <div class="buttonexport" id="buttonlist">
                        <a class="btn btn-add btn-sm" href="{{ route('videotutorial.create')}}"> <i class="fa fa-plus"></i> Create Video Tutorial
                        </a>
                     </div>
                  </div>
                  <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                  <div class="table-responsive">
                     <table id="dataTable" class="table table-sm table-bordered table-striped table-hover text-center">
                        <thead>
                           <tr class="info">
                              <th>Type</th>
                              <th>Level</th>
                              <th>Code</th>
                              <th>Title</th>
                              <th>View Total</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($video_tutorial as $v)
                           <tr>
                              <td align="center">{{ $v->type }}</td>
                              <td align="center">{{ $v->level }}</td>
                              <td align="center">{{ $v->code }}</td>
                              <td align="center">{{ $v->title }}</td>
                              <td align="center">{{ $v->view_total }}</td>
                              <td align="center">
                                 <a href="{{ route('videotutorial.update', ['code'=> ($v->code)]) }}" type="button" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                 <a href="{{ route('videotutorial.delete', ['code'=> ($v->code)]) }}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
         $(document).ready(function() {
            $('#dataTable').DataTable({
               "order": false
            });
            
         });
      </script>
      @endsection