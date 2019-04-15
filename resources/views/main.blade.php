@extends('layouts.template')


@section('content')
   
      <div class="row">
      
      </div>
      
	
@endsection

@section('specific scripts')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@endsection