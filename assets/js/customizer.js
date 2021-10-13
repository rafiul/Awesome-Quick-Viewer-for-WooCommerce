/**
 * File customizer.js.
 *
 */

(function ($) {
	
  wp.customize("awqv_sale_flash_bg", function (value) {
    value.bind(function (to) {
      $(".qv-col .onsale").css("background", to);
    });
  });
   wp.customize("awqv_cart_button_bg", function (value) {
    value.bind(function (to) {
      $(".woocommerce .qv-description button.button.alt").css("background", to);
    });
  });
   wp.customize("awqv_view_cart_button_bg", function (value) {
    value.bind(function (to) {
      $(".added_to_cart.wc-forward").css("background", to);
    });
  });
 
  wp.customize("awqv_window_bg", function (value) {
    value.bind(function (to) {
      $(".qv-row").css("background", to);
    });
  }); 
  wp.customize("awqv_desc_color", function (value) {
    value.bind(function (to) {
      $(".qv-description .woocommerce-product-details__short-description, .stock.out-of-stock").css("color", to);
    });
  });
  
  wp.customize("awqv_title_color", function (value) {
    value.bind(function (to) {
      $(".qv-description .product_title").css("color", to);
    });
  }); 
  wp.customize("awqv_product_meta_color", function (value) {
    value.bind(function (to) {
      $(".qv-description .product_meta").css("color", to);
    });
  });
   wp.customize("awqv_product_meta_link_color", function (value) {
    value.bind(function (to) {
      $(".qv-description .product_meta a").css("color", to);
    });
  }); 
  wp.customize("awqv_product_review_color", function (value) {
    value.bind(function (to) {
      $(".qv-description .woocommerce-product-rating .star-rating, .qv-description .woocommerce-product-rating a").css("color", to);
    });
  }); 
  wp.customize("awqv_product_price_color", function (value) {
    value.bind(function (to) {
      $(".qv-description p.price").css("color", to);
    });
  });
  
  wp.customize("qv_button_label", function (value) {
    value.bind(function (to) {
      $(".open-modal").text(to);
    });
  });
  wp.customize("awqv_action_button_bg", function (value) {
    value.bind(function (to) {
      $(".open-modal").css("background", to);
    });
  });
  
   //===Animation Section ====
  wp.customize("qv_animation", function (value) {
    value.bind(function (to) {
      $(".bg-wg-modal .wg-modal").css("animation-name", to);
      $(".bg-wg-modal .wg-modal").addClass("animate__animated");
    });
  });
  //===Close Icon Section ====
  wp.customize("awqv_icon_picker", function (value) {
    value.bind(function (to) {
		var $target =  $(".wg-modal-close");
		var $icon = to;
		var $close_container =  ($icon=='default') 
		? $('<div class="wg-modal-close">&times;</div>')
		: $('<div class="wg-modal-close"><i class="'+$icon+'"></i></div>');
		
		$target.remove();
		$('.wg-content').append($close_container);
    });
  });
  wp.customize("btn_padding_top_bottom", function (value) {
    value.bind(function (to) {
	  $("button.button.alt").css({"padding-top": to +"px", "padding-bottom": to + "px" });
	   $(".added_to_cart.wc-forward").css({"padding": to +"px"});
    });
  });
   wp.customize("btn_padding_left_right", function (value) {
    value.bind(function (to) {
       $("button.button.alt").css({"padding-left": to +"px", "padding-right": to + "px" });
    });
  }); 
  wp.customize("awqv_icon_color", function (value) {
    value.bind(function (to) {
      $(".wg-modal-close i").css("color", to);
    });
  });
  //===Slider Nav Section ====
  wp.customize("awqv_slider_prev_icon", function (value) {
    value.bind(function (to) {
      $(".owl-prev i").removeClass().addClass(to);
    });
  });
   wp.customize("awqv_slider_next_icon", function (value) {
    value.bind(function (to) {
      $(".owl-next i").removeClass().addClass(to);
    });
  });
  wp.customize("awqv_nav_color", function (value) {
    value.bind(function (to) {
      $(".owl-nav i").css("color", to);
    });
  });
    //=== Slider Dot Section ====
   wp.customize("awqv_slider_dot_switch", function (value) {
    value.bind(function (to) {
		if(to===false){
			$(".awqv-theme .owl-dots").hide();
		}else{
			$(".awqv-theme .owl-dots").show();
		}
    });
  });
    wp.customize("awqv_slider_nav_switch", function (value) {
    value.bind(function (to) {
		if(to===false){
			$(".awqv-theme .owl-nav").hide();
		}else{
			$(".awqv-theme .owl-nav").show();
		}
    });
  });
  wp.customize("awqv_dot_color", function (value) {
    value.bind(function (to) {
      $(".awqv-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span").css("background", to);
    });
  });
  
  //Button Icon
   wp.customize("awqv_general_section", function (value) {
    value.bind(function (to) {
		var $icon = to;
		$('button.open-modal>i').removeClass().addClass($icon);
    });
  });

})(jQuery);