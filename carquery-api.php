<?php
/*
Plugin Name: Official CarQuery API Wordpress Plugin
Plugin URI: http://www.carqueryapi.com/demo/wordpress-plugin/
Description: The CarQuery API plugin easily creates dependent vehicle year, make, model, and trim dropdowns.
Version: 1.1
Author: CarQueryAPI
Author URI: http://www.carqueryapi.com
License: GPL2

Copyright 2012 CarQueryAPI  (email : dan@carqueryapi.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

Class CarQueryAPI{

	static $add_script;

	static function init() {

		//Register ShortCodes
		add_shortcode("cq-year", 	array(__CLASS__, 'cq_year' ));
		add_shortcode("cq-make", 	array(__CLASS__, 'cq_make' ));
		add_shortcode("cq-model", 	array(__CLASS__, 'cq_model'));
		add_shortcode("cq-trim", 	array(__CLASS__, 'cq_trim' ));

		//Load javascript in wp_footer
		add_action('init', 		array(__CLASS__, 'register_script' ));
		add_action('wp_footer', array(__CLASS__, 'print_script' ));
	}


	//Return HTML for year drop down
	static function cq_year() {

		//Trigger javascript scripts to load
		self::$add_script = true;

	 	return '<select name="cq-year" id="cq-year"></select>';
	}


	//Return HTML for makes dropdown
	static function cq_make() {

		//Trigger javascript scripts to load
		self::$add_script = true;

		return '<select name="cq-make" id="cq-make"></select>';
	}


	//Return HTML for models drop down
	static function cq_model() {

		//Trigger javascript scripts to load
		self::$add_script = true;

		return '<select name="cq-model" id="cq-model"></select>';
	}


	//Return HTML for trims dropdown
	static function cq_trim() {

		//Trigger javascript scripts to load
		self::$add_script = true;

		return '<select name="cq-trim" id="cq-trim"></select>';
	}


	//Include necessary javascript files
	static function register_script() {

		wp_register_script('carquery-api-js', 'http://www.carqueryapi.com/js/carquery.0.2.4.js', array('jquery'), '0.2.4', true);

	}


	//check if the short codes were used, print js if required
	static function print_script() {

		//Only load javascript if the short code events were triggered
		if ( ! self::$add_script )
			return;

		wp_print_scripts('carquery-api-js');

		//initialize the carquery objects
		self::carquery_init();
	}


	//Output required carquery javascript to footer.
	static function carquery_init()
	{
		?>

		<script type='text/javascript'>

			carquery.init();

			carquery.initYearMakeModelTrim('cq-year', 'cq-make', 'cq-model', 'cq-trim');

	    </script>

	    <?php
	}

}

CarQueryAPI::init();

?>