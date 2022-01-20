<?php  

namespace GoogleSheets2API\InitAPI;

class InitAPI
{

	private $API_BUILD_VERSION;
	private $API_DIR_VERSION;
	private $API_URL;
	private $API_MAIN_DIR;
	private $API_SHEETS_DIR;
	private $API_SPREADSHEET_DIR;
	private $API_DEVELOPER;
	private $API_COMPANY_NAME;
	private $API_COMPANY_WEBSITE_URL;
	private $API_PROJECT_URL;

	function __construct()
	{
		
	}

	private function init()
	{
		$this->API_BUILD_VERSION = '0.1.0';
		$this->API_DIR_VERSION = 'v1';
		$this->API_URL = 'https://sheets2api.com/api/';
		$this->API_MAIN_DIR = $this->API_URL.$this->API_DIR_VERSION.'/';
		$this->API_SHEETS_DIR = $this->API_MAIN_DIR.'sheets/';
		$this->API_SPREADSHEET_DIR = $this->API_MAIN_DIR;
		$this->API_DEVELOPER = 'Abdennour Adouani';
		$this->API_COMPANY_NAME = 'holoola-z';
		$this->API_COMPANY_WEBSITE_URL = 'https://holoola-z.com/';
		$this->API_PROJECT_URL = 'https://sheets2api.com/';
	}

	public function info()
	{
		$about = array(
			'version' => $this->API_BUILD_VERSION,
			'companyName' => $this->API_COMPANY_NAME,
			'companyURL' => $this->API_COMPANY_WEBSITE_URL,
			'projectURL' => $this->API_PROJECT_URL
		);
		return $about;
	}

	protected function getApiSheetsDir()
	{
		$this->init();
		return $this->API_SHEETS_DIR;
	}

	protected function getApiSpreadSheetDir()
	{
		$this->init();
		return $this->API_SPREADSHEET_DIR;
	}	

}
