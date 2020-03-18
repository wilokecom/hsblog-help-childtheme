<?php

namespace TikiDocsChild\Controllers;


class RegisterLoginController extends Controller
{
    public function __construct()
    {
        add_action('tikidocs/bbpress/after/form-user-login', [$this, 'printEvantoLoginBtn']);
        add_action('tikidocs/bbpress/after/form-user-register', [$this, 'printEvantoLoginBtn']);
    }

    public function printEvantoLoginBtn()
    {

        if (is_user_logged_in()) {
            return '';
        }

        echo do_shortcode('[wiloke_login_evanto_login]');
    }
}
