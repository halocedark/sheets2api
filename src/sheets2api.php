<?php  

namespace GoogleSheets2API\Sheets2API;

include_once 'classes.php';
use GoogleSheets2API\InitAPI\InitAPI;
use GoogleSheets2API\Sheet\Sheet;
use GoogleSheets2API\Spreadsheet\Spreadsheet;
class Sheets2API 
{

	private $InitAPI;
	private $Sheet;
	private $Spreadsheet;

	private $apiid;

	function __construct($apiid = '')
	{

		// Initialize Classes
		$this->InitAPI = new InitAPI();
		if ( !empty($apiid) )
		{
			// Set api id
			$this->apiid = $apiid;
		}

	}

	public function about()
	{
		return $this->InitAPI->info();
	}
	
	public function Sheet($name)
	{
		$this->Sheet = new Sheet($name, $this->apiid);
		return $this->Sheet;
	}

	public function Spreadsheet()
	{
		$this->Spreadsheet = new Spreadsheet($this->apiid);
		return $this->Spreadsheet;
	}
	

}
