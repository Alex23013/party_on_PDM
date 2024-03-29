<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>

	<script type="text/javascript" src="http://cdn-files.deezer.com/js/min/dz-v00202681.js"></script>

	<style type="text/css">
		.progressbarplay {
			cursor:pointer;overflow: hidden;height: 8px;margin-bottom: 8px;background-color: #F7F7F7;background-image: -moz-linear-gradient(top,whiteSmoke,#F9F9F9);background-image: -ms-linear-gradient(top,whiteSmoke,#F9F9F9);background-image: -webkit-gradient(linear,0 0,0 100%,from(whiteSmoke),to(#F9F9F9));background-image: -webkit-linear-gradient(top,whiteSmoke,#F9F9F9);background-image: -o-linear-gradient(top,whiteSmoke,#F9F9F9);background-image: linear-gradient(top,whiteSmoke,#F9F9F9);background-repeat: repeat-x;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5f5f5',endColorstr='#f9f9f9',GradientType=0);-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;
		}
		.progressbarplay .bar {
			cursor:pointer;background: #4496C6;width: 0;height: 8px;color: white;font-size: 12px;text-align: center;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);-moz-box-shadow: inset 0 -1px 0 rgba(0,0,0,0.15);box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;-webkit-transition: width .6s ease;-moz-transition: width .6s ease;-ms-transition: width .6s ease;-o-transition: width .6s ease;transition: width .6s ease;
		}
	</style>
</head>
<body>
<!--<div id="dz-root"></div>
<div id="player" style="width:100%;" align="center"></div>
<br/>

<div id="slider_seek" class="progressbarplay" style="">
  <div class="bar" style="width: 0%;"></div>
</div>-->
<iframe scrolling="no" frameborder="0" allowTransparency="true" src="https://www.deezer.com/plugins/player?format=square&autoplay=false&playlist=false&width=300&height=300&color=ff0000&layout=dark&size=medium&type=tracks&id=1560273&app_id=1" width="300" height="300"></iframe>
<?php
echo '<object scrolling="no" frameborder="0" allowTransparency="true" data="https://www.deezer.com/plugins/player?format=square&autoplay=true&playlist=true&width=300&height=300&color=ff0000&layout=dark&size=medium&type=tracks&id='.$id.'&app_id=376484" width="300" height="300"></object>' ?>
<script>
	$(document).ready(function(){
		$("#controlers input").attr('disabled', true);
		$("#slider_seek").click(function(evt,arg){
			var left = evt.offsetX;
			DZ.player.seek((evt.offsetX/$(this).width()) * 100);
		});
	});
	function event_listener_append() {
		var pre = document.getElementById('event_listener');
		var line = [];
		for (var i = 0; i < arguments.length; i++) {
			line.push(arguments[i]);
		}
		pre.innerHTML += line.join(' ') + "\n";
	}
	function onPlayerLoaded() {
		$("#controlers input").attr('disabled', false);
		event_listener_append('player_loaded');
		DZ.Event.subscribe('current_track', function(arg){
			event_listener_append('current_track', arg.index, arg.track.title, arg.track.album.title);
		});
		DZ.Event.subscribe('player_position', function(arg){
			event_listener_append('position', arg[0], arg[1]);
			$("#slider_seek").find('.bar').css('width', (100*arg[0]/arg[1]) + '%');
		});
	}
	DZ.init({
		appId  : '8',
		channelUrl : 'http://developers.deezer.com/examples/channel.php',
		player : {
			container : 'player',
			cover : true,
			playlist : true,
			width : 650,
			height : 300,
			onload : onPlayerLoaded
		}
	});
</script><br/>

</body>
</html>