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
}