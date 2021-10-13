<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Awqv_Admin_Notice
{
	const VERSION='1.0';
	
	/**
     * Construct
     */
    public function __construct()
    {
        $this->show_notification_on_time();
        add_action("admin_enqueue_scripts", [$this, "enqueue"]);
        add_action("wp_ajax_never_show", "never_show");
    }
	 /**
     * Enqueue Scripts
     */
    public function enqueue()
    {
       
        wp_enqueue_style(
            "awqv-notice-css",
            $this->plugin_path() . "/css/aep-notice.css",
            []
        );
		wp_enqueue_script(
            "awqv-notice-update-js",
            $this->plugin_path() . "/js/update-notice.js",
            "",
            self::VERSION,
            false
        );

        wp_localize_script("awqv-notice-update-js", "ajaxobj", [
            "ajaxurl" => admin_url("admin-ajax.php"),
        ]);
    }
	/**
     * Notice Title
     */
	public static function notice_title()
	{
		echo "Awesome Quick Viewer for Woocommerce";
	}
	/**
     * Notice Message
     */
	public static function notice_message()
	{
		echo "If you love this plugin please make a small donation! 
		Your small donation will help us in this COVID 19 situation. 
		Or give us a five-star review of our motivation. Thanks.";
	}
	/**
     * plugin path
     */
	 public function plugin_path()
	 {
		$assets_path = plugins_url("/", __FILE__);
		return $assets_path;
	  }
	 
	/**
     * Update Option
     */
    public function never_show()
    {
        update_option("awqv_notice", "never_show");
    }
	/**
     * Notice show if condition meet
     */
	public function show_notification_on_time()
	{
		$notification_status= get_option("awqv_notice");
		$get_install_date	= get_option('awqv_lite_activation_date');
		$install_date		= date("Y-m-d", $get_install_date);

		$date				= new DateTime($install_date);
		$now 				= new DateTime();
		$date_diff 			= $date->diff($now)->format("%d");
		
		if($date_diff>=1 && $notification_status!='never_show' ){
			add_action("admin_notices", [$this, "notice_output"]);
		}
	}
	/**
     * Notice Output
     */
    public function notice_output()
    {?>
	 <div class='notice aep-notice'>
        <div class="aep-notice-logo">
            <img src="<?php echo $this->plugin_path() .
                "/img/notice-img.jpg"; ?>" >
        </div>
        <div class="aep-notice-content">
            <h3><?php self::notice_title(); ?></h3>
            <p><?php self::notice_message(); ?></p>
			<p class="aep-links">
				<a href="https://www.paypal.com/donate?hosted_button_id=ZC2N2PY77T9HL" class="donate"> 
					<i class="icon-donation"></i> 
					<?php echo __("Donate", "awqv"); ?>
				</a>
				<a href="#" class="review">
					<i class="icon-star-empty"></i> 
					<?php echo __("Leave a Review", "awqv"); ?>
				</a>
				<a href="#nevershow" class="never-show">
					<i class="icon-cancel-circle"></i> 
					<?php echo __("Never Show", "awqv"); ?>
				</a>
            </p>
        </div>
      </div>
	 <?php
    }
}

new Awqv_Admin_Notice();
?>