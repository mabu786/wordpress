<?php
/*
Plugin Name: myhippo
Description: myhippo
Version: 1.2
Author: Subhani
Author URI: 

*/

Class Myhippo {

	function __construct() {

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		add_action( 'init', array( $this, 'rewrite' ) );
		add_filter( 'query_vars', array( $this, 'query_vars' ) );
		add_action( 'template_include', array( $this, 'change_template' ) );

	}

	function activate() {
		set_transient( 'vpt_flush', 1, 60 );
	}

	function rewrite() {
		add_rewrite_endpoint( 'quoteform', EP_PERMALINK );
		add_rewrite_rule( '^myhippo$', 'index.php?quoteform=1', 'top' );

		if(get_transient( 'vpt_flush' )) {
			delete_transient( 'vpt_flush' );
			flush_rewrite_rules();
		}
	}

	function query_vars($vars) {
		$vars[] = 'quoteform';

		return $vars;
	}

	function change_template( $template ) {

		

		if( get_query_var( 'quoteform', false ) !== false ) {

			$newTemplate = locate_template( array( 'template-quoteform.php' ) );
			if( '' != $newTemplate )
				return $newTemplate;

			//Check plugin directory next
			$newTemplate = plugin_dir_path( __FILE__ ) . 'templates/template-quoteform.php';
			if( file_exists( $newTemplate ) )
				return $newTemplate;


		}

		//Fall back to original template
		return $template;

	}

}

new Myhippo;

add_action("wp_ajax_nopriv_quote_form_submit", "quote_form_submit");
add_action("wp_ajax_quote_form_submit", "quote_form_submit");
function quote_form_submit() {
	global $wpdb;
	parse_str($_POST['data'], $formdata);
	$date=date_create($formdata['date_od_birth']);
	$new_date= date_format($date,"mdY");
	$query = http_build_query([
	 'auth_token' => get_option('my_hippo_auth_token'),
	 'street' => $formdata['stadd'],
	 'city' => $formdata['city'],
	 'state' => $formdata['state'],
	 'zip' => $formdata['zip'],
	 'first_name' => $formdata['fname'],
	 'last_name' => $formdata['lname'],
	 'email' => $formdata['email'],
	 'phone' => $formdata['phone'],
	 'date_of_birth' => $new_date
	]);
	//echo $query;exit;
	$curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => get_option('my_hippo_api_url')."?".$query,
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	 
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	$data = json_decode($response, true);

	curl_close($curl);
	echo $response;exit;
}
/****  API Settings Page *****/
add_action('admin_menu', 'my_hippo_plugin_create_menu');

function my_hippo_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('My Hippo Plugin Settings', 'Hippo Settings', 'administrator', __FILE__, 'my_hippo_plugin_settings_page'  );

	//call register settings function
	add_action( 'admin_init', 'register_my_hippo_plugin_settings' );
}


function register_my_hippo_plugin_settings() {
	//register our settings
	register_setting( 'my-hippo-plugin-settings-group', 'my_hippo_api_url' );
	register_setting( 'my-hippo-plugin-settings-group', 'my_hippo_auth_token' );
	
}

function my_hippo_plugin_settings_page() {
?>
<div class="wrap">
<h1>Your Plugin Name</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'my-hippo-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-hippo-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Api URL</th>
        <td><input type="text" name="my_hippo_api_url" value="<?php echo esc_attr( get_option('my_hippo_api_url') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Auth Token</th>
        <td><input type="text" name="my_hippo_auth_token" value="<?php echo esc_attr( get_option('my_hippo_auth_token') ); ?>" /></td>
        </tr>
        
        
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
