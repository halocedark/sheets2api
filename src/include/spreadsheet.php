<?php  

namespace GoogleSheets2API\Spreadsheet;
use GoogleSheets2API\HTTPRequest\HTTPRequest;
use GoogleSheets2API\InitAPI\InitAPI;
use GoogleSheets2API\TigerArray\TigerArray;

class Spreadsheet extends InitAPI
{

	private $HTTPRequest;

	private $apiSpreadSheetDir;
	private $apiid;

	function __construct($apiid = '')
	{
		
		// Initialize Classes
		$this->HTTPRequest = new HTTPRequest();
		// Api Sheets Dir
		$this->apiSpreadSheetDir = $this->getApiSpreadSheetDir();

		if ( !isset($apiid) || empty($apiid) )
			throw new Sheets2APIException(Sheets2APIException::ERR_INVALID_API_ID, Sheets2APIException::ERR_CODE_INVALID_API_ID);

		$this->apiid = $apiid;
			
	}

	public function get($params = [])
	{
		$paramsStr = '';
		$url = '';
		if ( sizeof($params) > 0 )
		{
			$paramsStr = TigerArray::stringify(TigerArray::assocArraytoURLParams($params), '');
			$url = $this->apiSpreadSheetDir.'?apiId='.$this->apiid.$paramsStr;
		}
		else
			$url = $this->apiSpreadSheetDir.'?apiId='.$this->apiid;
		
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function cells($query)
	{
		$url = $this->apiSpreadSheetDir.'cells?apiId='.$this->apiid.'&query='.$query;
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function count()
	{
		$url = $this->apiSpreadSheetDir.'count?apiId='.$this->apiid;
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function keys()
	{
		$url = $this->apiSpreadSheetDir.'keys?apiId='.$this->apiid;
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function search($query = [], $params = [])
	{
		$query = TigerArray::stringify($query, ',');
		$paramsStr = '';
		$url = '';
		if ( sizeof($params) > 0 )
		{
			$paramsStr = TigerArray::stringify(TigerArray::assocArraytoURLParams($params), '');
			$url = $this->apiSpreadSheetDir.'search?apiId='.$this->apiid.'&query='.$query.$paramsStr;
		}
		else
			$url = $this->apiSpreadSheetDir.'search?apiId='.$this->apiid.'&query='.$query;
		
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function searchBy($columnsQuery, $params = [])
	{
		$queryArr = TigerArray::assocArraytoURLParams($columnsQuery);
		$queryStr = TigerArray::stringify($queryArr, '');
		$paramsStr = '';
		$url = '';
		if ( sizeof($params) > 0 )
		{
			$paramsStr = TigerArray::stringify(TigerArray::assocArraytoURLParams($params), '');
			$url = $this->apiSpreadSheetDir.'searchBy?apiId='.$this->apiid.$queryStr.$paramsStr;
		}
		else
			$url = $this->apiSpreadSheetDir.'searchBy?apiId='.$this->apiid.$queryStr;
		
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function sheets()
	{
		$url = $this->apiSpreadSheetDir.'sheets/?apiId='.$this->apiid;
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function name()
	{
		$url = $this->apiSpreadSheetDir.'name?apiId='.$this->apiid;
		$response = $this->HTTPRequest->get($url);		
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SERVER_INTERNAL',
				'message' => 'There was an internal server error!',
				'code' => 404
			);
		}
		
		return $response;
	}

	public function create($sheetName)
	{
		$url = $this->apiSpreadSheetDir.'sheets/create';
		$fields = array(
			'name' => $sheetName,
			'apiId' => $this->apiid
		);

		$response = $this->HTTPRequest->post($url, $fields);
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_SHEET_ALREADY_EXISTS',
				'message' => 'Sheet name already exists!',
				'code' => 404
			);
		}
		return $response;
	}

	public function deleteSheets($sheetNames = [])
	{
		$url = $this->apiSpreadSheetDir.'sheets/remove';
		if ( !isset($sheetNames) || sizeof($sheetNames) == 0 )
		{
			$response = array(
				'error' => 'ERR_INVALID_SHEETS_NUMBER',
				'message' => 'The number of sheets specified is less than the minimum number to delete!',
				'code' => 404
			);
			return $response;
		}
		$fields = array(
			'apiId' => $this->apiid,
			'names' => $sheetNames
		);

		$response = $this->HTTPRequest->post($url, $fields);
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_INVALID_ARGUMENT',
				'message' => 'Invalid argument specified!',
				'code' => 404
			);
		}

		return $response;
	}

	public function addRow($data = [])
	{
		$url = $this->apiSpreadSheetDir.'addRow';
		$fields = array(
			'apiId' => $this->apiid,
			'data' => $data
		);

		$response = $this->HTTPRequest->post($url, $fields);
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_INVALID_ARGUMENT',
				'message' => 'Invalid argument specified!',
				'code' => 404
			);
		}
		return $response;
	}

	public function addRows($data = [])
	{
		$url = $this->apiSpreadSheetDir.'addRows';
		$fields = array(
			'apiId' => $this->apiid,
			'data' => $data
		);

		$response = $this->HTTPRequest->post($url, $fields);
		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_INVALID_ARGUMENT',
				'message' => 'Invalid argument specified!',
				'code' => 404
			);
		}
		return $response;
	}

	public function list()
	{
		$url = $this->apiSpreadSheetDir.'list?apiId='.$this->apiid;

		$response = $this->HTTPRequest->get($url);

		if ( json_decode($response, true) == null )
		{
			$response = array(
				'error' => 'ERR_INVALID_ARGUMENT',
				'message' => 'Invalid argument specified!',
				'code' => 404
			);
		}

		return $response;
	}

}