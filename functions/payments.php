<?php


//payments
function sendInvoice($chat_id, $title, $description, $payload, $provider_token, $start_parameter, $currency, $prices, $provider_data, $photo_url = NULL, $photo_size = NULL, $photo_width = NULL, $photo_height = NULL, $need_name = NULL, $need_phone_number = NULL, $need_email = NULL, $need_shipping_address = NULL, $is_flexible = NULL, $disable_notification = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'chat_id' => $chat_id,
		'title' => $title,
		'description' => $description,
		'payload' => $payload,
		'provider_token' => $provider_token,
		'start_parameter' => $start_parameter,
		'currency' => $currency,
		'prices' => $prices
		);
	if(isset($provider_data))
	{
		$args['provider_data'] = $provider_data;
	}
	if(isset($photo_url))
	{
		$args['photo_url'] = $photo_url;
	}
	if(isset($photo_size))
	{
		$args['photo_size'] = $photo_size;
	}
	if(isset($photo_width))
	{
		$args['photo_width'] = $photo_width;
	}
	if(isset($photo_height))
	{
		$args['photo_height'] = $photo_height;
	}
	if(isset($need_name))
	{
		$args['need_name'] = $need_name;
	}
	if(isset($need_phone_number))
	{
		$args['need_phone_number'] = $need_phone_number;
	}
	if(isset($need_email))
	{
		$args['need_email'] = $need_email;
	}
	if(isset($need_shipping_address))
	{
		$args['need_shipping_address'] = $need_shipping_address;
	}
	if(isset($is_flexible))
	{
		$args['is_flexible'] = $is_flexible;
	}
	if(isset($disable_notification))
	{
		$args['disable_notification'] = $disable_notification;
	}
	if(isset($reply_to_message_id))
	{
		$args['reply_to_message_id'] = $reply_to_message_id;
	}
	if(isset($reply_markup))
	{
		$reply_markup = json_encode($reply_markup);
		$args['reply_markup'] = $reply_markup;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/sendInvoice?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function answerShippingQuery($shipping_query_id, $ok, $shipping_options = NULL, $error_message = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'shipping_query_id' => $shipping_query_id,
		'ok' => $ok
		);
	if(isset($shipping_options))
	{
		$shipping_options = json_encode($shipping_options);
		$args['shipping_options'] = $shipping_options;
	}
	if(isset($error_message))
	{
		$args['error_message'] = $error_message;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerShippingQuery?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}


function answerPreCheckoutQuery($pre_checkout_query_id, $ok, $error_message = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$args = array(
		'pre_checkout_query_id' => $pre_checkout_query_id,
		'ok' => $ok
		);
	if(isset($error_message))
	{
		$args['error_message'] = $error_message;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerPreCheckoutQuery?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}