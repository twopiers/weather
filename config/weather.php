<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @license		DBAD - http://philsturgeon.co.uk/code/dbad-license
 * @author		Brian Humes
 * @link		  http://twopiers.com
 * @email		  brian@twopiers.com
 * @twitter   twopiers
 * 
 * @file		  autoload.php
 * @version		0.0.2
 * @date		  06/18/2012
 */

/*
|--------------------------------------------------------------------------
| Wunderground.com API Key
|--------------------------------------------------------------------------
|
| Head to http://www.wunderground.com/weather/api/
| and sign up for an API key. Takes 2 minutes. Just do it.
||
*/
<<<<<<< HEAD
$config['api_key'] = 'XXXXXXXXXXXXXXX';
=======
$config['api_key'] = 'XXXXXXXXXXXXXX';
>>>>>>> 5e0c561707e16446d7f9a6a1aecb3c9b34e66640

/*
|--------------------------------------------------------------------------
| Default location
|--------------------------------------------------------------------------
|
| Enter your default location
| 
| Here are some examples:
|
| CA/San_Francisco
| 60290 (U.S. zip code)
| Australia/Sydney
| 37.8,-122.4 (latitude,longitude)
| KJFK (airport code)
| pws:KCASANFR70 (PWS id - Personal Weather Station ID)
| autoip (AutoIP address location)
| autoip.json?geo_ip=38.102.136.138 (Specific IP address location) 
||
*/

$config['default_location'] = 'autoip';

/*
|--------------------------------------------------------------------------
| Default observation
|--------------------------------------------------------------------------
|
| Set the default metric you are looking for. Options are:
|   weather - string: something like 'Mostly Cloudy' in the language you designate
|   temperature_string - string: something like '69.7 F (20.9 C)'
|   temp - float: one decimal place
|   relative_humidity - string: will include percent sign
|   wind_string - string: something like 'Calm' in the language you designate
|   wind_dir - string: something like 'NNW'
|   wind_degrees - int: direction of wind, 0-359
|   dewpoint_string - string: same as temperature\_string, but dewpoint temps
|   dewpoint - int: dewpoint degrees, no decimal places
|   heatindex_string - string: same as temperature\_string, but heatindex temps
|   heatindex - usually a int, but if NA, then a string
|   windchill_string - string: same as temperature\_string, but windchill temps
|   windchill - usually a int, but if NA, then a string
|   wind - string: wind speed with one decimal place
|   wind_gust - string: wind gust speed with one decimal place
|   pressure - string: number in milibars or inches, depending on your 'distance_unit' setting
|   pressure_trend - string: 1 for rising, 0 for stable, -1 for dropping
|   visibility = string: number in kilometers or miles, depending on your 'distance_unit' setting
|
| DEFAULT: temp
||
*/

$config['default_observation'] = 'temp';

/*
|--------------------------------------------------------------------------
| Default language
|--------------------------------------------------------------------------
|
| Set the language that the API will return. For list of choices:
| http://www.wunderground.com/weather/api/d/documentation.html#lang
| DEFAULT: EN
||
*/

$config['default_language'] = 'EN';

/*
|--------------------------------------------------------------------------
| Degree units
|--------------------------------------------------------------------------
|
| Options: f = fahrenheith, c = celsius
| DEFAULT: f
||
*/

$config['degree_unit'] = 'f';

/*
|--------------------------------------------------------------------------
| English or Metric
|--------------------------------------------------------------------------
|
| Options: e = english (miles, inches), m = metric (kilometers, mm)
| DEFAULT: e
||
*/

$config['distance_unit'] = 'e';

/*
|--------------------------------------------------------------------------
| Icon Set
|--------------------------------------------------------------------------
|
| Which set of icons would you like to use? For list of choices:
| http://www.wunderground.com/weather/api/d/documentation.html#icons
|
| For Set #1, enter 1, for Set #2, enter 2, and so on.
|
| Any value that is not a number between 1 and 9 will return Set #1.
||
*/

$config['icon_set'] = 1;

/*
|--------------------------------------------------------------------------
| Wunderground.com Credit Options
|--------------------------------------------------------------------------
|
| You MUST include a credit to Weather Underground per the ToS.
| Visit http://www.wunderground.com/weather/api/d/documentation.html#logos
| for options and details
||
*/

//options are 4c, blue, black, or white
$config['logo_color'] = '4c';

//options are standard or horz
$config['logo_orientation'] = 'standard'; 

//name of the class of the div that houses the logo
$config['logo_div_class'] = 'weather_credit';

//options are large, medium, small
//feel free to edit or add dimensions in the library file
$config['logo_size'] = 'medium';

// --------------------------------------------------------------------------

/* End of file weather.php */
/* Location: ./weather/config/weather.php */