<?php
/**
 * Plugin Name: WPGraphQL Custom Logo and Site Icon
 * Plugin URI:  https://devapps.uk
 * Description: Adds custom logo and site icon fields to the WPGraphQL schema.
 * Version:     1.0
 * Author:      Your Name
 * Author URI:  https://devapps.uk
 * License:     GPL-2.0+
 * Text Domain: wpgraphql-logo-icon
 */

// Prevent direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Hook to register custom GraphQL fields.
add_action( 'graphql_register_types', function() {

    // Register customLogo field in GeneralSettings.
    register_graphql_field( 'GeneralSettings', 'customLogo', [
        'type'        => 'String',
        'description' => 'URL of the custom logo',
        'resolve'     => function() {
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            if ( $custom_logo_id ) {
                return wp_get_attachment_image_url( $custom_logo_id, 'full' );
            }
            return null;
        }
    ] );

    // Register siteIcon field in GeneralSettings.
    register_graphql_field( 'GeneralSettings', 'siteIcon', [
        'type'        => 'String',
        'description' => 'URL of the site icon (favicon)',
        'resolve'     => function() {
            $site_icon_id = get_option( 'site_icon' );
            if ( $site_icon_id ) {
                return wp_get_attachment_image_url( $site_icon_id, 'full' );
            }
            return null;
        }
    ] );
} );
