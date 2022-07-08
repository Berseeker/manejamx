<?php

include_once 'config.php';
$row = 0;

/// ******************** MERCADO LIBRE ******************** ///
$files = glob("./ml/*.csv");
foreach($files as $filepath) {
  	if ($handle = fopen($filepath, "r")) {
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        if ($row!=0) {
		        $num = count($data);
		        echo "<p> $num fields in line $row: <br /></p>\n";
 
		        $cSource = 'Mercado Libre';

	            // $data[$c]
	   			// 0 - 200000 pesos
	   			
				// 1 - https://auto.mercadolibre.com.mx/MLM-1324633074-chevrolet-trax-2014-18-ltz-piel-at-_JM#position=1&search_layout=grid&type=item&tracking_id=c677a623-c8f9-41f8-991c-7fdf072dfb4e
				$cSourceLink = $data[1];

				// 2 - https://http2.mlstatic.com/D_NQ_NP_873520-MLM47850174812_102021-W.webp
				$cImage = $data[2];

				// 3 - 200,000
		        $nPrice = str_replace(',', '', $data[3]);

				// 4 - 2014
				$nYear = $data[4];

				// 5 - 96,817 Km
		        $aKM = explode(' ', $data[5], 2);
		        $nKM = str_replace(',', '', $aKM[0]);

				// 6 - Chevrolet Trax 1.8 Ltz Piel At
				$aVehicle = explode(' ', $data[6], 2);
				
				echo $cMake = $aVehicle[0];
				echo "<br>";
				$aVehicle = explode(' ', $aVehicle[1], 2);
				echo $cModel = $aVehicle[0];
				echo "<br>";
				echo $cVersion = $aVehicle[1];
				echo "<br>";

				// 7 - Ocoyoacac - Estado De México
				$aLocation = explode('-', $data[7]);
				$cCity  = $aLocation[0];
				$cState = $aLocation[1];

				// 8 - Vendido por Grupo Satelite
				$cSoldyBy = $data[8];

	            //addVehicle($cMake, $cModel, $cVersion, $nYear, $nPrice, $nKM, $cCity, $cState, $cSoldyBy, $cImage, $cSource, $cSourceLink)
	            $aResult = $oSystemScrape->addVehicle($cMake, $cModel, $cVersion, $nYear, $nPrice, $nKM, $cCity, $cState, $cSoldyBy, $cImage, $cSource, $cSourceLink);

	            echo  "<strong>".$aResult['cMessage']."</strong>";
	            echo "<br>";
	            echo "<br>";
	        }
	        $row++;

	    }
	    fclose($handle);
  	}
}

/// ******************** KAVAK ******************** //////KAVAK///
$row = 0;
$files = glob("./kavak/*.csv");
foreach($files as $filepath) {
  	if ($handle = fopen($filepath, "r")) {
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        if ($row!=0) {
		        $num = count($data);
		        echo "<p> $num fields in line $row: <br /></p>\n";

		        $cSource = 'Kavak';

		        // Chevrolet Cavalier LS

		        if (strpos($data[0], 'Mercedes') !== false) {
		        	$aVehicle = explode(' ', $data[0], 3);
			        echo $cMake = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[2], 3);
					// $aVehicle = explode(' ', $aVehicle[0]);
					echo $cModel = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					echo $cVersion = $aVehicle[2];
					echo "<br>";	

		        } else if (strpos($data[0], 'Jeep') !== false) {

		        	$aVehicle = explode(' ', $data[0], 2);
			        echo $cMake = $aVehicle[0];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[1], 3);
					echo $cModel = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					echo $cVersion = $aVehicle[2];
					echo "<br>";	

		        } else if (strpos($data[0], 'Mini Cooper') !== false) {

		        	$aVehicle = explode(' ', $data[0], 3);
			        echo $cMake = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[2], 2);
					// $aVehicle = explode(' ', $aVehicle[0]);
					echo $cModel = $aVehicle[0];
					echo "<br>";
					echo $cVersion = '';
					echo "<br>";	

		        } else {

		        	$aVehicle = explode(' ', $data[0], 2);
			        echo $cMake = $aVehicle[0];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[1], 2);
					echo $cModel = $aVehicle[0];
					echo "<br>";
					echo $cVersion = $aVehicle[1];
					echo "<br>";	

		        }

		        // https://www.kavak.com/chevrolet-cavalier-ls-2018-compra-de-autos-48103	
		        $cSourceLink = $data[1];

		        // https://images.kavak.services/images/48103/cavalier-chevrolet-ls-2018-exterior-frontal_lateral_piloto_cercana-16213697297210.jpg?d=540x310
		        $cImage = $data[2];

		        // 2018 • 56,000 km • Monterrey
		        $cDataInfo = str_replace(' • ', '-', $data[3]);	
				$aDataInfo = explode('-', $cDataInfo);
				
				echo $nYear = $aDataInfo[0];	
				echo "<br>";
				$nKM = str_replace(',', '', $aDataInfo[1]);	
				echo $nKM   = str_replace(' km', '', $nKM);	
				echo "<br>";
				echo $cCity = $aDataInfo[2];	
				echo "<br>";
				$cState     = '';
		        
		        // $194,999 
		        $nPrice = str_replace(',', '', $data[4]);
		        echo $nPrice = str_replace('$', '', $nPrice);
		        echo "<br>";

				// 8 - Vendido por Grupo Satelite
				$cSoldyBy = 'Kavak';

	            //addVehicle($cMake, $cModel, $cVersion, $nYear, $nPrice, $nKM, $cCity, $cState, $cSoldyBy, $cImage, $cSource, $cSourceLink)
	            $aResult = $oSystemScrape->addVehicle($cMake, $cModel, $cVersion, $nYear, $nPrice, $nKM, $cCity, $cState, $cSoldyBy, $cImage, $cSource, $cSourceLink);

	            echo  "<strong>".$aResult['cMessage']."</strong>";
	            echo "<br>";
	            echo "<br>";
	        }
	        $row++;

	    }
	    fclose($handle);
  	}
}

$row = 0;

/// ******************** SEMI NUEVOS ******************** ///
$files = glob("./seminuevos/*.csv");
foreach($files as $filepath) {
  	if ($handle = fopen($filepath, "r")) {
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        if ($row!=0) {
		        $num = count($data);
		        echo "<p> $num fields in line $row: <br /></p>\n";

		        $cSource = 'Seminuevos';


		        //data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAACxAQMAAABEPBIfAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAB1JREFUWMPtwQENAAAAwiD7pzbHN2AAAAAAAADQdxr3AAFlp8nIAAAAAElFTkSuQmCC
		        $cImage = $data[0];

		        //https://www.seminuevos.com/vehicle/autos-ford-escape-guadalajara-2012/4115788?owt=d
		        $cSourceLink = $data[2];

		        if (strpos($data[3], 'Mercedes') !== false) {
		        	$aVehicle = explode(' ', $data[3], 3);
			        echo $cMake = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[2], 3);
					// $aVehicle = explode(' ', $aVehicle[0]);
					echo $cModel = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					// echo $cVersion = $aVehicle[2];
					//echo "<br>";	 

		        } else if (strpos($data[3], 'Jeep') !== false) {

		        	$aVehicle = explode(' ', $data[3], 2);
			        echo $cMake = $aVehicle[0];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[1], 3);
					echo $cModel = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					// echo $cVersion = $aVehicle[2];
					//echo "<br>";	

		        } else if (strpos($data[3], 'Mini Cooper') !== false) {

		        	$aVehicle = explode(' ', $data[3], 3);
			        echo $cMake = $aVehicle[0].' '.$aVehicle[1];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[2], 2);
					// $aVehicle = explode(' ', $aVehicle[0]);
					echo $cModel = $aVehicle[0];
					echo "<br>";
					// echo $cVersion = '';
					// echo "<br>";	

		        } else {

		        	$aVehicle = explode(' ', $data[3], 2);
			        echo $cMake = $aVehicle[0];
					echo "<br>";
					$aVehicle = explode(' ', $aVehicle[1], 2);
					echo $cModel = $aVehicle[0];
					echo "<br>";
					// echo $cVersion = $aVehicle[1];
					//echo "<br>";	

		        }

		        $cVersion = '';

		        //2012   85627 Kms. · Guadalajara
		        $cDataInfo = str_replace('   ', '-', $data[4]);	
		        $cDataInfo = str_replace(' · ', '-', $cDataInfo);	
				$aDataInfo = explode('-', $cDataInfo);
				
				echo $nYear = $aDataInfo[0];	
				echo "<br>";
				$nKM = str_replace(',', '', $aDataInfo[1]);	
				echo $nKM   = str_replace(' Kms.', '', $nKM);	
				echo "<br>";
				echo $cCity = $aDataInfo[2];	
				echo "<br>";
				$cState     = '';
		        
		        // $194,999 
		        $nPrice = str_replace(',', '', $data[6]);
		        echo $nPrice = str_replace('$', '', $nPrice);
		        echo "<br>";

				// 8 - Vendido por Grupo Satelite
				$cSoldyBy = 'Seminuevos';

	            //addVehicle($cMake, $cModel, $cVersion, $nYear, $nPrice, $nKM, $cCity, $cState, $cSoldyBy, $cImage, $cSource, $cSourceLink)
	            $aResult = $oSystemScrape->addVehicle($cMake, $cModel, $cVersion, $nYear, $nPrice, $nKM, $cCity, $cState, $cSoldyBy, $cImage, $cSource, $cSourceLink);

	            echo  "<strong>".$aResult['cMessage']."</strong>";
	            echo "<br>";
	            echo "<br>";
	        }
	        $row++;

	    }
	    fclose($handle);
  	}
}



