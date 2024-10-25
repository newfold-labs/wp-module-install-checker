<?php

use NewfoldLabs\WP\Module\InstallChecker\InstallChecker;
use NewfoldLabs\WP\ModuleLoader\Container;

if ( function_exists( 'add_action' ) ) {
	add_action(
		'newfold_container_set',
		function ( Container $container ) {

			$container->set(
				'installChecker',
				$container->service(
					function () {
						return new InstallChecker();
					}
				)
			);

			$container->set(
				'installationDate',
				$container->computed(
					function ( Container $container ) {
						return $container->get( 'installChecker' )->getInstallationDate();
					}
				)
			);

			add_action('plugins_loaded', function() use ($container) {
				$container->set(
					'isFreshInstallation',
					$container->computed(
						function ( Container $container ) {
							return $container->get( 'installChecker' )->isFreshInstallation();
						}
					)
				);
			});

		},
		0
	);

}