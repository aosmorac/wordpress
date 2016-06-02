
// EDITABLE AREA
// ==============================================================

jQuery(document).ready(function($) {



  // Auto Lightbox & Set Image Link Type
  // ------------------------------------------------------------

  if($.isFunction($.fn.prettyPhoto)) {
    $().auto_lightbox();
    $().set_img_link_type();
  }



  // prettyPhoto
  // ------------------------------------------------------------

  if($.isFunction($.fn.prettyPhoto)) {
    $("a[data-gal^='lightbox']").prettyPhoto({
      hook:            'data-gal',
    	theme:           'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default
  		overlay_gallery: false,        // If set to true, a gallery will overlay the fullscreen image on mouse over
      social_tools:    false,
      deeplinking:     false
  	});
  }



  // Lightbox Overlay
  // ------------------------------------------------------------

  if($.isFunction($.fn.prettyPhoto)) {
    $("a[data-gal^='lightbox'] img").image_overlay();
  }



  // Sliding Links
  // ------------------------------------------------------------

  if(!$("body").hasClass("no-sliding-links")) {
    $('.widget_meta ul li a,' +
      '.widget_links ul li a,' +
      '.widget_pages ul li a,' +
      '.widget_social ul li a,' +
      '.widget_sub_nav ul li a,' +
      '.widget_nav_menu ul li a,' +
      '.widget_categories ul li a,' +
      '.widget_recent_entries ul li a,' +
      '.widget_latest_work ul.no-images li a').sliding_links({ offset: 3 });
    $('.widget_archive ul li a').sliding_links({ offset: 2 });
  }



  // Drop Down Menu
  // ------------------------------------------------------------

	$('#main-nav').drop_down_menu();



  // Mark Right Navigation Elements
  // ------------------------------------------------------------

  $('#main-nav > ul > li').mark_right_nav_elements();



  // Tabs
  // ------------------------------------------------------------

	$('.tabgroup').tabs();



  // Toggler
  // ------------------------------------------------------------

  $(".togglergroup").toggler();



  // Image Captions
  // ------------------------------------------------------------

  $(".wp-caption").image_caption_auto_width();



  // Contact Form
  // ------------------------------------------------------------

  if($.isFunction($.fn.validate)) {
    $("#contactform").validate({
  	  errorClass: "invalid",
  	  errorPlacement: function(error, element) { error.hide(); }
  	});
  }

  if($.isFunction($.fn.ajaxForm)) {
    function init_ajax_form(form) {
      $(form).ajaxForm({
        target: "form .message",
        beforeSubmit: before_submit,
        success: success
      });
      function before_submit() {
        $(form).find(".spinner").fadeIn();
        $(form).find(".message").animate({ opacity: 0 }).slideUp();
      }
      function success() {
        $(form).find(".spinner").fadeOut();
        $(form).find(".message").slideDown().animate({ opacity: 1 });
        return false;
      }
    }

    init_ajax_form("#contactform");
  }


  // Remove Empty Tags
  // ------------------------------------------------------------

  $('p').filter(function() { return $.trim($(this).html()) === ''; }).remove();
  $('.widget_sub_nav ul.sub-menu').filter(function() { return $.trim($(this).html()) === ''; }).remove();

});










// PLUGINS
// ============================================================




(function($)
{



  // Drop Down Menu
  // ------------------------------------------------------------

  $.fn.drop_down_menu = function(options) {

    var menu_li = $('ul li', this);

    $('li:has(ul)', menu_li).each(function() {
      $('>a:first-child', $(this)).append(' &#187;');
    });

    menu_li.hover(
      function(){
    		$(this).find('ul:first').css({display: "none"}).fadeIn('fast');
    	},function(){
    		$(this).find('ul:first').css({display: "none"});
  		}
  	);

  };



  // Image Overlay
  // ------------------------------------------------------------

  $.fn.image_overlay = function(options) {

    var defaults = {
      opacity: 0.5,
      animation_speed: 200,
      class_name: 'overlay-image'
    };

    var options = $.extend(defaults, options);

    return this.each(function() {
      var img  = $(this);
      var link = $(this).parent();
      var bg   = $("<span class='"+ options.class_name +"'></span>").appendTo(link);

  		link.bind('mouseenter', function() {
  		  var margin_top     = parseInt(img.css("margin-top"));
  		  var margin_bottom  = parseInt(img.css("margin-bottom"));
  		  var padding_left   = parseInt(img.css("padding-left"));
  		  var padding_top    = parseInt(img.css("padding-top"));
  		  var padding_right  = parseInt(img.css("padding-right"));
  		  var padding_bottom = parseInt(img.css("padding-bottom"));
  		  var border_left    = parseInt(img.css("border-left-width"));
  		  var border_top     = parseInt(img.css("border-top-width"));
  		  var border_right   = parseInt(img.css("border-right-width"));
  		  var border_bottom  = parseInt(img.css("border-bottom-width"));
  			var width    = img.width() + padding_left + padding_top + border_left + border_right;
  			var height   = img.height() + margin_top + margin_bottom + padding_top + padding_bottom + border_top + border_bottom;
  			var position = img.position();
  			bg.css({ width:width, height:height, top:position.top, left:position.left });
  		});

      link.hover(
        function() { img.stop().animate({ opacity: options.opacity }, options.animation_speed); },
    	  function() { img.stop().animate({ opacity: 1 }, options.animation_speed); }
      );
    });

  };



  // Tabs
  // ------------------------------------------------------------

  $.fn.tabs= function(options)
	{
		var defaults = {
			tabs:        '.tab',
			tab_content: '.tab-content'
		};

		var options = $.extend(defaults, options);

		return this.each(function()
		{
		  var tabgroup    = $(this);
			var tabs        = tabgroup.find(options.tabs);
			var tab_content = tabgroup.find(options.tab_content);

			// Activate first Tab
			tabs.first().addClass('active');
			tab_content.first().addClass('active');

			// Number Tabs and Tab Content
			tabs.each(function(i)        { $(this).addClass('nr_'+(i+1)) });
			tab_content.each(function(i) { $(this).addClass('nr_'+(i+1)) });

			tabgroup.prepend('<div class="tab-content-wrapper" />');
			var tab_content_wrapper = $('.tab-content-wrapper', tabgroup);

			tab_content.prependTo(tab_content_wrapper);

			tabgroup.prepend('<div class="tabs-wrapper" />');
			var tabs_wrapper = $('.tabs-wrapper', tabgroup);

			tabs.prependTo(tabs_wrapper).each(function() {
				var cur_tab = $(this);

				cur_tab.bind('click', function() {
				  var cur_tab_number  = ($(this).attr('class').split(' ')[1]);
				  var cur_tab_content = tabgroup.find(options.tab_content+'.'+cur_tab_number);

				  if(!cur_tab.is('.active')) {
						$('.active', tabgroup).removeClass('active');
						cur_tab.addClass('active');
						cur_tab_content.addClass('active');

						// Ajust Height if Content Height is less than Tabs Height
						var tabs_wrapper_height    = tabs_wrapper.height();
						var cur_tab_content_height = cur_tab_content.height();

						if(cur_tab_content_height < tabs_wrapper_height) {
						  cur_tab_content.css('height', tabs_wrapper_height);
						}
					}

					return false;
				});
			});

		});
	};



  // Toggler
  // ------------------------------------------------------------

  $.fn.toggler = function(options) {

    var defaults = {
      toggler:         '.toggler',
      toggler_content: '.toggler-content'
    };

    var options = $.extend(defaults, options);

    return this.each(function() {

  	  var tabgroup        = $(this);
      var toggler         = tabgroup.children().find(options.toggler);
      var toggler_content = tabgroup.children().find(options.toggler_content);

      toggler.each(function() {
        var cur_toggler = $(this);
        var cur_toggler_content = cur_toggler.next(toggler_content);

        if(cur_toggler_content.is(".active")) {
          cur_toggler_content.show();
        }
        else {
          cur_toggler_content.hide();
        }

        cur_toggler.bind('click', function() {
          if(cur_toggler.is('.active')) {
            cur_toggler.removeClass('active');
            cur_toggler_content.removeClass('active').slideUp();
          }
          else {
            if(tabgroup.is('.close-all')) {
              toggler.removeClass('active');
              toggler_content.removeClass('active').slideUp();
            }
            cur_toggler.addClass("active");
            cur_toggler_content.addClass("active").slideDown();
          }
        });

      });

    });

  };



  // Mark Right Navigation Elements
  // ------------------------------------------------------------

  $.fn.mark_right_nav_elements = function(options) {
    var defaults = {
      class_name: 'right',
      element_count: 2
    };

    var o = $.extend(defaults, options);
    var link_count = this.size();

    return this.each(function(i) {
      if((link_count - o.element_count) < i+1)
        $(this).addClass(o.class_name);
    });
  };



  // Set Image Link Type
  // ------------------------------------------------------------

  $.fn.set_img_link_type = function(options) {
    var defaults = {
      element: '#content'
    };

    var o = $.extend(defaults, options);

    $(o.element).find(
      'a[href$=jpg], '  +
      'a[href$=jpeg], ' +
      'a[href$=png], '  +
      'a[href$=gif]').each(function() { $(this).addClass('image-link'); });

    $(o.element).find(
      'a[href*="vimeo.com"], '   +
      'a[href*="youtube.com"], ' +
      'a[href$=".swf"], ' +
      'a[href$=".mov"]').each(function() { $(this).addClass('video-link'); });
  };



  // Auto Lightbox
  // ------------------------------------------------------------

  $.fn.auto_lightbox = function(options) {
    var defaults = {
      element: '#content'
    };

    var o = $.extend(defaults, options);

    $(o.element).find('.entry-link, .external-link').each(function() {
      $(this).find('img').image_overlay();
    });

    $(o.element).find(
      'a[href$=jpg], '  +
      'a[href$=jpeg], ' +
      'a[href$=png], '  +
      'a[href$=gif], '  +
      'a[href*="vimeo.com"], '   +
      'a[href*="youtube.com"], ' +
      'a[href$=".swf"], ' +
      'a[href$=".mov"]').each(function()
    {
    	if((!$(this).attr('data-gal') || ($(this).attr('data-gal') && !$(this).attr('data-gal').match(/\lightbox/))) && !$(this).hasClass('no-lightbox')) {
    	  // If NextGen Gallery is NOT used
    	  if(!$(this).parent().hasClass('ngg-gallery-thumbnail')) {
      		$(this).find('img').image_overlay();
      		$(this).attr('data-gal', 'lightbox[content]').prettyPhoto({
          	theme:           'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default
        		overlay_gallery: false         // If set to true, a gallery will overlay the fullscreen image on mouse over
        	});
        }
      }
    });
  };



  // Image Captions
  // ------------------------------------------------------------

  $.fn.image_caption_auto_width = function() {
    return this.each(function() {
      var img = $(this).find("img");
		  var border_left  = parseInt(img.css("border-left-width"));
		  var border_right = parseInt(img.css("border-right-width"));

      $(this).css('width', img.width() + border_left + border_right);
    });
  };



  // Sliding Links
  // ------------------------------------------------------------

  $.fn.sliding_links = function(options) {

    var defaults = {
      offset: 5,
      animation_speed: 120
    };

    var options = $.extend(defaults, options);

    return $(this).each(function() {
      var pl_def = $(this).css("padding-left");
      var pr_def = $(this).css("padding-right");

      $(this).hover(
        function() {
          $(this).animate({
            paddingLeft:  parseInt(pl_def) + options.offset + "px",
            paddingRight: parseInt(pr_def) - options.offset + "px"
          }, options.animation_speed);
        },
        function() {
          bc_hover = $(this).css("background-color");
          $(this).animate({
            paddingLeft: pl_def,
            paddingRight: pr_def
          }, options.animation_speed);
        }
      );

    });

  };



})(jQuery);