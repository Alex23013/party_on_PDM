@extends('layouts.template')


@section('content')   
      <div class="row">
      	<div class="col-md-12">
      	 <iframe scrolling="no" frameborder="0" allowTransparency="true" src="https://www.deezer.com/plugins/player?format=classic&autoplay=false&playlist=true&width=700&height=350&color=ff0000&layout=dark&size=medium&type=tracks&id=3135556&app_id=376264" width="700" height="350"></iframe>
      	</div>
      	
      </div>
	
@endsection

@section('specific scripts')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@endsection