<?php

use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;

class SiteController extends BaseController {

	public function	initialize() {
		$this->assets->setOptions(array(
			'sourceBasePath' => APP_DIR . 'assets/',
			'targetBasePath' => PUBLIC_DIR
		));

		$this->assets
			->collection('css')
			->setSourcePath('css/')
			->setTargetPath('css/core.css')
			->setTargetUri('css/core.css')
			->addCss('bootstrap.css')
//			->addCss('bootstrap-spacelab.css')
			->addCss('bootstrap-responsive.css')
			->addCss('font-awesome.css')
			->addCss('app.css')
			->join(true)
			->addFilter(new Cssmin());

		$this->assets
			->collection('js')
			->setSourcePath('js/')
			->setTargetPath('js/core.js')
			->setTargetUri('js/core.js')
			->addJs('jquery-1.10.2.min.js')
			->addJs('jquery.role.js')
			->addJs('bootstrap-transition.js')
			->addJs('bootstrap-alert.js')
			->addJs('bootstrap-button.js')
			->addJs('bootstrap-collapse.js')
			->addJs('bootstrap-dropdown.js')
			->addJs('bootstrap-modal.js')
			->addJs('bootstrap-tooltip.js')
			->addJs('bootstrap-file-input.js')
			->addJs('bootstrap-init.js')
			->addJs('alert.js')
			->addJs('behaviors.js')
			->addJs('form.js')
			->addJs('rest.js')
			->join(true)
			->addFilter(new Jsmin());
	}

}