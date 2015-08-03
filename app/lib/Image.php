<?php

use Phalcon\Image\Exception;

class Image extends \Phalcon\Image\Adapter\Gd {

	/**
	 * @param string $file
	 * @param int $width
	 * @param int $height
	 * @throws Exception
	 */
	public function __construct($file, $width = null, $height = null) {
		if (!$file || @file_exists($file)) {
			parent::__construct($file, $width, $height);
		} else {
			$this->_image = imagecreatefromstring($file);

			if (!$this->_image) {
				throw new Exception('Failed to create image from data string');
			}

			$info = getimagesizefromstring($file);

			if ($info) {
				$this->_width = $info[0];
				$this->_height = $info[1];
				$this->_type = $info[2];
				$this->_mime = $info['mime'];

				if (!$this->_mime) {
					throw new Exception('Installed GD does not support these images');
				}
			}

			imagesavealpha($this->_image, true);
		}
	}

}