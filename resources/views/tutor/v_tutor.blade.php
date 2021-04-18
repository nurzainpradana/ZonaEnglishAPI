@extends('v_master')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-code"></i>
      </div>
      <div class="header-title">
         <h1>Tutor</h1>
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
                        <a class="btn btn-add btn-sm" href="{{ route('tutor.create')}}"> <i class="fa fa-plus"></i> Create Tutor
                        </a>
                     </div>
                  </div>
                  <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                  <div class="table-responsive">
                     <table id="dataTable" class="table table-sm table-bordered table-striped table-hover text-center">
                        <thead>
                           <tr class="info">
                              <th>Code</th>
                              <th>Name</th>
                              <th>Rating</th>
                              <th>Price</th>
                              <th>Discount</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($data as $v)
                           <tr>
                              <td align="center">{{ $v->code }}</td>
                              <td align="center">{{ $v->name }}</td>
                              <td align="center">{{ $v->rating }} <i class="fa fa-star"></td>
                              <td align="center">Rp. <?php echo number_format( $v->price, 0, ',', '.'); ?></td>
                              <td align="center">Rp. <?php echo number_format( $v->discount, 0, ',', '.'); ?></td>
                              <td align="center">
                                 <a href="{{ route('tutor.update', ['code'=> ($v->code)]) }}" type="button" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                 <a href="{{ route('tutor.delete', ['code'=> ($v->code)]) }}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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