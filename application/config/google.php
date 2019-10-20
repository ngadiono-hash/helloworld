<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '1009276750357-uu9l4hbkpik1t6f4d61t5urh83ta3s47.apps.googleusercontent.com';
$config['google']['client_secret']    = '7u2b1gynGfxAXtb8b9WodDyu';
$config['google']['redirect_uri']     = 'http://localhost/at/haha';
$config['google']['application_name'] = 'Login di Helo World dengan Google';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();