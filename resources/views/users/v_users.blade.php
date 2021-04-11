@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Users</h1>
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
                        <a class="btn btn-add btn-sm" href="{{ route('users.create')}}"> <i class="fa fa-plus"></i> Create Users
                        </a>
                     </div>
                  </div>
                  <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                  <div class="table-responsive">
                     <table id="dataTable" class="table table-sm table-bordered table-striped table-hover text-center">
                        <thead>
                           <tr class="info">
                              <th>ID</th>
                              <th>Name</th>
                              <th>NIK</th>
                              <th>No Phone</th>
                              <th>Email</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($data as $d)
                           <tr>
                              <td align="center">{{ $d->id }}</td>
                              <td align="center">{{ $d->name }}</td>
                              <td align="center">{{ $d->nik }}</td>
                              <td align="center">{{ $d->no_phone }}</td>
                              <td align="center">{{ $d->email }}</td>
                              <td align="center">
                                 <a href="{{ route('users.update', ['code'=> ($d->id)]) }}" type="button" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                 <a href="{{ route('users.delete', ['code'=> ($d->id)]) }}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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