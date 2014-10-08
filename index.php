<?php
/*
** CTIC - SSPDS-CE
** Copyright (C) 2012-2013 CTIC - SSPDS-CE
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**
** Contacts:
** Leandro Alves Machado - Analista de Sistemas - leandro.machado@sspds.ce.gov.br
** Aristoteles Araujo - Analista de Sistemas - aristoteles.araujo@sspds.ce.gov.br
**
**
** Colaboração: 
** Helder Santana - helder.bs.santana@gmail.com
**
**/

?>
<?php 
include 'includes/autoload.php';
error_reporting(0);

$grupo = new Conexao();
$grupo->conectar();

?>

<!-- =================================================================== -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Geolocaliza&ccedil;&atilde;o - SSPDS/CE</title>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/geral.css" />
<link rel="stylesheet" type="text/css" href="css/grupo.css" />

<!-- ========================= OpenStreetMap =========================  -->
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script>
	function opensmap(){
		mapa = new OpenLayers.Map("OpenMap");
		mapa.addLayer(new OpenLayers.Layer.OSM());
    	mapa.zoomToMaxExtent();
    
    	mapa.addControl(new OpenLayers.Control.MousePosition());
    	mapa.addLayer(new OpenLayers.Layer.OSM());
    	mapa.zoomToMaxExtent();


 		//Marcação no mapa, testes
    	var lonLat = new OpenLayers.LonLat( -13.007642 ,-38.492606 )
        	.transform(
        	    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
        	   	mapa.getProjectionObject() // to Spherical Mercator Projection
        	);
 
    	var zoom=16;
 
    	var markers = new OpenLayers.Layer.Markers( "Markers" );
    	mapa.addLayer(markers);
    	markers.addMarker(new OpenLayers.Marker(lonLat));
    	//Fim de teste
    }
</script> 
<!-- =================================================================== -->

</head>

<body onload="opensmap();">
<div id="pagina-principal">

	<table id="pagina-principal-tabela">
	
		<tr>
			<td class="pagina-principal-topo">
				
				<div id="longitude">Long:  0.000000</div>
				
				<div id="latitude">Lat:  0.000000</div>
				
				<div id="grupos">
					<select id="grupo" style="width:300px;" onchange="carregarGrupo();">
					<?php 
						$grupos = new Grupos();
						$grupos = $grupos->get_grupos();
						
						foreach ($grupos as $indice => $grupos_item):
						
								if ($grupo->group == $indice) {
					?>
									<option value="<?=$indice?>" selected><?=$indice?> - <?=$grupos_item?></option>
					<?php 
								} else {
					?>
									<option value="<?=$indice?>"><?=$indice?> - <?=$grupos_item?></option>
					<?php
								}
						endforeach;
					?>
					
					</select>
				</div>			
			</td>
		</tr>
		
		<tr>
			<td class="pagina-principal-centro">
				<div id="OpenMap"></div>
				</div>
			</td>
		</tr>
	
	</table>

</div>
</body>

</html>

