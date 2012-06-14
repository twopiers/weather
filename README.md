# Weather

Simple tools to help you interact with the Weather Underground API.

## Weather Underground API Key

Head to [http://www.wunderground.com/weather/api/](http://www.wunderground.com/weather/api/) and sign up for an API key. Takes 2 minutes.

## Installing

Available via Sparks. For info about how to install sparks, go here: http://getsparks.org/install

## Loading

You can load the spark with this:

>     $this->load->spark('weather/0.0.1');


## Usage
First, edit the 'config/weather.php' file to your liking. See the comments in the config file for information on each setting.

There are three basic functions:

**current_conditions**
Basic usage using only values from the config file:

>     echo $this->weather->current_conditions();

will return something like '62.3' (which happens to be the current Fahrenheit temperature in Saint Joseph, Michigan as I type this).

You can optionally change parameters at run-time like this:

>     $data = array(
>      'location' => 'France/Paris',
>      'observation' => 'wind_gust',
>      'degree_unit' => 'c' //for celsius
>      'distance_unit' => 'm' //for metric
>     );
>     echo 'Wind is gusting to '.$this->weather->current_conditions($data).' kph in Paris.';

To change languages:

>     $data = array(
>      'location' => 'Norway/Oslo',
>      'observation' => 'weather',
>      'language' => 'NO'
>     );
>     echo 'Været i Oslo er '.$this->weather->current_conditions($data).'.';

See the [full list of languages here](http://www.wunderground.com/weather/api/d/documentation.html#lang).

Possible values for 'observation' are:

+ weather - string: something like 'Mostly Cloudy' in the language you designate
+ temperature_string - string: something like '69.7 F (20.9 C)'
+ temp - float: one decimal place
+ relative_humidity - string: will include percent sign
+ wind_string - string: something like 'Calm' in the language you designate
+ wind_dir - string: something like 'NNW'
+ wind_degrees - int: direction of wind, 0-359
+ dewpoint_string - string: same as temperature\_string, but dewpoint temps
+ dewpoint - int: dewpoint degrees, no decimal places
+ heatindex_string - string: same as temperature\_string, but heatindex temps
+ heatindex - usually a int, but if NA, then a string
+ windchill_string - string: same as temperature\_string, but windchill temps
+ windchill - usually a int, but if NA, then a string
+ wind - string: wind speed with one decimal place
+ wind_gust - string: wind gust speed with one decimal place
+ pressure - string: number in milibars or inches, depending on your 'distance_unit' setting
+ pressure_trend - string: 1 for rising, 0 for stable, -1 for dropping
+ visibility = string: number in kilometers or miles, depending on your 'distance_unit' setting

**current_icon**

Weather Underground offers 9 sets of weather icons. You can view the sets [here](http://www.wunderground.com/weather/api/d/documentation.html#icons).

To get the current weather icon, you simply pass in a location and icon\_set value (or, pass nothing and use the config file defaults).

To get the current weather icon in Paris using icon set #4:
>     $data = array(
>      'location' => 'France/Paris',
>      'icon_set' => 4
>     );
>     echo $this->weather->current_icon($data);

will return something like:
>     <img src="//icons-ak.wxug.com/i/c/d/mostly_cloudy.gif">

current\_icon will automatically determine if the night version of the icon should be displayed.

**credit**

Per the Weather Underground Terms of Service, you MUST include a credit somewhere on your page, and that credit MUST include a Weather Underground logo.

The credit method is a simple way to add this credit icon. Typically, you'll want to set the values for the logo in the config file and forget about it, but you can also pass in those values at run-time if you like.

To fetch the logo (and wrapping div):
>     $data = array(
>      'logo_size' => 'medium',
>      'logo_color' => 'blue',
>      'logo_orientation' => 'horz',
>      'logo_div_class' => 'seafood',
>     );
>     echo $this->weather->credit();

will return:
>     <div class="seafood"><img src="http://yoursite.com/sparks/weather/0.0.1/logos/wundergroundLogo_blue_horz_medium.png" alt="Weather Underground Logo" title="Weather data provided by Weather Underground"></div>

---
#### Author

Brian Humes

#### Issues?

Use the built in GitHub issue tracker please.

#### License

[DBAD](http://philsturgeon.co.uk/code/dbad-license)

---
