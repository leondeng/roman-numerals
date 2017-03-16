<?php

namespace Larowlan\RomanNumeral;

/**
 * Defines a class for generating roman numerals from integers.
 */
class RomanNumeralGenerator {

  const ROMAN_SYMBOLS = [
    1 => 'I',
    5 => 'V',
    10 => 'X',
    50 => 'L',
    100 => 'C',
    500 => 'D',
    1000 => 'M',
  ];

  /**
   * Generates a roman numeral from an integer.
   *
   * @param int $number
   *   Integer to convert.
   * @param bool $lowerCase
   *   (optional) Pass TRUE to convert to lowercase. Defaults to FALSE.
   *
   * @return string
   *   Roman numeral representing the passed integer.
   */
  public function generate(int $number, bool $lowerCase = FALSE) : string {
    // check input
    if ($number < 1) {
      return "No corresponding expression in Roman numeral for $number.";
    }

    $digits = $this->makeDigits($number);

    $romanNumber = '';

    foreach ($digits as $pow => $digit) {
      $romanNumber = $this->transfer($pow, (int) $digit) . $romanNumber;
    }

    return $lowerCase ? strtolower($romanNumber) : $romanNumber;
  }

  /**
   * transfer number into reversed string array
   * example: 1234 => ['4', '3', '2', '1']
   * 
   * @param  int    $number 
   * @return array[string]
   */
  private function makeDigits(int $number) : array {
    return array_reverse(str_split((string) $number));
  }

  /**
   * transfer alg based on power and digit
   * 
   * @param  int    $pow
   *     power of 10
   * @param  int    $digit
   *     number below 10
   * @return string
   *     result string
   */
  private function transfer(int $pow, int $digit) : string {
    $symbols = array_slice(self::ROMAN_SYMBOLS, $pow * 2, 3); //slice symbols against pow

    switch (true) {
      case ($digit === 9):
        return $symbols[0] . $symbols[2];

      case ($digit < 9 && $digit >= 5):
        $ret = $symbols[1];
        while ($digit-- > 5) {
          $ret .= $symbols[0];
        }
        return $ret;

      case ($digit === 4):
        return $symbols[0] . $symbols[1];

      default:
        $ret = '';
        while ($digit-- > 0) {
          $ret .= $symbols[0];
        }
        return $ret;
    }
  }

}
