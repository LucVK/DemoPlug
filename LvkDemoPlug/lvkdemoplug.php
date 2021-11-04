<?php
/**
 * @package Lvk Demo Plug
 * @version 1.1.0
 */
/*
Plugin Name: Lvk Demo Plug
Plugin URI: https://github.com/LucVK/DemoPlug
Description: This is my first plugin
Author: Luc Van Keer
Version: 1.1.0
Author URI: http://lvk.tt/
*/

function hello_lvk_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "Hello, Dolly (nl)
Well, hello, Dolly (nl)
It's so nice to have you back where you belong (nl)
You're lookin' swell, Dolly (nl)
I can tell, Dolly (nl)
You're still glowin', you're still crowin' (nl)
You're still goin' strong (nl)
I feel the room swayin' (nl)
While the band's playin' (nl)
One of our old favorite songs from way back when (nl)
So, take her wrap, fellas (nl)
Dolly, never go away again (nl)
Hello, Dolly (nl)
Well, hello, Dolly (nl)
It's so nice to have you back where you belong (nl)
You're lookin' swell, Dolly (nl)
I can tell, Dolly (nl)
You're still glowin', you're still crowin' (nl)
You're still goin' strong (nl)
I feel the room swayin' (nl)
While the band's playin' (nl)
One of our old favorite songs from way back when (nl)
So, golly, gee, fellas (nl)
Have a little faith in me, fellas (nl)
Dolly, never go away (nl)
Promise, you'll never go away (nl)
Dolly'll never go away again" (nl);

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_lvk() {
	$chosen = hello_lvk_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello Dolly song, by Jerry Herman:', 'hello-dolly' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_lvk' );

// We need some CSS to position the paragraph.
function lvk_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'lvk_css' );
