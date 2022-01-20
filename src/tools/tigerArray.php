<?php  

namespace GoogleSheets2API\TigerArray;

class TigerArray
{

	public static function stringify($array, $delimiter = ';')
	{
		$str = '';

		if ( !isset($array) )
			return '';

		if ( !is_array($array) )
			return '';

		$str = implode($delimiter, $array);

		return $str;
	}

	public static function parse($str, $delimiter)
	{
		if ( empty($str) )
			return $str;

		return explode($delimiter, $str);
	}

	public static function unique($array)
	{
		if ( !isset($array) )
			return '';

		return array_unique($array, SORT_REGULAR);
	}

	public static function filterByValue($src_arr, $value, $case_sensitive = true)
	{
		$results = array();
		if ( !isset($src_arr) )
			return null;

		if ( empty($value) )
			return null;

		for ($i=0; $i < sizeof($src_arr); $i++) 
		{ 
			if ( $case_sensitive )
			{	
				if ( $src_arr[$i] != $value )
				{
					array_push($results, $src_arr[$i]);
				}
			}
			else
			{
				if ( strtolower($src_arr[$i]) != strtolower($value) )
				{
					array_push($results, $src_arr[$i]);
				}
			}
		}

		return $results;
	}

	public static function replace($arr, $replace, $with)
	{
		if ( !isset($arr) )
			return null;

		for ($i=0; $i < sizeof($arr); $i++) 
		{ 
			if ( $arr[$i] == $replace )
				$arr[$i] = $with;
		}

		return $arr;
	}

	public static function removeIndex($arr, $index)
	{
		if ( !isset($arr) )
			return null;
		unset($arr[$index]);
		$arr = array_values($arr);
		return $arr;
	}

	public static function assocArraytoURLParams($arr, $assignFirstParam = false)
	{
		if ( !isset($arr) )
			return null;

		$params = '';
		$paramsArr = [];
		$keys = array_keys($arr);
		$vals = array_values($arr);
		for ($i=0; $i < sizeof($keys); $i++) 
		{ 
			if ( !$assignFirstParam )
				$params .= '&'.$keys[$i].'='.$vals[$i].',';
			else
			{
				if ( $i == 0 )
					$params .= '?'.$keys[$i].'='.$vals[$i].',';
				else
					$params .= '&'.$keys[$i].'='.$vals[$i].',';
			}
		}

		$paramsArr = explode(',', $params);
		$paramsArr = array_filter($paramsArr);

		return $paramsArr;
	}

	public static function assocArrayToIndexed($assoc)
	{
		if ( !isset($assoc) )
			return null;

		$keys = array_keys($assoc);
		$vals = array_values($assoc);
		$arr = [];
		$str = '';
		for ($i=0; $i < sizeof($keys); $i++) 
		{ 
			$str .= $keys[$i].','.$vals[$i];
		}

		$arr = explode(',', $str);
		$arr = array_filter($arr);
		return $arr;
	}

}
