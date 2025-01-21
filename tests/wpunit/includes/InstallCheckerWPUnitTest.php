<?php

namespace NewfoldLabs\WP\Module\InstallChecker;

use Mockery;

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
		if( ! get_post(1) ) {
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
		$fresh = new InstallChecker();
		
		
		self::assertTrue( $fresh->isFreshInstallation() );
	}
	
	public function test_is_not_a_fresh_installation_by_post() :void
	{
		self::factory()->post->create(
			array(
				'post_title'   => 'Mock Post Title',
				'post_content' => 'This is a mock post content.',
			)
		);
		$fresh = new InstallChecker();
		
		self::assertFalse( $fresh->isFreshInstallation() );
	}
	
	public function test_is_not_a_fresh_installation_by_users() :void
	{
		self::factory()->user->create( array(
			'user_login'    => 'testuser',
			'user_email'    => 'testuser@example.com',
			'user_pass'     => 'password123',
			'role'          => 'editor',
		) );
		$fresh = new InstallChecker();
		
		self::assertFalse( $fresh->isFreshInstallation() );
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
