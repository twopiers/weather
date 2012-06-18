<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * weather
 * 
 * Simple tools to tap into the Weather Underground API
 * 
 * @license		DBAD - http://philsturgeon.co.uk/code/dbad-license
 * @author		Brian Humes
 * @link		  http://twopiers.com
 * @email		  brian@twopiers.com
 * 
 * @file		  libraries/weather.php
 * @version		0.0.2
 * @date		  06/12/2012
 */

// --------------------------------------------------------------------------

/**
 * weather class.
 */
class weather
{
	// --------------------------------------------------------------------------
	
	
	/**
	 * The world-famous superobject
	*/
	private $_ci;
	
	
	// --------------------------------------------------------------------------
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->_ci =& get_instance();
		log_message('debug', 'Weather: Library loaded.');
		
		//set values from config file
		$this->_ci->config->load('weather');
		
		$defaults = array(
		  'api_key'          => $this->_ci->config->item('api_key'),
		  'location'         => $this->_ci->config->item('default_location'),
		  'language'         => $this->_ci->config->item('default_language'),
		  'observation'      => $this->_ci->config->item('default_observation'),
		  'degree_unit'      => $this->_ci->config->item('degree_unit'),
		  'distance_unit'    => $this->_ci->config->item('distance_unit'),
		  'icon_set'         => $this->_ci->config->item('icon_set'),
		  'logo_color'       => $this->_ci->config->item('logo_color'),
		  'logo_orientation' => $this->_ci->config->item('logo_orientation'),
		  'logo_div_class'   => $this->_ci->config->item('logo_div_class'),
		  'logo_size'        => $this->_ci->config->item('logo_size'),
		);
		$this->defaults = $defaults;
	}
	
	// --------------------------------------------------------------------------

	/**
	 * current_conditions function.
	 * 
	 * @access public
	 * @return string, float or int (depending on what observation you requested
	 * see the README file for more information on observation types
	 */
	public function current_conditions($options = array())
	{
  	if( ! is_array($options))
    {
      show_error('weather->current_conditions requires an array as input.');
      log_message('error', 'weather->current_conditions requires an array as input.');
      return false;
    }
    $options       = array_merge($this->defaults, $options);
  	$degree_unit   = $this->_parse_degree_unit($options['degree_unit']);
  	$distance_unit = $this->_parse_distance_unit($options['distance_unit']);
  	$json_string   = file_get_contents('http://api.wunderground.com/api/'.$options['api_key'].'/conditions/lang:'.$options['language'].'/q/'.$options['location'].'.json');
  	$parsed_json   = json_decode($json_string);
  	$observation   = $this->_parse_observation($options['observation'],$options['degree_unit'],$options['distance_unit']);
  	return $parsed_json->current_observation->$observation;
	}
	// --------------------------------------------------------------------------
	
	/**
	 * current_icon function.
	 * 
	 * @access public
	 * @return string
	 */
	public function current_icon($options = array())
	{
  	if( ! is_array($options))
    {
      show_error('weather->current_icon requires an array as input.');
      log_message('error', 'weather->current_icon requires an array as input.');
      return false;
    }
    $options       = array_merge($this->defaults, $options);
  	$degree_unit   = $this->_parse_degree_unit($options['degree_unit']);
  	$distance_unit = $this->_parse_distance_unit($options['distance_unit']);
  	$json_string   = file_get_contents('http://api.wunderground.com/api/'.$options['api_key'].'/conditions/lang:'.$options['language'].'/q/'.$options['location'].'.json');
  	$parsed_json   = json_decode($json_string);
  	$icon          = $this->_parse_icon_url($parsed_json->current_observation->icon_url);
  	return '<img src="//icons-ak.wxug.com/i/c/'.$this->_convert_icon_set($options['icon_set']).'/'.$icon.'">';
	}
	// --------------------------------------------------------------------------

	// --------------------------------------------------------------------------
	
	/**
	 * currently function.
	 * 
	 * @access public
	 * @return string
	 */
	public function credit($options = array())
	{
  	$this->_ci->load->helper('url');
		
		if( ! is_array($options))
    {
      show_error('weather->credit requires an array as input.');
      log_message('error', 'weather->credit requires an array as input.');
      return false;
    }
    $options          = array_merge($this->defaults, $options);
  	$logo_color       = $this->_parse_logo_color($options['logo_color']);
  	$logo_orientation = $this->_parse_logo_orientation($options['logo_orientation']);
  	$logo_size        = $this->_parse_logo_size($options['logo_size'],$logo_orientation);
  	return '<div class="'.$options['logo_div_class'].'"><img src="'.base_url().'sparks/weather/0.0.2/logos/wundergroundLogo_'.$logo_color.$logo_orientation.'_'.$logo_size.'.png" alt="Weather Underground Logo" title="Weather data provided by Weather Underground"></div>';
	}
	// --------------------------------------------------------------------------

	private function _parse_observation($observation,$degree_unit,$distance_unit)
	{
  	if(in_array($observation, array('temp','dewpoint','heatindex','windchill','feelslike')))
  	{
    	return $observation.'_'.$degree_unit;
  	}
  	else if(in_array($observation, array('wind','wind_gust')))
  	{
    	return $observation.'_'.($distance_unit == 'e' ? 'mph' : 'kph');
  	}
  	else if(in_array($observation, array('pressure')))
  	{
    	return $observation.'_'.($distance_unit == 'e' ? 'in' : 'mb');
  	}
  	else if(in_array($observation, array('visibility')))
  	{
    	return $observation.'_'.($distance_unit == 'e' ? 'mi' : 'km');
  	}
  	else
  	{
    	return $observation;
  	}
	}	
	// --------------------------------------------------------------------------

	private function _parse_degree_unit($degree_unit)
	{
  	switch($degree_unit)
  	{
    	case 'c':
    	  return 'c';
    	  break;
      default:
        return 'f';
        break;
  	}
	}	
	// --------------------------------------------------------------------------

	private function _parse_distance_unit($distance_unit)
	{
  	switch($distance_unit)
  	{
    	case 'm':
    	  return 'm';
    	  break;
      default:
        return 'e';
        break;
  	}
	}	
	// --------------------------------------------------------------------------

  private function _convert_icon_set($n)
  {
  	// $n MUST be an integer between 1 and 9, or else we return icon set #1 ('a')
  	if(is_int($n) && ($n > 0 && $n < 10))
  	{
      $n -= 1;
      $letter  = chr(($n % 26) + 97);
      $letter .= 	(floor($n/26) > 0) ? str_repeat($letter, floor($n/26)) : '';
      return $letter;
  	}
  	else
  	{
    	return 'a';
  	} 
  }
  
  private function _parse_icon_url($url)
  {
    $url = explode('/',$url);
    return $url[6];
  }
  
  private function _parse_logo_color($color)
  {
    if(in_array($color,array('blue','black','4c','white')))
    {
      return $color;
    }
    else
    {
      return '4c';
    }
  }

  private function _parse_logo_orientation($orientation)
  {
  	switch($orientation)
  	{
    	case 'horz':
    	  return '_horz';
    	  break;
      default:
        return '';
        break;
  	}
  }

  private function _parse_logo_size($size)
  {
    if(in_array($size,array('large','medium','small')))
    {
      return $size;
    }
    else
    {
      return 'medium';
    }
  }

}