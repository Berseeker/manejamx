<?php
/**
 * Clase Gestion del Sistema
 *
 * @package includes
 * @subpackage class
 * @author Macasoft
 * @copyright Maneja
 * @version 1.0
 * @since october 2021
 */ 
class SystemScrape {

    var $databaseLink; // Databaselink
	/**
	 * Constructor de la clase
	 */

	public function __construct() {
		date_default_timezone_set("America/Mexico_City");  
		$this->Connect();
		$this->setUp();
	}

    private function setUp() {
        $nAnno = date('Y');
    }

	private function Connect() {
        if ($this->databaseLink = new Mysqlidb(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME)) {
            return true;
        } else {
            return false;
        }
	}


    public function addVehicle($cMake, $cModel, $cVersion, $nYear, $nPrice, $nKM, $cCity, $cState, $cSoldyBy, $cImage, $cSource, $cSourceLink) { 
        if (!empty($cMake) && !empty($cModel) && !empty($nYear) && !empty($nPrice) && !empty($nKM)) {

            $aData         = array(
                'make'        => $cMake,
                'model'       => $cModel,
                'version'     => $cVersion,
                'year'        => $nYear,
                'price'       => $nPrice,
                'km'          => $nKM,
                'city'        => $cCity,
                'state'       => $cState,
                'sold_by'     => $cSoldyBy,
                'image'       => $cImage,
                'source'      => $cSource,
                'source_link' => $cSourceLink,
                'created_at'  => date("Y-m-d H:i:s"),
            );

            $lVerify = $this->verifyDuplicate($cMake, $cModel, $cVersion, $nKM, $cSoldyBy);
            if (!$lVerify) {
           
                if($this->databaseLink->insert("external_vehicles", $aData)) {

                    $aResponse = array(
                        'nResponse' => 200,
                        'cTitle'    => 'Maneja Scrapping',
                        'cMessage'  => 'Ok',
                        'cImage'    => '',
                        'cScript'   => '',
                    );
                } else {
                    $aResponse = array(
                        'nResponse' => 301,
                        'cTitle'    => 'Maneja Scrapping',
                        'cMessage'  => 'Error: An error occurred: '.$this->databaseLink->getLastError(),
                        'cImage'    => '',
                        'cScript'   => '',
                    );
                }
            } else {
                $aResponse = array(
                    'nResponse' => 301,
                    'cTitle'    => 'Maneja Scrapping',
                    'cMessage'  => 'El auto ya existe.',
                    'cImage'    => '',
                    'cScript'   => '',
                );
            }

        } else {
            $aResponse = array(
                'nResponse' => 300,
                'cTitle' => 'Maneja Scrapping',
                'cMessage' => 'Error: Please check all the required fields.',
                'cImage' => '',
                'cScript' => '',
            );
        }

        return $aResponse;
    }

    public function verifyDuplicate($cMake, $cModel, $cVersion='', $nKm, $cSoldyBy) {
        $this->databaseLink->where("make", $cMake);
        $this->databaseLink->where("model", $cModel);
        if (!empty($cVersion)) {
            $this->databaseLink->where("version", $cVersion);
        }
        $this->databaseLink->where("km", $nKm);
        $this->databaseLink->where("sold_by", $cSoldyBy);
        $aData = $this->databaseLink->getOne("external_vehicles");
        if ($this->databaseLink->count == 0) {
            return false;
        } else {
            return true;
        }
    }



    
}
?>
