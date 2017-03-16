<?php

namespace Larowlan\RomanNumeral;

/**
 * Defines a class for generating roman numerals from integers.
 */
class RomanNumeralGenerator {

  const PART_MAP = [
    1 => 'Bit',
    10 => 'Ten',
    100 => 'Hundred',
    1000 => 'Thousand',
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
    if ($number < 1 || $number > 3999) {
      return "Not support $number yet.";
    }

    $digit_array = $this->makeDigitArray($number); var_dump($digit_array);

    $roman_number = '';

    foreach ($digit_array as $index => $digit) {
      $part = self::PART_MAP[pow(10, $index)];
      $method = "make${part}Part";
      if (method_exists($this, $method)) {
        $roman_number = $this->{$method}((int) $digit) . $roman_number;
      }
      
    }

    return $roman_number;
  }

  private function makeDigitArray(int $number) : array {
    return array_reverse(str_split((string) $number));
  }

  private function makeBitPart(int $digit) {
    return '1';
  }

  private function makeTenPart(int $digit) {
    return '2';
  }

  private function makeHundredPart(int $digit) {
    return '3';
  }

  private function makeThousandPart(int $digit) {
    return '4';
  }

}
