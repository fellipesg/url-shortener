<?php
/**
* Write a function that validates a Universal Product Code (UPC).
*
* UPC codes are always 12 numeric digits.
*
* The final digit of a UPC is a check digit computed as follows:
*
* 1. Add the digits in the odd-numbered positions from the right (first, third, fifth, etc. - notincluding the check digit) together and multiply by three.
* 2. Add the digits (up to but not including the check digit) in the even-numbered positions (second, fourth, sixth, etc.) to the result.
* 3. Take the remainder of the result divided by 10 (ie. the modulo 10 operation). If the remainder is equal to 0 then use 0 as the check digit, and if not 0 subtract the remainder from 10 to derive the check
digit.
*
* Example 1:
* - Input: 012345678905
* - Output: true
*
* Example 2:
* - Input: 01234567a905
* - Output: false
*
* Example 3:
* - Input: 036000241457
* - Output: true
*
* Example 4:
* - Input: 01
* - Output: false
*
* Example 5:
* - Input: 010101010105
* - Output: true
*
* @param string $upc
*
* @return bool
*/

function isValid(string $upc): bool
{
	
	if (strlen($upc) != 12) {
		return false;
	} 
	
	if(!is_numeric($upc))
		return false;
	
	$digits = str_split($upc);
	
	
	$sum = 0;
	
	for($i = 0; $i < 12; $i+=2)
	{
		$sum += $digits[$i];
	}
	
	$sum *= 3;
	
	
	for($i = 1; $i<11; $i+=2)
	{
		$sum += $digits[$i];
	}
	
	$remainder = $sum % 10;
	
	$checkDigit = $remainder == 0 ? 0 : 10 - $remainder;
	
	
	return $checkDigit == $digits[11];
}

var_dump(isValid("012345678905"));
var_dump(isValid("01234567a905"));
var_dump(isValid("036000241457"));
var_dump(isValid("01"));
var_dump(isValid("010101010105"));