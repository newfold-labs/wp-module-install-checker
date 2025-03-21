<?php

namespace NewfoldLabs\WP\Module\InstallChecker;

/**
 * @coversDefaultClass \NewfoldLabs\WP\Module\InstallChecker\WooCommerce
 */
class WooCommerceWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {
	
	/**
	 * @return void
	 */
	protected function setUp(): void {
		parent::setUp();
	}
	
	/**
	 * @return void
	 */
	public function test_is_woocommerce() :void
	{
		$wooclass   = WooCommerce::class;
		$this->assertTrue( $wooclass::isWooCommerce(), 'WooCommerce is not enabled');
		
	}
	/**
	 * @return void
	 */
	public function test_get_all_pages_ids() :void {
		
		$pages = [
			'shop',
			'cart',
			'checkout',
			'myaccount',
			'refund_returns',
		];
		foreach ( $pages as $page_slug ) {
			$page_id = wc_get_page_id( $page_slug );
			$this->assertGreaterThanOrEqual(1, $page_id, $page_slug . ' is not a correct PageID');
		}
	}
}