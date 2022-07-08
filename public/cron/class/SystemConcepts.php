<?php
/**
 * Clase Users
 *
 * @package includes
 * @subpackage class
 * @author Rodrigo Macazaga
 * @copyright FEYEL*
 * @version 1.0
 * @since febrero 2019
 */ 
class SystemConcepts {  

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

    // CRUD
    public function addConcept() { 
        if (!empty($_POST['category']) && !empty($_POST['subcategory']) && !empty($_POST['code']) && !empty($_POST['unit']) && !empty($_POST['concept'])) {

            $aData         = array(
                'categoria'    => $_POST['category'],
                'subcategoria' => $_POST['subcategory'],
                'codigo'       => $_POST['code'],
                'unidad'       => $_POST['unit'],
                'concepto'     => $_POST['concept'],
                'created_at'   => date("Y-m-d H:i:s"),
            );
           
            if($this->databaseLink->insert("conceptos", $aData)) {

                $cScript = 'conceptsTable(); $("#newConceptModal").modal("hide");';

                $aResponse = array(
                    'nResponse' => 200,
                    'cTitle' => SYSTEM_NAME,
                    'cMessage' => 'Ok',
                    'cImage' => '',
                    'cScript' => $cScript,
                );
            } else {
                $aResponse = array(
                    'nResponse' => 301,
                    'cTitle' => SYSTEM_NAME,
                    'cMessage' => 'Error: An error occurred: '.$this->databaseLink->getLastError(),
                    'cImage' => '',
                    'cScript' => '',
                );
            }

        } else {
            $aResponse = array(
                'nResponse' => 300,
                'cTitle' => SYSTEM_NAME,
                'cMessage' => 'Error: Please check all the required fields.',
                'cImage' => '',
                'cScript' => '',
            );
        }

        return $aResponse;
    }

    public function updateConcept() { 
        if (!empty($_POST['conceptId']) && !empty($_POST['category']) && !empty($_POST['subcategory']) && !empty($_POST['code']) && !empty($_POST['unit']) && !empty($_POST['concept'])) {

            $nConceptId = $_POST['conceptId'];
            $aConcept = $this->getConcept($nConceptId);

            $aData = array(
                'categoria'    => $_POST['category'],
                'subcategoria' => $_POST['subcategory'],
                'codigo'       => $_POST['code'],
                'unidad'       => $_POST['unit'],
                'concepto'     => $_POST['concept'],
                'updated_at'   => date("Y-m-d H:i:s"),
            );
            
            $this->databaseLink->where("id", $nConceptId);
            if($this->databaseLink->update("conceptos", $aData)) {
                $aResponse = array(
                    'nResponse' => 200,
                    'cTitle' => SYSTEM_NAME,
                    'cMessage' => 'Ok',
                    'cImage' => '',
                    'cScript' => 'conceptsTable(); $("#newConceptModal").modal("hide");',
                );
            } else {
                $aResponse = array(
                    'nResponse' => 301,
                    'cTitle' => SYSTEM_NAME,
                    'cMessage' => 'Error: An error occurred: '.$this->databaseLink->getLastError(),
                    'cImage' => '',
                    'cScript' => '',
                );
            }

        } else {
            $aResponse = array(
                'nResponse' => 300,
                'cTitle' => SYSTEM_NAME,
                'cMessage' => 'Error: Please check all the required fields.',
                'cImage' => '',
                'cScript' => '',
            );
        }

        return $aResponse;
    }

    public function deleteConcept() { 
        if (isset($_POST['conceptId'])) {
            $nConceptId = $_POST['conceptId'];

            $aConcept = $this->getConcept($nConceptId);

            $aData = array(
                'deleted_at' => date("Y-m-d H:i:s"),
            );
           
            $this->databaseLink->where("id", $nConceptId);
            if($this->databaseLink->update("conceptos", $aData)) { 
                $aResponse = array(
                    'nResponse' => 200,
                    'cTitle' => SYSTEM_NAME,
                    'cMessage' => 'Ok',
                    'cImage' => '',
                    'cScript' => 'conceptsTable();',
                );
            } else {
                $aResponse = array(
                    'nResponse' => 301,
                    'cTitle' => SYSTEM_NAME,
                    'cMessage' => 'Error: An error occurred: '.$this->databaseLink->getLastError(),
                    'cImage' => '',
                    'cScript' => '',
                );
            }

        } else {
            $aResponse = array(
                'nResponse' => 300,
                'cTitle' => SYSTEM_NAME,
                'cMessage' => 'Error: Please check all the required fields.',
                'cImage' => '',
                'cScript' => '',
            );
        }

        return $aResponse;
    }   


     

    public function getConcept($nConceptId='') {
        if (isset($_POST['concept'])) {
            $nConceptId = $_POST['concept'];
        }
        $this->databaseLink->where("id", $nConceptId);
        $aData = $this->databaseLink->getOne("conceptos");
        return $aData;
    }

    public function getConcepts() {
        $this->databaseLink->orderBy("concepto","desc");
        $this->databaseLink->where("deleted_at", '0000-00-00 00:00:00');
        $aData = $this->databaseLink->get("conceptos");
        return $aData;
    }

    public function getUnit($nUnitId='') {
        if (isset($_POST['unit'])) {
            $nUnitId = $_POST['unit'];
        }
        $this->databaseLink->where("id", $nUnitId);
        $aData = $this->databaseLink->getOne("unidades_medida");
        return $aData;
    }

    public function getUnits() {
        $this->databaseLink->orderBy("nombre","ASC");
        $aData = $this->databaseLink->get("unidades_medida");
        return $aData;
    }


     

    
}
?>
