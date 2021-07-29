<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Boton Flotante con Css</title>
</head>
<body>
<button onclick="noti()" type="button">Click Me!</button>
</body>
<script>
window.onload=function(){
	Push.Permission.request();
}
function noti(){
	Push.create("Notificacion",{
		body: "Esta es",
	//	icon:"Imagenes_config/casa_bonita_google_play.png",
		timeout:5000,
		vibrate:[100,100,100],
		onClick:function(){
			alert("es");
		}
	});	
}
/*
setInterval(function(){
	Push.create("Notificacion",{
		body: "Esta es",
	//	icon:"Imagenes_config/casa_bonita_google_play.png",
		timeout:5000,
		vibrate:[100,100,100],
		onClick:function(){
			alert("es");
		}
	});	
},1000);
*/
</script>
</html>