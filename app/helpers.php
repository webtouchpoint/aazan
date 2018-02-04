<?php 

/**
 * Set active page
 *
 * @param string $uri
 * @return string
 */
function set_active($uri)
{
    return Request::is($uri) ? 'active' : '';
}

/**
 * Check a particular page.
 *
 * @param string $uri
 * @return boolean
 */
function check_page($uri)
{
    return Request::is($uri) ? true : false;
}

function is_video_or_ebook()
{
	return check_page('ebooks') || check_page('ebooks/*') || check_page('video*') || check_page('video/*') ? true : false;
}

function show_tag()
{
    $path = explode('/', Request::path());
   	return end($path);
}

