<?php

namespace NewfoldLabs\WP\Module\InstallChecker;

use Mockery;

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
		$wooclass   = Mockery::mock( WooCommerce::class );
		$wooclass->shouldReceive('isWooCommerce')->once()->andReturn(true);
		
		self::assertTrue( $wooclass::isWooCommerce(), 'WooCommerce is not enabled');
	}
	
	/**
	 * @return void
	 */
	public function test_is_not_woocommerce() :void
	{
		$wooclass   = Mockery::mock( WooCommerce::class );
		$wooclass->shouldReceive('isWooCommerce')->once()->andReturn(false);
		
		self::assertFalse( $wooclass::isWooCommerce(), 'WooCommerce is enabled');
		
	}
	/**
	 * @return void
	 */
	public function test_get_all_pages_ids() :void {
		
		$wooclass   = Mockery::mock( WooCommerce::class );
		$wooclass->shouldReceive('getAllPageIds')->once()->andReturn( array( 1, 2, 3, 4 ) );
		
		$pages_ids = $wooclass::getAllPageIds();
		self::assertEquals( array( 1, 2, 3, 4) , $pages_ids );
		
	}
	
	/**
	 * @return void
	 */
	public function tearDown(): void
	{
		Mockery::close();
		parent::tearDown();
	}
	
}
