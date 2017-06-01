<?php

namespace GingerPayments\AddressBook;

final class Validation {
	
	/**
     * @param string $value Value to be checked.
     * @param string $message Error message.
     * @param integer $code Error message code number.
     * @return Group
    */
	public static function notValid($value, $message = null, $code = 0) {
		if(empty($value) || $value == '0' || $value == false || is_null($value) || is_string($value) && trim($value) === '') {
			$message = $message ?: sprintf("%s value is not valid.", strval($value));
			throw new \InvalidArgumentException($message, $code);
		}
		return false;
	}
	
}