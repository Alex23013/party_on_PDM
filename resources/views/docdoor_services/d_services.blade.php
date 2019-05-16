@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
</style>

<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
	        <div class="box-header mm-left ">
	          <h3 class="box-title ">Lista de Solicitudes de Servicios Docdoor</h3>
	          <br>
	          <a href="/d_services/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-plus"></i>  Añadir una Solicitud</h5>
                </button>
              </a>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body mm-left"> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3><b>Nueva solicitud </b></h3>
			  </div>
			@endif
			 <table class="table table-bordered table-striped">
                <thead>
                <tr>
	                  <th>Paciente</th>
	                  <th>Servicio</th>
	                  <th>Asociado</th>
	                  <th>Direccion inicio</th>
	                  <th>Direccion fin</th>
	                  <th>Estado</th>
	            </tr>
                </thead>
                <tbody>
          		<?php foreach ($services as $d_service): ?>
	                  <tr>  
	                  <td><?=$d_service->name?></td>
	                  <td><?=$d_service->service_name?></td>
	                  <td><?=$d_service->partner_name?></td>
	                  <td><?=$d_service->address_from?></td>
	                  <td><?=$d_service->address_to?></td>
	                  @if ($d_service->complete)
	                  	<td>Realizado</td>
	                  @else
	                  	<td>Pendiente </td>
	                  @endif
	                  <td> 
	                  	<a href="/d_services/detail/{{$d_service->d_service_id}}"> <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>

	                  	@if ($d_service->complete)
	                  		<button  type="button" class="btn btn-success btn-flat buttonSpace disabled"><i class="fa fa-check-square-o"></i></button>
	                  	@else
	                  		<a href="/d_services/{{$d_service->d_service_id}}/complete"> <button  type="button" class="btn btn-warning btn-flat buttonSpace"><i class="fa  fa-square-o"></i></button></a>
	                  	@endif
	                  	<a href="/d_services/remove/{{$d_service->d_service_id}}"> <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar esta solicitud de servicio Docdoor?');"><i class="fa fa-trash"></i></button><a>
	                  </td>
	                  </tr>  
	                  <?php endforeach ?>  
                  
                </tbody>
              </table>
	        </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example2_length"><label>Show <select name="example2_length" aria-controls="example2" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example2_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example2"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 167.917px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">Rendering engine</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 214.367px;" aria-label="Browser: activate to sort column ascending">Browser</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 181.983px;" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 143.983px;" aria-label="Engine version: activate to sort column ascending">Engine version</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 102.75px;" aria-label="CSS grade: activate to sort column ascending">CSS grade</th></tr>
                </thead>
                <tbody>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Seamonkey 1.1</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Netscape Navigator 9</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Netscape Browser 8</td>
                  <td>Win 98SE+</td>
                  <td>1.7</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Netscape 7.2</td>
                  <td>Win 95+ / Mac OS 8.6-9.2</td>
                  <td>1.7</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Mozilla 1.8</td>
                  <td>Win 98+ / OSX.1+</td>
                  <td>1.8</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Mozilla 1.7</td>
                  <td>Win 98+ / OSX.1+</td>
                  <td>1.7</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Mozilla 1.6</td>
                  <td>Win 95+ / OSX.1+</td>
                  <td>1.6</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Mozilla 1.5</td>
                  <td>Win 95+ / OSX.1+</td>
                  <td>1.5</td>
                  <td>A</td>
                </tr><tr role="row" class="odd">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Mozilla 1.4</td>
                  <td>Win 95+ / OSX.1+</td>
                  <td>1.4</td>
                  <td>A</td>
                </tr><tr role="row" class="even">
                  <td class="sorting_1">Gecko</td>
                  <td class="">Mozilla 1.3</td>
                  <td>Win 95+ / OSX.1+</td>
                  <td>1.3</td>
                  <td>A</td>
                </tr></tbody>
                <tfoot>
                <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
                </tfoot>
              </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>
</div>
@endsection

@section('specific scripts')
<script>
  $(function () {
    $('#example2').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

@endsection