<script type="text/javascript" charset="utf-8">
	var ret = true;
	var clicked = false;
	var thickDims, tbWidth, tbHeight;
	jQuery(document).ready(function($){
		var i = <?php echo (sizeof($slides) > 0) ? sizeof($slides) : '0'; ?>;



     var arrDefaults = new Array(<?php
      $arr = array();

      foreach ($cu3er_defaults as $key => $value) {
          $arr[] = "'$key'";
      };
      echo implode(",", $arr);
    ?>);


    arrDefaults.push("flipDirection[0]");
    arrDefaults.push("flipDirection[1]");
    arrDefaults.push("flipDirection[2]");
    arrDefaults.push("flipDirection[3]");


    var $inputs = $('#slidesAndTransitionsHolder :input');
    $inputs.live('change', function() {
       if ($(this).parent().hasClass("CU3ER-emptyValue")) {
          $(this).parent().removeClass("CU3ER-emptyValue");
       }
    });

    var $defaultInputs = $('#defaultSlidesAndTransitions :input');
    $defaultInputs.live('change', function() {
        var attribute = String(this.name).split('default[Defaults]').join('');
        var value;
        if($(this).attr('type') == 'checkbox') {
				 	value =$(this).attr('checked');
				} else if($(this).attr('type') == 'radio') {
					value =$(this).val()+"_"+$(this).attr('checked');
				} else {
					value = $(this).val();
				}
        var i = 0;
        var str="";
        var len = 1;
        while (len > 0) {
         len = 0;
         var searchStr = "#slidesAndTransitionsHolder :input[name='slide["+i+"]"+attribute;

           searchStr += "']";

         $(searchStr).each(function(index){

            if ($(this).parent().hasClass("CU3ER-emptyValue")) {
                if($(this).attr('type') == 'checkbox') {

          			  $(this).attr('checked', value);
        				} else if($(this).attr('type') == 'radio') {
                  if (($(this).val()+"_true") == value) {
                    $(this).attr('checked', true);
                  }
        				} else {
        					$(this).val(value);
                  if ($(this).hasClass("color")) {
                    $(this).css("backgroundColor", value);
                  }
        				}
            }
            len++;
         });

         str += i+",";
         i++;
        }
    });

    function assignSlideDefaultValues(no) {

       for (var i = 0; i < arrDefaults.length; i++) {
         var arrAttr = arrDefaults[i];
         if (arrAttr.indexOf("flipDirection") > -1) {
           var dirNo = arrAttr.split("flipDirection[").join("").split("]").join("");
           arrAttr = "flipDirection]["+dirNo;
         }

         $("#slidesAndTransitionsHolder :input[name='slide["+no+"]["+arrAttr+"]']").each(function(index){
            if ($(this).parent().hasClass("CU3ER-emptyValue")) {
              var value;

              if($(this).attr('type') == 'checkbox') {
                $("#defaultSlidesAndTransitions :input[name='default[Defaults]["+arrAttr+"]']").each(function(index){
                    value = $(this).attr("checked");
                });
      				 	$(this).attr('checked', value);

      				} else if($(this).attr('type') == 'radio') {
                $("#defaultSlidesAndTransitions :input[name='default[Defaults]["+arrAttr+"]']").each(function(index){
                    value = this.value+"_"+$(this).attr('checked');
                });
                if (($(this).val()+"_true") == value) {
                  $(this).attr('checked', true);
                }
      				} else {

      				  $("#defaultSlidesAndTransitions :input[name='default[Defaults]["+arrAttr+"]']").each(function(index){
                    value = $(this).val();
                });
      					$(this).val(value);
                if ($(this).hasClass("color")) {
                  $(this).css("backgroundColor", value);
                }
      				}
            }
         });
       }
    }









		$(".duplicate a").live('click', function() {
			ret = false;
			$("input[type=button], input[type=submit]").attr('disabled', true);
			var $inputs = $('#slidesAndTransitionsHolder :input');
			var values = {};
			$inputs.each(function(i) {
				var val = ($(this).parent().hasClass('CU3ER-emptyValue')) ? 'empty' : '';
				if($(this).attr('type') == 'checkbox') {
					if($(this).is(':checked')) {
						if(val != 'empty') {
							values[$(this).attr('name')] = $(this).val();
						}
					}
				} else if($(this).attr('type') == 'radio') {
					if($(this).is(':checked')) {
						if(val != 'empty') {
							values[$(this).attr('name')] = $(this).val();
						}
					}
				} else {
					if(val != 'empty') {
						values[$(this).attr('name')] = $(this).val();
					}
				}
			});
			$.ajax({
				url: '<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=newST&i=' + i + '&copy=' + $(this).attr('rel') + '&id=' + $("#slideshow_id").val(),
				data: values,
				type: 'POST',
				success: function(response) {
					$(window).scrollTop(5000);
					$("#slidesAndTransitionsHolder").append(response);
					var block = jQuery(".block:last");
					jQuery(block).fadeIn('slow');
					assignSlideDefaultValues(i);
					i++;
					ret = true;
					$("input[type=button], input[type=submit]").attr('disabled', false);
					$('.color').unbind('focus').unbind('blur').bind('focus', function() {
						lastColorInput= this;
						if (this.value != "") {
							f.setColor(this.value);
						}

						var offset = $(this).offset();
						var ths = $(this);
						$("#colorPicker").css({'position':'absolute', 'left': offset.left + 'px', 'top': (offset.top + $(ths).height() + 10) + 'px', 'backgroundColor': '#eee', 'border': '1px solid #ccc'}).stop().hide().fadeIn('normal');
					}).bind('blur', function() {
						$("#colorPicker").fadeOut('fast');
					});
					$("#slidesAndTransitionsHolder").trigger('reorder');
				}
			});

			return false;
		});


		$(".deleteProject").bind('click', function() {
			var ths = $(this);
			if(confirm('You are about to delete CU3ER project! Are you sure?')) {
				$.ajax({
					url: $(ths).attr('href'),
					dataType: 'json',
					success: function(response) {
						if(response.error == 'true') {
							alert('You can not delete this project because it is embeded in: ' + response.type);
						} else {
							$(ths).parent().parent().fadeOut('slow');
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {

					}
				});
			}
			return false;
		});
		$(".delete a").live('click', function() {
			if(confirm('You are about to delete slide & transition! Are you sure?')) {
				$(this).parent().parent().parent().empty().remove();
				$("#slidesAndTransitionsHolder").trigger('reorder');
			}
			return false;
		});
		$("#slidesAndTransitionsHolder").bind('reorder', function() {
			$("#slidesAndTransitionsHolder").find('.positionHidden').each(function(i) {
				$(this).val((i+1));
			});
		});
		$('.block-toggle').live('click', function() {
			$(this).toggleClass('close-btn');
			var el = $(this).parent();
			el.next().slideToggle('normal');
			return false;
		}).parent().next().hide();
		$(".block-inner:first").toggle('normal');
		$(".addTransition").bind('click', function() {
			ret = false;
			$("input[type=button], input[type=submit]").attr('disabled', true);
			var url = '<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=newST&i=' + i + '&id=' + $("#slideshow_id").val();
			jQuery.ajax({
				url: url,
				success: function(response) {
					$(window).scrollTop(5000);
					$("#slidesAndTransitionsHolder").append(response);
					var block = jQuery(".block:last");
					jQuery(block).fadeIn('slow');
					assignSlideDefaultValues(i);
					i++;
					ret = true;
					$("input[type=button], input[type=submit]").attr('disabled', false);
					$('.color').unbind('focus').unbind('blur').bind('focus', function() {
						lastColorInput= this;
						if (this.value != "") {
							f.setColor(this.value);
						}

						var offset = $(this).offset();
						var ths = $(this);
						$("#colorPicker").css({'position':'absolute', 'left': offset.left + 'px', 'top': (offset.top + $(ths).height() + 10) + 'px', 'backgroundColor': '#eee', 'border': '1px solid #ccc'}).stop().hide().fadeIn('normal');
					}).bind('blur', function() {
						$("#colorPicker").fadeOut('fast');
					});
				},
				error: function() {

				}
			});

		});
		$("#customSettings").bind('submit', function() {
			if(ret) {
				window.onbeforeunload=null;
				$("input[type=button], input[type=submit]").attr('disabled', true);
				var $inputs = $('#customSettings :input');
				var values = {};
				$inputs.each(function(i) {
					var val = ($(this).parent().hasClass('CU3ER-emptyValue')) ? 'empty' : '';
					if($(this).attr('type') == 'checkbox') {
						if($(this).is(':checked')) {
							if(val != 'empty') {
								values[$(this).attr('name')] = $(this).val();
							}
						}
					} else if($(this).attr('type') == 'radio') {
						if($(this).is(':checked')) {
							if(val != 'empty') {
								values[$(this).attr('name')] = $(this).val();
							}
						}
					} else {
						if(val != 'empty') {
							values[$(this).attr('name')] = $(this).val();
						}
					}
				});
				
				var href = $(this).attr('rel');
				$(".loading").css({'display':'inline'}).empty().html('Saving..');
				$.ajax({
					url: '<?php echo site_url(); ?>/wp-admin/admin.php?page=CU3ERManageAll&action=saveForPreview',
					data: values,
					type: 'POST',
					success: function(response) {
						$(".loading").empty().html('Saved!').fadeOut('normal');
						$("input[type=button], input[type=submit]").attr('disabled', false);
					}
				});
			}
			return false;
		});
		
		$(".updateXML").bind('click', function() {
			$(".formXML").toggle('fast');
			return false;
		});
		
		$("#slidesAndTransitionsHolder").sortable({
			handle: ".block-head",
			cursor: "move",
			start: function (f, d) {
				d.item.children(".block-inner").hide();
				$(".block-toggle", $(d.item)).removeClass('close-btn');
			},
			stop: function() {
				$("#slidesAndTransitionsHolder").find('.positionHidden').each(function(i) {
					$(this).val((i+1));
				});
			}
		});
		$("#slidesAndTransitionsHolder .block").addClass("ui-widget ui-widget-content ui-helper-clearfix").find( ".block-header" ).addClass("ui-widget-header");
		
		var formfield = null;
		$('.upload_image_button').live('click', function() {
			formfield = $(this).parent().find('.imageField');
			tb_show('', 'media-upload.php?post_id=<?php echo $cu3er_post_id; ?>&type=image&TB_iframe=true');
			return false;
		});
		
		$('.mbpc_preview').bind('click', function() {
			if(!clicked) {
				clicked = true;
				tb_show('', $(this).attr('href'));
				var href = $(this).attr('href');
				if(tbWidth = href.match(/&width=[0-9]+/)) {
					// tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10) + 20;
					tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
				} else {
					tbWidth = $(window).width() - 90;
				}

				if(tbHeight = href.match(/&height=[0-9]+/)) {
					// tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10) + 50;
					tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10) + 27;
				} else {
					tbHeight = $(window).height() - 60;
				}
			
				$('#TB_iframeContent').width('100%');
				thickDims();
				clicked = false;
			}
			return false;
		});
		
		$('.previewButton').bind('click', function() {
			$("input[type=button], input[type=submit]").attr('disabled', true);
			var $inputs = $('#customSettings :input');
			var values = {};
			$inputs.each(function(i) {
				var val = ($(this).parent().hasClass('CU3ER-emptyValue')) ? 'empty' : '';
				if($(this).attr('type') == 'checkbox') {
					if($(this).is(':checked')) {
						if(val != 'empty') {
							values[$(this).attr('name')] = $(this).val();
						}
					}
				} else if($(this).attr('type') == 'radio') {
					if($(this).is(':checked')) {
						if(val != 'empty') {
							values[$(this).attr('name')] = $(this).val();
						}
					}
				} else {
					if(val != 'empty') {
						values[$(this).attr('name')] = $(this).val();
					}
				}
			});
			
			var href = $(this).attr('rel');
			$(".loading").empty().html('Saving..');
			$.ajax({
				url: '<?php echo site_url(); ?>/wp-admin/admin.php?page=CU3ERManageAll&action=saveForPreview',
				data: values,
				type: 'POST',
				success: function(response) {
					$(".loading").css({'display':'inline'}).empty().html('Saved!').fadeOut('normal');
					$("input[type=button], input[type=submit]").attr('disabled', false);
					tbWidth = parseInt($("#width").val());
					tbHeight = parseInt($("#height").val()) + 27;
					tb_show('', href + '&width=' + tbWidth + '&height=' + tbHeight);
					$('#TB_iframeContent').width('100%');
					thickDims();
				}
			})
			return false;
		});
		
		thickDims = function() {
			var tbWindow = $('#TB_window'), H = $(window).height(), W = $(window).width(), w, h, top;

			w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 90;
			h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 60;

			if(tbWindow.size()) {
				tbWindow.width(w).height(h);
				$('#TB_iframeContent').width(w).height(h - 27);
				tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
				top = (H / 2) - (h / 2);
				if(typeof document.body.style.maxWidth != 'undefined') {
					tbWindow.css({'top':top + 'px','margin-top':'0'});
				}
			}
		};

<?php if($_GET['page'] == 'CU3ERManageAll' && is_numeric($_GET['id']) && $_GET['duplicate'] != true): ?>
	if(typeof $.farbtastic != 'undefined') {
	    if (!(($.browser.msie) && (Number($.browser.version.substr(0,1))<9))) {
	      var lastColorInput;
	      $('#colorPicker').css( 'display','none');
	      var f = $.farbtastic( $('#colorPicker'), function callback(color){
		 if (lastColorInput != undefined) {
		    lastColorInput.style.backgroundColor= color;
		    lastColorInput.value = color;
		    $(lastColorInput).parent().removeClass("CU3ER-emptyValue");
		    if (lastColorInput.name.indexOf("default")>-1) {
		        $(lastColorInput).trigger("change");
		    }
		 }
	      });

		$(".color").live("keyup", function() {
			if (this.value != "")
			f.setColor(this.value);
		});

		$(".color").each(function() {
			$(this).css('backgroundColor', this.value);
		});

		$(".color").bind("focus", function() {
			lastColorInput= this;
			if (this.value != "") {
				f.setColor(this.value);
			}

			var offset = $(this).offset();
			var ths = $(this);
			$("#colorPicker").css({'position':'absolute', 'left': offset.left + 'px', 'top': (offset.top + $(ths).height() + 10) + 'px', 'backgroundColor': '#eee', 'border': '1px solid #ccc'}).stop().hide().fadeIn('normal');
		});


  		$(".color").bind("blur", function() {
  			$('#colorPicker').fadeOut('fast');
  		});
	  }

    } else {
    		$(".color").live("keyup", function() {

	    	  if (this.value != "") {
	    	  	$(this).css('backgroundColor', this.value);
	    	  }


	      });
    }
<?php endif; ?>
		var images = {
			'dir': '<?php echo $slideshow["images_folder"] ?>',
			'path': '<?php echo $slideshow["project_location"] ?>'
		};
		window.send_to_editor = function(html) {
			imgurl = jQuery('img', html);
			if(imgurl.length > 0) {
				imgurl = $(imgurl).attr('src');
			} else {
				if(jQuery(imgurl).attr('src') == '') {
					imgurl = $(html).attr('href');
				} else {
					imgurl = $(html).attr('src');
				}
			}
			<?php 
			$uploadsDir = wp_upload_dir();
			$writable = true;
			if(is_writable($uploadsDir['basedir'] . '/wpcu3er')) {
				@touch($uploadsDir['basedir'] . '/wpcu3er/temp.txt');
				if(!is_writable($uploadsDir['basedir'] . '/wpcu3er/temp.txt')) {
					$writable = false;
				}
			} else {
				$writable = false;
			}
			if($writable):
			?>
			images.image = imgurl;
			jQuery.ajax({
				url: '<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=copyImage',
				type: 'POST',
				data: images,
				success: function(response) {
					if(response != 'error') {
						$(formfield).val(response);
					} else {
						alert('An error occur, please try again.');
						return false;
					}
				},
				error: function() {
					alert('An error occur, please try again.');
					return false;
				}
			});
			<?php endif; ?>
			var newImg = new Image();
			newImg.src = imgurl;
			$(formfield).parent().parent().find('.imageHolder').empty().append('<img src="'+imgurl+'" width="80" height="80">');
			$(newImg).load(function() {
				width = newImg.width;
				height = newImg.height;
				if(width > height) {
					$(formfield).parent().parent().find('.imageHolder').empty().append('<img src="'+imgurl+'" width="80">');
				} else {
					$(formfield).parent().parent().find('.imageHolder').empty().append('<img src="'+imgurl+'" height="80">');
				}
			});
			tb_remove();
		}
		$(window).resize( function() { thickDims() } );
	});
</script> 
