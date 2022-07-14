<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       luqvote
 * @since      1.0.0
 *
 * @package    Luqvote
 * @subpackage Luqvote/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Luqvote
 * @subpackage Luqvote/public
 * @author     luqvote <luqvote>
 */
class Luqvote_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Luqvote_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Luqvote_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/luqvote-public.css', array(), $this->version, 'all' );


		$files = glob(WP_PLUGIN_DIR . '/luqvote/my-app/dist/assets/*.css');
		
		foreach ($files AS $key => $val){
			wp_enqueue_style( 'svelte_my-app#'.$key , plugins_url('/luqvote/my-app/dist/assets/') . basename($val) , array(), null, 'all' );
		}
		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Luqvote_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Luqvote_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/luqvote-public.js', array( 'jquery' ), $this->version, false );
		

		$files = glob(WP_PLUGIN_DIR . '/luqvote/my-app/dist/assets/*.js');
		
		foreach ($files AS $key => $val){
			wp_enqueue_script( 'svelte_my-app#'.$key , plugins_url('/luqvote/my-app/dist/assets/') . basename($val) , array(), null, true );
		}
		wp_localize_script( 'svelte_my-app#'.$key, 'frontend_ajax_object',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'statuslogin' => wp_get_current_user()
        )
    );
		
		
	}


	public function add_type_attribute($tag, $handle, $src) {
		// if not your script, do nothing and return original $tag
		if (strpos($handle, 'svelte_my-app') !== false) {
			$tag = '<script type="module" crossorigin src="' . esc_url( $src ) . '"></script>';
			return $tag;
		}
		
		return $tag;
	}


	public function luqvote_daftarcalon(){
		global $wpdb;

		if(isset($_POST['fungsi']) && $_POST['fungsi'] === 'senaraicalon'){

			$tableName = $wpdb->prefix."posts" ;
			$result = $wpdb->get_results( "SELECT a.*, count(b.meta_key) as vote, 
			(SELECT count(*) 
			FROM {$wpdb->prefix}postmeta
			WHERE meta_value = MAX(b.meta_value)
			GROUP BY meta_value
			) as totalvote
			FROM  $tableName a LEFT JOIN {$wpdb->prefix}postmeta b ON a.ID = b.post_id WHERE a.post_type =  'luqvote' GROUP BY a.ID"  );
			$viewdata = array();
			foreach ( $result as $key => $page )
			{
				$viewdata[$key]['ID'] = $page->ID;
				$viewdata[$key]['post_content'] = unserialize($page->post_content);
				$viewdata[$key]['vote'] = $page->vote;
				$viewdata[$key]['totalvote'] = $page->totalvote;
			}

			echo json_encode($viewdata);
			exit();
		}else if(isset($_POST['fungsi']) && $_POST['fungsi'] === 'deletecalon'){
			$post_id = $_POST['post_id'];
			$tableName = $wpdb->prefix."posts" ;
			$result = $wpdb->get_results( "DELETE FROM  $tableName WHERE ID =  '$post_id' "  );
			$result = $wpdb->get_results( "SELECT a.*, count(b.meta_key) as vote, 
			(SELECT count(*) 
			FROM {$wpdb->prefix}postmeta
			WHERE meta_value = MAX(b.meta_value)
			GROUP BY meta_value
			) as totalvote
			FROM  $tableName a LEFT JOIN {$wpdb->prefix}postmeta b ON a.ID = b.post_id WHERE a.post_type =  'luqvote' GROUP BY a.ID"  );
			$viewdata = array();
			foreach ( $result as $key => $page )
			{
				$viewdata[$key]['ID'] = $page->ID;
				$viewdata[$key]['post_content'] = unserialize($page->post_content);
				$viewdata[$key]['vote'] = $page->vote;
				$viewdata[$key]['totalvote'] = $page->totalvote;
			}

			echo json_encode($viewdata);
			exit();
		}else if(isset($_POST['fungsi']) && $_POST['fungsi'] === 'votecalon'){
			//delete yg dia pernah undi jawatan 
			$meta_key = $_POST['getdevid'];
    		$table = $wpdb->prefix."postmeta";
			$wpdb->delete( $table, array( 'meta_key' => $meta_key ) );
			
			$post_id = $_POST['post_id'];
			update_post_meta( $post_id, $_POST['getdevid'], $_POST['getjawatan'] );
			$tableName = $wpdb->prefix."posts" ;
			$result = $wpdb->get_results( "SELECT a.*, count(b.meta_key) as vote, 
			(SELECT count(*) 
			FROM {$wpdb->prefix}postmeta
			WHERE meta_value = MAX(b.meta_value)
			GROUP BY meta_value
			) as totalvote
			FROM  $tableName a LEFT JOIN {$wpdb->prefix}postmeta b ON a.ID = b.post_id WHERE a.post_type =  'luqvote' GROUP BY a.ID"  );
			$viewdata = array();
			foreach ( $result as $key => $page )
			{
				$viewdata[$key]['ID'] = $page->ID;
				$viewdata[$key]['post_content'] = unserialize($page->post_content);
				$viewdata[$key]['vote'] = $page->vote;
				$viewdata[$key]['totalvote'] = $page->totalvote;
			}

			echo json_encode($viewdata);
			exit();
		}else if(isset($_POST['fungsi']) && $_POST['fungsi'] === 'senaraijawatan'){
			$tableName = $wpdb->prefix."options" ;
			$result = $wpdb->get_results( "SELECT * FROM  $tableName WHERE option_name =  'luqvotedaftarjawatan' "  );
			$result = unserialize($result[0]->option_value);
			sort($result);

			echo json_encode($result);
			exit();
		}else if(isset($_POST['fungsi']) && $_POST['fungsi'] === 'DaftarJawatan'){
			$tableName = $wpdb->prefix."options" ;
			$result = $wpdb->get_results( "SELECT * FROM  $tableName WHERE option_name =  'luqvotedaftarjawatan' "  );
			$arrayjawatan = array($_POST['jawatan']);
			
			if ($result === FALSE || $result < 1 || $result === array()) {
				$data_update = array(
					'option_name' => $wpdb->esc_like('luqvotedaftarjawatan'),
					'option_value' => serialize($arrayjawatan),
					'autoload' => 'no'
				);
				$wpdb->insert($tableName, $data_update);
				$result = $wpdb->insert_id;
			}else{
				foreach(unserialize($result[0]->option_value) as $value){
					if(!in_array($value, $arrayjawatan, true)){
						array_push($arrayjawatan, $value);
					}
				}
				$data_update = array(
					'option_name' => $wpdb->esc_like('luqvotedaftarjawatan'),
					'option_value' => serialize($arrayjawatan),
					'autoload' => 'no'
				);
				$data_where = array(
					'option_name' => $wpdb->esc_like('luqvotedaftarjawatan')
				);
				$result = $wpdb->update($tableName , $data_update, $data_where);
				

			}
			
			echo json_encode($result);
			exit();

		}else{
			$tableName = $wpdb->prefix."posts" ;
			$data_update = array('post_author' => get_current_user_id()
			,'post_type' => $wpdb->esc_like('luqvote')
			,'post_content' => serialize($_POST)
			);
			$data_where = array('ID' => $_POST['post_id']);
			$result = $wpdb->update($tableName , $data_update, $data_where);
			//If nothing found to update, it will try and create the record.
			//print_r($data_where);print_r($result);exit();
			if ($result === FALSE || $result < 1) {
				$wpdb->insert($tableName, $data_update);
				$mengaji_id = $wpdb->insert_id;
			}

			echo json_encode($mengaji_id);
			exit();

		}
		

	}

}


