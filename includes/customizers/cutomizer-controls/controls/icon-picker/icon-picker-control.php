<?php
 
if (class_exists('WP_Customize_Control')) {
	class awqv_Customizer_Icon_Picker_Control extends \WP_Customize_Control {

		public $type = 'awqv-icon-picker';

		public $iconset = array();

		public function to_json() {
			if ( empty( $this->iconset ) ) {
				$this->iconset = 'awqv-icon';
			}
			$iconset               = $this->iconset;
			$this->json['iconset'] = $iconset;
			parent::to_json();
		}
		
		public function enqueue() {
			//declare assets path
			$assets_path = AWQV_PATH . '/includes/customizers/cutomizer-controls/controls/icon-picker/assets';
			wp_enqueue_script( 'awqv-icon-picker-ddslick-min', Awqv_Lite_Plugin::awqv_assets_path() . '/icon-picker/assets/js/jquery.ddslick.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'awqv-icon-picker-control', Awqv_Lite_Plugin::awqv_assets_path() . '/icon-picker/assets/js/icon-picker-control.js', array( 'jquery', 'awqv-icon-picker-ddslick-min' ), '', true );
			wp_enqueue_style( 'awqv-icon', $assets_path . '/css/fontello.css' );
		}

		public function render_content() {
			if ( empty( $this->choices ) ) {
				require_once Awqv_Lite_Plugin::awqv_dir() . '/icon-picker/inc/awqv-icons.php';
				$this->choices = awqv_icon_list();
			}
		?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<select class="awqv-icon-picker-icon-control" id="<?php echo esc_attr( $this->id ); ?>">
					<?php foreach ( $this->choices as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php echo selected( $this->value(), $value, false ); ?> data-iconsrc="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		<?php }

	}
}

