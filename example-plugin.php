<?php
/**
 * Example plugin
 *
 * @package 	Example Plugin
 * @author		
 * @copyright 	Copyright (c) 2012 - 2014, 
 * @link			http://www
 * @license		http://www.opensource.org/licenses/gpl-3.0.php GPL License
 * @since 		1.0.0
 *
 * Plugin Name: Example Plugin
 * Plugin URI: 
 * Description: .................................
 * Version: 1.0.0
 * License: 	GPL3
 *
 * This script is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Example_Plugin' ) ) :
	/**
	 * Main Example_Plugin Instance
	 *
	 * @package Example_Plugin
	 * @since 1.0.0
	 */
	class Example_Plugin {
	   
	   /**
		 * @var string Post ID of the view.
		 */
		var $id;
		/**
		 * @var array Contains the view content query.
		 */
		/**
		 * @var array Meta Options Array
		 */
		var $options;

		/**
		 * @var Example_Plugin Stores the instance of this class.
		 */
		private static $instance;

		/**
		 * Example_Plugin Instance
		 *
		 * Makes sure that there is only ever one instance of the HW Builder
		 *
		 * @since 1.0.0
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) ) {

				self::$instance = new Example_Plugin;
				self::$instance->setup_globals();
				self::$instance->includes();

			}

			return self::$instance;

	   }
	    
		/**
		* A dummy constructor to prevent loading more than once.
		* @since 	1.0.0
	 	* @see 	Example_Plugin::instance()
		*/
		private function __construct() { 
			// Do nothing here
		}

		/**
		 * A dummy magic method to prevent Example_Plugin from being cloned
		 */
		public function __clone() { wp_die( __( 'Cheatinâ€™ uh?' ) ); }

		/**
		 * A dummy magic method to prevent Example_Plugin from being unserialized
		 */
		public function __wakeup() { wp_die( __( 'Cheatinâ€™ uh?' ) ); }

		/**
		 * Setup Globals
		 *
		 * @package Example_Plugin
		 * @since 1.0.0
		 */
		private function setup_globals() {

			$this->file       = __FILE__;
			$this->basename   = plugin_basename( $this->file );
			$this->folder	   = dirname( $this->basename );
			$this->plugin_dir = plugin_dir_path( $this->file );
			$this->plugin_url = plugin_dir_url ( $this->file );

			return $this;

		}

		/**
		 * Load Includes
		 *
		 * @package Example_Plugin
		 * @since 1.0.0
		 */
		private function includes() {

			require( $this->plugin_dir . 'includes/functions.php' );

			/* Include Fluent and Custom meta and post type */
			require_once( $this->plugin_dir . 'includes/fluent-framework/fluent-framework.php' );

			require_once( $this->plugin_dir .'includes/meta-options.php' );

		}

	} //end class

	/**
	 * Return the class instance with a function and call it on the init add_action
	 */
	function example_plugin() {
	   return Example_Plugin::instance();
	}

	add_action ( 'plugins_loaded', 'example_plugin', 1 );

endif;

