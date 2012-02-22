$(window).load(function(){
	var $slider = $('#slider'),
		slidesHtml = $slider.html(),
		$3d = $('#effect3d'),
		$2d = $('#effect2d'),
		$type = $('a.effectType'),
		$selected = $('p.selected'),
		$dropDown = $('ul.dropDown'),
		$frame = $('<div id="slider2d-frame"/>'),
		effectType = '3d',
		effect = 'cubeUp',
		slices = 3,
		options;
		
	//present 2d slideshow for ie and older browsers				
	if( !document.createElement('canvas').getContext ) {
		$slider.removeClass('slider3d').addClass('slider2d').wrap($frame);
		$3d.children().hide();
		$('#no-3d').show();
	}
		
	$slider.ccslider();


	//slide down/up the effect lists and slice list
	$selected.click(function(){
		if( $(this).next().is(':animated') ) {
			return false;
		}
		else if( $(this).hasClass('locked') ) {
			alert('Chhose an effect first !');
			return false;
		}
		else {
			$(this).next().slideToggle(600);
			$(this).toggleClass('active');
		}
	});

	//show/hide containers for 3d/2d effects
	$type.eq(0).click(function(){
		if( $2d.is(':visible') ) {
			$2d.hide(0, function(){			
				$3d.show();
			});
		}
	});

	$type.eq(1).click(function(){
		if( $3d.is(':visible') ) {
			$3d.hide(0, function(){			
				$2d.show();
			});
		}
	});

	//find what option is selected and then process accordingly
	$dropDown.delegate('li', 'click', function(){
		var $this = $(this),
			$parent = $this.parent(),
			val = $this.data('effectname') ? $this.data('effectname') : $this.text();
			
		$parent.slideUp(600).prev().text( $this.text() );
		
		if( $parent.data('type') === '3d' ) {
			effectType = '3d';
			
			if( $parent.data('effect') ) {
				effect = val;
				
				if( $slider.hasClass('slider2d') )
					$slider.removeClass('slider2d').addClass('slider3d');
					
				if( $selected.eq(1).hasClass('locked') )
					$selected.eq(1).removeClass('locked');
			}
			else
				slices = parseInt(val);
				
			if( $slider.parent().is('#slider2d-frame') )
				$slider.unwrap();
				
			$2d.find('p.selected').text('Choose an effect');
				
			options = {effectType: effectType, effect: effect, _3dOptions: {slices: slices}};
		}
		else {
			effectType = '2d';
			effect = val;
			
			if( $slider.hasClass('slider3d') )
				$slider.removeClass('slider3d').addClass('slider2d');
			
			if( !$slider.parent().is('#slider2d-frame') )
				$slider.wrap( $frame );
				
			$3d.find('p.selected').eq(0).text('Choose an effect').end().eq(1).addClass('locked');
			
			options = {effectType: effectType, effect: effect, animSpeed: 1200};
		}
		
		$slider.empty().html(slidesHtml);
		$slider.ccslider(options);
	});
});