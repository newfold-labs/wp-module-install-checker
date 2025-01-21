<?php

namespace NewfoldLabs\WP\Module\InstallChecker;

/**
 * @coversDefaultClass \NewfoldLabs\WP\Module\InstallChecker\InstallChecker
 */
class InstallCheckerWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {
	
	/**
	 * @return void
	 */
	protected function setUp(): void {
		parent::setUp();
		global $wpdb;
		if ( ! get_post(1) ) {
			$wpdb->insert(
				$wpdb->posts,
				array(
					'ID'         => 1,
					'post_title' => 'Post 1',
				)
			);
		}
	}
	
	/**
	 * @return void
	 */
	public function test_is_fresh_installation() :void
	{
		$install_checker = new InstallChecker();
		
		$val = $install_checker->isFreshInstallation();
		
		self::assertTrue( $val, 'is not a fresh installation');
	}
	
	public function test_is_not_a_fresh_installation() :void
	{
		self::factory()->post->create( array(
			'post_title'   => 'Mock Post Title',
			'post_content' => 'This is a mock post content.',
		) );
		
		$install_checker = new InstallChecker();
		
		$val = $install_checker->isFreshInstallation();
		
		self::assertFalse( $val, 'is a fresh installation');
	}
	
	/**
	 * @return void
	 */
	public function tearDown(): void
	{
		parent::tearDown();
	}
	
}
