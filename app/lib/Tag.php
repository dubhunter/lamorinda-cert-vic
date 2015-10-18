<?php

class Tag extends Phalcon\Tag {

	public static function stylesheetLinkMediaAll($parameters = array(), $local = true) {
		$parameters['media'] = 'all';
		return parent::stylesheetLink($parameters, $local);
	}

}