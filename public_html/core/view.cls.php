<?php
	
	/*VIEW CLASS FOR RENDERING
	==========================================*/
	class View {
		
		public function get_admin_tpl( $tpl ) {
			$tplPath = _ADMIN . 'templates/' . $tpl . '.tpl.php';
			if( is_file( $tplPath ) ) {
				return file_get_contents( $tplPath );
			}
			return false;
		}
		
		public function get_default_tpl( $tpl ) {
			$tplPath = _DEFAULT . 'templates/' . $tpl . '.tpl.php';
			if( is_file( $tplPath ) ) {
				return file_get_contents( $tplPath );
			}
			return false;
		}
		
		public function get_mod_tpl( $tpl ) {
			$tplPath = _MODULES . 'templates/' . $tpl . '.tpl.php';
			if( is_file( $tplPath ) ) {
				return file_get_contents( $tplPath );
			}
			return false;
		}
		
		public function get_install_tpl( $tpl ) {
			$tplPath = _INSTALL . 'templates/' . $tpl . '.tpl.php';
			if( is_file( $tplPath ) ) {
				return file_get_contents( $tplPath );
			}
			return false;
		}
		
		public function get_admin_inc( $inc ) {
			$incPath = _ADMIN . 'includes/' . $inc . '.inc.php';
			if( is_file( $incPath ) ) {
				return include $incPath;
			}
			return false;
		}
		
		public function get_default_inc( $inc ) {
			$incPath = _DEFAULT . 'includes/' . $inc . '.inc.php';
			if( is_file( $incPath ) ) {
				return include $incPath;
			}
			return false;
		}
		
		public function get_install_inc( $inc ) {
			$incPath = _INSTALL . 'includes/' . $inc . '.inc.php';
			if( is_file( $incPath ) ) {
				return include $incPath;
			}
			return false;
		}
		
		
	}
?>