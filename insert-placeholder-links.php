<?php
/*
 * Plugin Name: Insert Placeholder Links
 * Plugin URI: trepmal.com
 * Description:
 * Version:
 * Author: Kailey Lampert
 * Author URI: kaileylampert.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * TextDomain: ipl
 * DomainPath:
 * Network:
 */


$insert_placeholder_links = new Insert_Placeholder_Links();

class Insert_Placeholder_Links {

	/**
	 *
	 */
	function __construct() {
		add_action( 'admin_init',                 array( $this, 'admin_init' ) );
		add_action( 'admin_footer-nav-menus.php', array( $this, 'admin_footer' ) );
	}

	/**
	 *
	 */
	function admin_init() {
		add_meta_box( 'ipl', __( 'Placeholder Links', 'ipl' ), array( $this, 'add_meta_box' ), 'nav-menus', 'side', 'low' );
	}

	/**
	 *
	 */
	function add_meta_box() {
		printf( __( 'Insert %s Links', 'ipl' ), '<input type="number" id="number-of-links" class="small-text" value="5" />' );
		?>
		<p class="button-controls">
			<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to Menu', 'ipl' ); ?>" name="add-placeholder-menu-item" id="submit-placeholder-links" />
				<span class="spinner"></span>
			</span>
		</p><?php
	}

	/**
	 *
	 */
	function admin_footer() {
		// We don't use a for loop because then things happen
		// asyncronously and our numbered links don't appear in order
		?><script>
		jQuery('#submit-placeholder-links').click( function(ev) {
			ev.preventDefault();
			var max = jQuery('#number-of-links').val();
			insertPlaceholderLink(1);
			function insertPlaceholderLink( i ) {
				var i;
				wpNavMenu.addLinkToMenu( '#', 'Link '+i, wpNavMenu.addMenuItemToBottom, function() {
					if ( i < max ) {
						insertPlaceholderLink( i+1 );
					}
				} );
			}
		});
		</script><?php
	}
}
