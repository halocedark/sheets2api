<?php  

namespace GoogleSheets2API\Sheets2APIException;

class Sheets2APIException extends \Exception
{
	public const ERR_CODE_INVALID_SHEET_NAME = 0;
	public const ERR_CODE_INVALID_API_ID = 1;

	public const ERR_INVALID_SHEET_NAME = 'INVALID_SHEET_NAME';
	public const ERR_INVALID_API_ID = 'INVALID_API_ID';
	// Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Throwable $previous = null) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}

