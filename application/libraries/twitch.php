<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twitch {

	/**
	 * Twitch Library
	 *
	 * @package		Twitch Library
	 * @author		Muhammad Uzair Khan (Muhammad.Uzair@tradekey.com)
	 * @version		1.0
	 * @since		Version 1.0 2014
	 */

	public $channel_name; 

	public function __construct($params = array()){
		
		$this->_api_url = "https://api.twitch.tv/kraken/" ;
		$this->_api_url_channels = $this->_api_url."channels/" ;
		$this->_api_url_streams = $this->_api_url."streams" ;
		$this->_api_url_videos = $this->_api_url."channels/%s/videos" ; //%s will be channels name
	}

	//Send single channel or array in $channel for multiples
	public function get_channel_details( $channels , $callback_info = array())
	{
		if(!$channels)
		{
			$channels = $this->channels; 
		}

		if(!is_array($channels))
			return $this->get_url_contents_object( $this->_api_url_channels . $channels );
		else
			$channels_array = $channels;

		foreach ($channels_array as $chnl) {
			$channel_details[$chnl]->channel = $this->get_url_contents_object( $this->_api_url_channels . $chnl );
		}

		return $channel_details;
	}

	//Gets Channel Streams.
	public function get_channel_streams( $channels = array() )
	{

		if(is_array($channels))
			$streams_fields['channel'] = implode(",", $channels);

		$channel_streams = $this->get_url_contents_object( $this->_api_url_streams , $streams_fields);

		if(array_filled($channel_streams->streams))
		{
			foreach ($channel_streams->streams as $stream) {
				$channel_name = $stream->channel->name;
				$channel_details[$channel_name] = $stream;
				$channel_details[$channel_name]->stream_status = "live";
				$ch_key = array_search($channel_name, $channels);
				unset($channels[$ch_key]);
			}
		}

		unset($channel_streams);
		// Now get the channeld details for offilne channels
		$offline_channel_details = $this->get_channel_details($channels);
		if(is_array($channel_details))
			$channel_details = $channel_details + $offline_channel_details;
		else
			$channel_details = $offline_channel_details;
		return $channel_details;
	}

	//$channel is mixed in nature
	public function get_channel_videos( $channels)
	{
		if(!$channels)
		{
			$channels = $this->channels; 
		}

		if(!is_array($channels))
		{
			$video_link = sprintf($this->_api_url_videos , $channels );
			return $this->get_file_contents_object( $video_link );
		}	
		else
			$channels_array = $channels;

		foreach ($channels_array as $chnl) {
			$video_link = sprintf($this->_api_url_videos , $chnl );
			$video_details[$chnl] = $this->get_file_contents_object( $video_link );
		}

		return $video_details;
	}

	public function get_url_contents_object($url , $get = array())
	{
		$content = $this->get_url_contents($url , $get) ;
		$return_obj = json_decode($content);
	    return $return_obj;
	}

	public function get_file_contents_object($url)
	{
		$content = file_get_contents($url) ;
		$return_obj = json_decode($content);
	    return $return_obj;
	}

	public function get_url_contents($url , $fields = array()){
		if(array_filled($fields))
    	{ 
		    foreach($fields as $key=>$value) 
	    	{ 
	    		$fields_string .= $key.'='.urlencode($value).'&'; 
	    	}
	    	$fields_string = rtrim($fields_string,"&");
	    	$url .= "?".$fields_string;
    	}
	    $crl = curl_init();
	    $timeout = 10;
	    curl_setopt ($crl, CURLOPT_URL,$url);
	    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	    $ret = curl_exec($crl);
	    // When / if error occurs, use file_get_contents instead
	    if(curl_error($crl))
    	{
    		live_debug(curl_error($crl));
    		$ret = file_get_contents($url);
    	}
	    
	    curl_close($crl);
	    return $ret;
	}

	function post_url_contents($url, $fields) {

	    foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
	    rtrim($fields_string, '&');

	    $crl = curl_init();
	    $timeout = 5;

	    curl_setopt($crl, CURLOPT_URL,$url);
	    curl_setopt($crl,CURLOPT_POST, count($fields));
	    curl_setopt($crl,CURLOPT_POSTFIELDS, $fields_string);

	    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	    $ret = curl_exec($crl);
	    curl_close($crl);
	    return $ret;
	}

}