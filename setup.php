<?php

/**
 * -------------------------------------------------------------------------
 * reauthdemo plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * Minimal example plugin providing an additional re-authentication strategy.
 *
 * @license   GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
 * -------------------------------------------------------------------------
 */

use Glpi\Security\ReAuth\ReAuthManager;
use GlpiPlugin\Reauthdemo\ReAuthProvider;

define('PLUGIN_REAUTHDEMO_VERSION', '1.0.0');

// Minimal GLPI version, inclusive
define('PLUGIN_REAUTHDEMO_MIN_GLPI', '11.0.0');
// Maximum GLPI version, exclusive
define('PLUGIN_REAUTHDEMO_MAX_GLPI', '12.0.99');

/**
 * Init hook. The core registers the PSR-4 autoloader
 * (GlpiPlugin\Reauthdemo\ => src/) automatically, so nothing to declare here.
 */
function plugin_init_reauthdemo()
{
    if (Plugin::isPluginActive('reauthdemo')) {
        // No hooks required for this minimal plugin.
    }
}

/**
 * Boot hook. Register the plugin's re-authentication strategy on the singleton
 * ReAuthManager, the same way marketplace/oauthsso does.
 */
function plugin_reauthdemo_boot()
{
    ReAuthManager::getInstance()->registerStrategy(new ReAuthProvider());
}

function plugin_reauthdemo_check_prerequisites()
{
    return true;
}

function plugin_reauthdemo_install()
{
    return true;
}

function plugin_reauthdemo_uninstall()
{
    return true;
}

function plugin_version_reauthdemo()
{
    return [
        'name'         => 'ReAuth Demo',
        'version'      => PLUGIN_REAUTHDEMO_VERSION,
        'author'       => "Teclib'",
        'license'      => 'GPL v3+',
        'homepage'     => 'https://www.teclib.com',
        'requirements' => [
            'glpi' => [
                'min' => PLUGIN_REAUTHDEMO_MIN_GLPI,
                'max' => PLUGIN_REAUTHDEMO_MAX_GLPI,
            ],
        ],
    ];
}
