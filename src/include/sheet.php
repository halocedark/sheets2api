<?php  

namespace GoogleSheets2API\Sheet;
use GoogleSheets2API\HTTPRequest\HTTPRequest;
use GoogleSheets2API\InitAPI\InitAPI;
use GoogleSheets2API\TigerArray\TigerArray;
use GoogleSheets2API\Sheets2APIException\Sheets2APIException;
class Sheet extends InitAPI
{

	private $HTTPRequest;

	private $apiSheetsDir;
	private $sheetName;
	private $apiid;

	function __construct($name = '', $apiid = '')
	{
		
		// Initialize Classes
		$this->HTTPRequest = new HTTPRequest();
		// Api Sheets Dir
		$this->apiSheetsDir = $this->getApiSheetsDir();

		if ( !isset($name) || empty($name) )
			throw new Sheets2APIException(Sheets2APIException::ERR_INVALID_SHEET_NAME, Sheets2APIException::ERR_CODE_INVALID_SHEET_NAME);
		if ( !isset($apiid) || empty($apiid) )
			throw new Sheets2APIException(Sheets2APIException::ERR_INVALID_API_ID, Sheets2APIException::ERR_CODE_INVALID_API_ID);

		$this->sheetName = $name;
		$this->apiid = $apiid;
			
	}

	public function get($params = [])
	{
		$paramsStr = '';
		$url = '';
		if ( sizeof($params) > 0 )
		{
			$paramsStr = TigerArray::stringify(TigerArray::assocArraytoURLParams($params), '');
			$url = $this->apiSheetsDir.'sheet?apiId='.$this->apiid.'&name='.$this->sheetName.$paramsStr;
		}
		else
			$url = $this->apiSheetsDir.'sheet?apiId='.$this->apiid.'&name='.$this->sheetName;

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

	public function cells($query)
	{
		$url = $this->apiSheetsDir.'cells?apiId='.$this->apiid.'&sheet='.$this->sheetName.'&query='.$query;
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

	public function count()
	{
		$url = $this->apiSheetsDir.'count?apiId='.$this->apiid.'&sheet='.$this->sheetName;
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

	public function keys()
	{
		$url = $this->apiSheetsDir.'keys?apiId='.$this->apiid.'&sheet='.$this->sheetName;
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

	public function search($query = [], $params = [])
	{
		$query = TigerArray::stringify($query, ',');
		$paramsStr = '';
		$url = '';
		if ( sizeof($params) > 0 )
		{
			$paramsStr = TigerArray::stringify(TigerArray::assocArraytoURLParams($params), '');
			$url = $this->apiSheetsDir.'search?apiId='.$this->apiid.'&sheet='.$this->sheetName.'&query='.$query.$paramsStr;
		}
		else
			$url = $this->apiSheetsDir.'search?apiId='.$this->apiid.'&sheet='.$this->sheetName.'&query='.$query;
		
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

	public function searchBy($columnsQuery, $params = [])
	{
		$queryArr = TigerArray::assocArraytoURLParams($columnsQuery);
		$queryStr = TigerArray::stringify($queryArr, '');
		$paramsStr = '';
		$url = '';
		if ( sizeof($params) > 0 )
		{
			$paramsStr = TigerArray::stringify(TigerArray::assocArraytoURLParams($params), '');
			$url = $this->apiSheetsDir.'searchBy?apiId='.$this->apiid.'&sheet='.$this->sheetName.$queryStr.$paramsStr;
		}
		else
			$url = $this->apiSheetsDir.'searchBy?apiId='.$this->apiid.'&sheet='.$this->sheetName.$queryStr;
		
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

	public function clear()
	{
		$url = $this->apiSheetsDir.'clear';
		$fields = array(
			'sheet' => $this->sheetName,
			'apiId' => $this->apiid
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

	public function copy($copyTo)
	{
		$url = $this->apiSheetsDir.'copy';
		$fields = array(
			'sheet' => $this->sheetName,
			'apiId' => $this->apiid,
			'copyTo' => $copyTo
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

	public function deleteRow($query)
	{
		$url = $this->apiSheetsDir.'deleteRows';
		$query = TigerArray::parse($query, '=');
		// If Number of columns in condition less than 2 or exceeds 2 don't send post request
		if ( sizeof($query) < 2 || sizeof($query) > 2 )
		{
			$response = array(
				'error' => 'ERR_INVALID_COLUMNS_NUMBER',
				'message' => 'The number of columns and values in request less than or exceeds the accepted amount!',
				'code' => 404
			);
			return $response;
		}
		$fields = array(
			'sheet' => $this->sheetName,
			'apiId' => $this->apiid,
			'column' => $query[0],
			'value' => $query[1]
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

	public function update($query, $data = [])
	{
		$url = $this->apiSheetsDir.'update';
		$query = TigerArray::parse($query, '=');
		// If Number of columns in condition less than 2 or exceeds 2 don't send post request
		if ( sizeof($query) < 2 || sizeof($query) > 2 )
		{
			$response = array(
				'error' => 'ERR_INVALID_COLUMNS_NUMBER',
				'message' => 'The number of columns and values in request less than or exceeds the accepted amount!',
				'code' => 404
			);
			return $response;
		}
		$fields = array(
			'sheet' => $this->sheetName,
			'apiId' => $this->apiid,
			'column' => $query[0],
			'value' => $query[1],
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

	public function addRow($data = [])
	{
		$url = $this->apiSheetsDir.'addRow';
		$fields = array(
			'sheet' => $this->sheetName,
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
		$url = $this->apiSheetsDir.'addRows';
		$fields = array(
			'sheet' => $this->sheetName,
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

	public function importTable($pageURL, $index)
	{
		$url = $this->apiSheetsDir.'importTable';
		$fields = array(
			'sheet' => $this->sheetName,
			'apiId' => $this->apiid,
			'url' => $pageURL,
			'index' => $index
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

	public function importList($pageURL, $index)
	{
		$url = $this->apiSheetsDir.'importList';
		$fields = array(
			'sheet' => $this->sheetName,
			'apiId' => $this->apiid,
			'url' => $pageURL,
			'index' => $index
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

}