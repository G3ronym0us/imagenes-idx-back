<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		* {
			margin:0px;
		}

		h5 {
			font-size: 16px;
		}

		.datos {
			font-size: 10px;
			margin-top: 5px;
		}

		.piepagina {
			font-size: 7.66667px;
		}

		.imagen {
			position: top;
			/*top: 0px;*/
			left: 0px;
			right: 0px;
			height: 50px;
			/**/
			color: white;
			text-align: center;
			line-height: 35px;
		}

		.contenedor {
			margin-top: 35px;
			width: 100%;
			display: table;
		}

		.contenedor h5, .contenedor p {
			text-align: center;
		}

		footer {
			position: fixed;
			bottom: 0px;
			height: 50px;
			/**/
			overflow: auto;
			color: black;
			text-align:justify;
		}

		.piepagina {
			display: flex;
			align-items: center;
			text-align:center;
		}

		.piepagina p {
			padding-top: 6px;
			margin: auto;
		}
	</style>
</head>
<body>
	<img class="imagen" src="https://i.ibb.co/0tvJyRp/logo.jpg" width="100%" height="20px">

	<div class="contenedor">
		<h5>Nº DE DOCUMENTO:</h5>
		<p style="font-size: 20px;" class="datos">{{$ticket->documento}}</p>
		<h5>ORDEN DE SERVICIO:</h5>
		<p style="font-size: 20px;" class="datos">{{$ticket->codigo}}</p>
	</div>

	<footer class="piepagina">
		<p>
			Descargue sus resultados ingresando el número de documento del paciente
			y el número de orden de servicio en www.imagenesidx.com
			opción DESCARGA DE RESULTADOS. Este ticket es personal e intransferible
		</p>
	</footer>
</body>
</html>
