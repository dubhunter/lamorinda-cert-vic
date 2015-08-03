<?php

use Talon\Mvc\View\Engine\Volt\FilterCollection;

class VoltFilters extends FilterCollection {

	/**
	 * @param int|string $timestamp
	 * @param string $format
	 * @return bool|string
	 */
	public static function date($timestamp, $format) {
		if (!$timestamp) {
			return null;
		}
		if (is_string($timestamp)) {
			$timestamp = strtotime($timestamp);
		}
		return date($format, $timestamp);
	}

	/**
	 * @param string $number
	 * @return null|string
	 */
	public static function phone($number) {
		return $number ? LibPhoneNumber::formatLocalized($number) : null;
	}

	/**
	 * @param $input
	 * @param $length
	 * @param string $string
	 * @return string
	 */
	public static function padLeft($input, $length, $string = " ") {
		return str_pad($input, $length, $string, STR_PAD_LEFT);
	}

	/**
	 * @param $input
	 * @param $length
	 * @param string $string
	 * @return string
	 */
	public static function padRight($input, $length, $string = " ") {
		return str_pad($input, $length, $string, STR_PAD_RIGHT);
	}
}