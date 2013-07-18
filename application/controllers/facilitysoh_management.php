<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Facilitysoh_Management extends MY_Controller {
	function __construct() {
		parent::__construct();
		$data = array();
		ini_set("max_execution_time", "10000");
	}

	public function index() {
		//$this -> plotgraph();
	}

	public function plotgraph($year,$month,$pipeline) {
		//$pipeline = "1";
		//$month = "12";
		//$year = "2011";
		$results = Facility_Soh::getTotals($pipeline, $month, $year);
		$facility_results = Facility_Soh::getFacilities($pipeline, $month, $year);
		$drug_results = Facility_Soh::getDrugs($pipeline, $month, $year);
		$count = 1;
		$i = 0;
		$dyn_table = "<table border='1'  cellspacing='0.75' cellpadding='1'>";
		$dyn_table .= "<thead><tr><th>Facility Name</th>";
		foreach ($drug_results as $drug_result) {
			$dyn_table .= "<th>" . $drug_result['drugname'] . "</th>";
		}
		$dyn_table .= "</tr></thead>";
		$dyn_table .= "<tbody><tr><td>" . $facility_results[$i]['facilityname'] . "</td>";
		foreach ($results as $result) {
			$dyn_table .= "<td>" . $result['total'] . "</td>";
			$count++;
			if ($count ==sizeof($drug_results)+1) {
				$dyn_table .= "</tr>";
				$count = 1;
				if ($i < sizeof($facility_results)-1) {
					$i++;
					$dyn_table .= "<tr><td>".$facility_results[$i]['facilityname'] . "</td>";

				}
			}

		}
		$dyn_table .= "</tbody></table>";
		echo $dyn_table;
	}

}
?>