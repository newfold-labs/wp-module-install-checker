<?php

namespace NewfoldLabs\WP\Module\InstallChecker;

/**
 * @coversDefaultClass \NewfoldLabs\WP\Module\InstallChecker\InstallChecker
 */
class InstallCheckerWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {
	
	/**
	 * @return void
	 */
	public function test_is_fresh_installation() :void
	{
		if( ! get_post(1) ) {
			global $wpdb;
			$wpdb->insert(
				$wpdb->posts,
				array(
					'ID'         => 1,
					'post_title' => 'Post 1',
				)
			);
		}
		
		$fresh = new InstallChecker();
		
		
		$this->assertTrue( $fresh->isFreshInstallation() );
	}
	
	public function test_is_not_a_fresh_installation_by_post() :void
	{
		if( ! get_post(1) ) {
			global $wpdb;
			$wpdb->insert(
				$wpdb->posts,
				array(
					'ID'         => 1,
					'post_title' => 'Post 1',
				)
			);
		}
		
		self::factory()->post->create(
			array(
				'post_title'   => 'Mock Post Title',
				'post_content' => 'This is a mock post content.',
			)
		);
		$fresh = new InstallChecker();
		
		$this->assertFalse( $fresh->isFreshInstallation() );
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
		
		$this->assertFalse( $fresh->isFreshInstallation() );
	}
}
