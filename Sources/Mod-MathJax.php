<?php
/**
 * @package SMF MathJax Mod
 * @author digger <http://mysmf.net>
 * @copyright 2011—2018
 * @license GPLv3
 * @file Mod-MathJax.php
 * @version 1.4.2
 */

if (!defined('SMF')) {
    die('Hacking attempt...');
}


/**
 * Load all needed hooks
 */
function loadMathJaxHooks()
{
    add_integration_function('integrate_load_theme', 'loadMathJaxJs', false);
    add_integration_function('integrate_bbc_buttons', 'addMathJaxBbcButton', false);
    add_integration_function('integrate_bbc_codes', 'addMathJaxBbcCode', false);
    add_integration_function('integrate_menu_buttons', 'addMathJaxCopyright', false);
}


/**
 * Load JS libraries
 */
function loadMathJaxJs()
{
    global $context;

    $context['insert_after_template'] .= '
      <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=default,Safe"></script>';
}


/**
 * Add editor buttons
 * @param $buttons
 */
function addMathJaxBbcButton(&$buttons)
{
    $buttons[1][] = array(
        'image' => 'latex',
        'code' => 'latex',
        'before' => '[latex]',
        'after' => '[/latex]',
        'description' => 'LaTex',
    );

    $buttons[1][] = array(
        'image' => 'latex_inline',
        'code' => 'latex_inline',
        'before' => '[latex=inline]',
        'after' => '[/latex]',
        'description' => 'LaTex inline',
    );
}


/**
 * Add latex bbc
 * @param $codes
 */
function addMathJaxBbcCode(&$codes)
{
    $codes[] = array(
        'tag' => 'latex',
        'type' => 'unparsed_content',
        'content' => '\[ $1 \]',
    );

    $codes[] = array(
        'tag' => 'latex',
        'type' => 'unparsed_equals_content',
        'content' => '\( $1 \)',
    );
}


/**
 * Adds mod copyright to the forum credit's page
 */
function addMathjaxCopyright()
{
    global $context;

    if ($context['current_action'] == 'credits') {
        $context['copyrights']['mods'][] = '<a href="http://mysmf.net/mods/mathjax" title="SMF MathJax Mod" target="_blank">MathJax for SMF</a> &copy; 2011—2018, digger | <a href="http://www.mathjax.org" title="Powered by MathJax" target="_blank">Powered by MathJax</a>';
    }
}
