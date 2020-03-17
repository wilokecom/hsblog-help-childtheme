<?php

namespace TikiDocsChild\Controllers;


use Redux;
use TikiDocsChild\Helpers\App;

class ThemeOptionController extends Controller
{
    public function __construct()
    {
        add_action('tikidocs/redux-framework/config', [$this, 'registerForumSettings'], 10);
    }

    public function registerForumSettings($opt_name)
    {
        Redux::setSection($opt_name, App::get('app')['themeoptions']['bbsettings']['section']);

        foreach (App::get('app')['themeoptions']['bbsettings']['subSection'] as $aSubSection) {
            Redux::setSection($opt_name, $aSubSection);
        }
    }
}
