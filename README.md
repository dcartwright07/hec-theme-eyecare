# Hamilton Eyecare Center Website
This repo contains the theme that is used in the 2019 website build for Hamilton Eyecare Center. This theme is a child theme. Please see details below.

**Theme Name:** EyeCare Child Theme <br />
**Theme URI:** https://themeforest.net/user/webfulcreationsvision/portfolio <br />
**Author:** Webful Creations Vision <br />
**Author URI:** http://www.webfulcreations.com/ <br />
**Description:** Webful Eye Care template is best optometrist template for eye care doctors, lasik clinics and eye surgery. Can be used for various types of doctors as well. <br />
**Version:** 1.0 <br />
**License:** GNU General Public License v3 or later <br />
**License URI:** http://www.gnu.org/licenses/gpl-3.0.html <br />
**Tags:** one-column, two-columns, right-sidebar, custom-colors, custom-header, custom-menu, featured-images, post-formats, translation-ready, left-sidebar <br />
**Template:** eyecare <br />
**Template Version:** 1.0.0 <br />


## Parent Theme Edits

### Add footer functionality to only use one widget

There wasn't any option select one widget to use in the footer. Therefore, this functionality had to be add in the parent them to accommodate the desired functionality. The information below details the files that were edited and the code that we changed.

In file `core-function.php` in the conditional statement:

```
if(!function_exists('wc_sanitize_values')) {
	function wc_sanitize_values( $value ) {
		if (! in_array($value, array('left_sidebar',
				'right_sidebar',
				'disable_sidebar',
				'two-widgets',
				'three-widgets',
				'four-widgets',
				'copyright-info',
				'selective-social-icons',
				'footer-menu',
				'excerpt_content',
				'full_content')) ) {
			$value = '';
		}
		return $value;
	}//Function Ends.
} // End if Exists
```

the code ` 'one-widget', ` was added. Below is the version currently in use.

```
if(!function_exists('wc_sanitize_values')) {
	function wc_sanitize_values( $value ) {
		if (! in_array($value, array('left_sidebar',
				'right_sidebar',
				'disable_sidebar',
				'one-widget',
				'two-widgets',
				'three-widgets',
				'four-widgets',
				'copyright-info',
				'selective-social-icons',
				'footer-menu',
				'excerpt_content',
				'full_content')) ) {
			$value = '';
		}
		return $value;
	}//Function Ends.
} // End if Exists
```

In file `footer-top.php` in the conditional statement:

```
if($widgets == 'four-widgets' || $widgets == '') {
	//Four Columns
	$classes = 'large-3 medium-6 small-12 columns';
} else if($widgets == 'three-widgets') {
	//3 Widgets
	$classes = 'large-4 medium-6 small-12 columns';
} else if($widgets == 'two-widgets') {
	//2 Widgets
	$classes = 'medium-6 small-12 columns';
}
```

an `else` statement was added. Also, the code `|| $widgets == ''` was removed from the first conditional. Below is the version currently in use.

```
if($widgets == 'four-widgets') {
	//Four Columns
	$classes = 'large-3 medium-6 small-12 columns';
} else if($widgets == 'three-widgets') {
	//3 Widgets
	$classes = 'large-4 medium-6 small-12 columns';
} else if($widgets == 'two-widgets') {
	//2 Widgets
	$classes = 'medium-6 small-12 columns';
} else {
	//1 Widget
	$classes = 'small-12 columns';
}
```