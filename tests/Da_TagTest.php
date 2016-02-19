<?php
/**
 * Tests for the Da Tag class.
 *
 * @package datag
 */


namespace notne\Test;

require_once( dirname(__FILE__) . '/../vendor/autoload.php');
require_once( dirname(__FILE__) . '/../class/Da_Tag.php');

class Da_TagTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Set up and tear down 10up's awesome WP_Mock project
	 */
	public function setUp() {
		\WP_Mock::setUp();
	}

	public function tearDown() {
		\WP_Mock::tearDown();
	}

	/**
	 * Test that the actions are successfully added.
	 */
	public function test_init(){
		$this->dt = new \notne\Da_Tag\Da_Tag( dirname(__FILE__) . '/../' );

		\WP_Mock::expectActionAdded( 'admin_notices', array( $this->dt, 'admin_notices' ), 10, 1 );
		\WP_Mock::expectActionAdded( 'admin_init', array( $this->dt, 'admin_notices_ignore' ) );
		\WP_Mock::expectActionAdded( 'save_post', array( $this->dt, 'save_highlighted_tag' ), 10, 3 );
		\WP_Mock::expectActionAdded( 'admin_enqueue_scripts', array( $this->dt, 'enqueues' ) );
		\WP_Mock::expectFilterAdded( 'post_submitbox_misc_actions', array( $this->dt, 'highlight_tag' ) );

		$this->dt->init();
	}

}