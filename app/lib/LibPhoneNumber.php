<?php

use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

class LibPhoneNumber {

	const DEFAULT_REGION = 'US';

	/**
	 * @param string|PhoneNumber $number
	 * @param string $defaultRegion
	 * @return PhoneNumber
	 */
	protected static function getNumberProto($number, $defaultRegion = self::DEFAULT_REGION) {
		if ($number instanceof PhoneNumber) {
			return $number;
		}

		$util = PhoneNumberUtil::getInstance();
		$region = strpos($number, '+') === false ? $defaultRegion : 'ZZ';
		return $util->parse($number, $region);
	}

	/**
	 * @param string|PhoneNumber $number
	 * @param string $defaultRegion
	 * @return string
	 */
	public static function formatE164($number, $defaultRegion = self::DEFAULT_REGION) {
		$util = PhoneNumberUtil::getInstance();
		$proto = self::getNumberProto($number, $defaultRegion);
		return $util->format($proto, PhoneNumberFormat::E164);
	}

	/**
	 * @param string|PhoneNumber $number
	 * @param string $defaultRegion
	 * @return string
	 */
	public static function formatNational($number, $defaultRegion = self::DEFAULT_REGION) {
		$util = PhoneNumberUtil::getInstance();
		$proto = self::getNumberProto($number, $defaultRegion);
		return $util->format($proto, PhoneNumberFormat::NATIONAL);
	}

	/**
	 * @param string|PhoneNumber $number
	 * @param string $defaultRegion
	 * @return string
	 */
	public static function formatInternational($number, $defaultRegion = self::DEFAULT_REGION) {
		$util = PhoneNumberUtil::getInstance();
		$proto = self::getNumberProto($number, $defaultRegion);
		return $util->format($proto, PhoneNumberFormat::INTERNATIONAL);
	}

	/**
	 * @param string|PhoneNumber $number
	 * @param string $region
	 * @return string
	 */
	public static function formatLocalized($number, $region = self::DEFAULT_REGION) {
		$util = PhoneNumberUtil::getInstance();
		$proto = self::getNumberProto($number, $region);
		return $util->getRegionCodeForNumber($proto) == $region ? self::formatNational($proto) : self::formatInternational($proto);
	}

}