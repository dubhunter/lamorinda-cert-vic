<?php

use Talon\FilterCollection;

class Filters extends FilterCollection {

	/**
	 * @param string $value
	 * @return string
	 */
	public static function date($value) {
		return preg_replace('#[^0-9a-f\-/:., ]#i', '', $value);
	}

	/**
	 * @param string $value
	 * @return string
	 */
	public static function time($value) {
		return preg_replace('#[^0-9:]#i', '', $value);
	}
}