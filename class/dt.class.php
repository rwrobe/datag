<?php
/**
 * The Da Tag class
 *
 * @version 1.0
 * @author  Rob Ward
 * @package datag
 * @since   0.2
 */

namespace notne\Da_Tag;

class Da_Tag {

	/** Class Vars */
	/** @var string $localizationDomain Translation domain */
	private $localizationDomain = 'datag';
	/** @var string $thispluginurl      For the URL of the plugin (set in constructor) */
	private $thispluginurl 		= '';

	public function __construct( $thispluginurl ) {

		$this->thispluginurl  = DT_PLUGIN_URL;

		/** Add Actions and Filters */
		// Admin Notices
		add_action( 'admin_notices', array( &$this, 'admin_notices' ), 10, 1 );
		add_action( 'admin_init', array( &$this, 'admin_notices_ignore' ) );

		add_filter( 'post_submitbox_misc_actions', array( &$this, 'highlight_tag' ) );
		add_action( 'save_post', array( &$this, 'save_highlighted_tag' ), 10, 3 );
		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueues' ) );

	}

	/**
	 * Enqueue the necessary javascript on the editor page only
	 *
	 * @since 0.3
	 * @param string $hook  Editor page being accessed
	 */
	public function enqueues( $hook ){


		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'datag_functions', $this->thispluginurl . 'js/dt_functions.js', array( 'jquery', 'jquery-ui-droppable' ), '1.0', true );

		wp_enqueue_style( 'datag-style', $this->thispluginurl . 'css/datag.css' );

	}

	/**
	 * Add a hidden field to the publish box to hold the meta value for the highlighted tag.
	 *
	 * @since 0.3
	 * @param string $content Post content
	 *
	 * @return string $content
	 */
	public function highlight_tag( $content ) {

		global $post;

		wp_nonce_field( basename( __FILE__ ), 'ht_nonce' );
		$highlight_tag = get_post_meta( $post->ID, '_datag_highlighted_tag', true );
		?>

		<input type="hidden" name="highlight_tag" id="highlight-tag" value="<?php echo isset ( $highlight_tag ) ? esc_attr( $highlight_tag ) : ''; ?>" />

		<?php
	}

	/**
	 * Sanitize and save the highlighted tag meta
	 *
	 * @since 0.3
	 * @param int $post_id
	 * @param object $post
	 */
	public function save_highlighted_tag( $post_id ) {

		/** Check save status */
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'ht_nonce' ] ) && wp_verify_nonce( $_POST[ 'ht_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

		/** Bail if any of the above are true (or false, for the nonce) */
		if ( $is_autosave || $is_revision || ! $is_valid_nonce )
			return;

		// Checks for input and sanitizes/saves if needed
		if( isset( $_POST[ 'highlight_tag' ] ) )
			update_post_meta( $post_id, '_datag_highlighted_tag', sanitize_text_field( $_POST['highlight_tag'] ) );

	}

	/**
	 * Add a notification to the admin area to let user know when/why the plugin was deactivated due to unsupported themes
	 *
	 * @since 0.4
	 */
	public function admin_notices(){

		global $current_user;
		$uid = $current_user->ID;

		/** If the meta isn't there, they must like the notice. That makes me feel happy. */
		if ( ! get_user_meta( $uid, 'thanks_but_no_thanks') ) {

			$notice = __('Hey there, thanks for taking a look at my highlighted tag plugin! Please let me know if you have any questions: <a href="mailto:rwrobe@gmail.com">rwrobe@gmail.com</a>', $this->localizationDomain);

			printf('<div class="updated"><p>%1$s <br /><br /> <a href="%2$s">Got it, thanks.</a></p></div>',
				wp_kses_post($notice),
				'?thanks_but_no_thanks=0'
			);

		}

	} // admin_notices()

	/**
	 * Allows you to dismiss the admin notice
	 *
	 * @since 0.4
	 */
	public function admin_notices_ignore() {

		global $current_user;
		$uid = $current_user->ID;

		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset( $_GET['thanks_but_no_thanks'] ) && '0' == $_GET['thanks_but_no_thanks'] )
			add_user_meta( $uid, 'thanks_but_no_thanks', 1, true );

	}

	/**
	 * Bring back the admin notice when the plugin is deactivated and reactivated.
	 *
	 * @since 0.4
	 */
	public static function prodigal_admin_notices(){

		global $current_user;
		$uid = $current_user->ID;

		delete_user_meta( $uid, 'thanks_but_no_thanks' );

	}
}

$dt = new Da_Tag();