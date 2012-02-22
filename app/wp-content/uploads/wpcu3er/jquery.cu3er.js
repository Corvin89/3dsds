/* ------------------------------------------------------------------------
 CU3ER, jQuery plugin

 Developed By: MADEBYPLAY -> http://madebyplay.com/
 Version: 0.1b
------------------------------------------------------------------------- */
var CU3ER = new Object();
(function($) {
	$.fn.cu3er = function(options) {
		return this.each(function() {
			var el = $(this);
			var obj = CU3ER[$(el).attr('id')];
			CU3ER[$(el).attr('id')] = {
				isFlash: true,
				hasFlash: true,
				el: null,
				swf: null,
				currSlideNo: 1, // for api purpose //
				slidesOrder: new Array(), // for api purpose //
				version: "1.1b", // for api purpose //
				/*
				* General initiative function (checks if should be used flash or javascript)
				* Parametars: options (object)
				*/
				init: function(options) {
					if(typeof options.onSliderInit != 'undefined') {
						this.onSliderInit = options.onSliderInit;
					}
					
					var swf_version = swfobject.getFlashPlayerVersion();
					if(typeof swf_version.major != 'undefined' && swf_version.major >= 10) {
						this.hasFlash = true;
					} else {
						this.hasFlash = false;
					}
					if(typeof swf_version.major == 'undefined' || swf_version.major < 10 || options.vars.force_javascript === true || options.vars.force_2d === true || options.vars.force_simple === true) {
						this.isFlash = false;
						this.prepareJS(options);
					} else {
						this.displayVersion = 'Flash';
						this.initSWF(options);
					}
				},
				/*
				* Initiative function that makes all necessary preparations and coordinate thru other functions 
				* (generates divs for [holder, background, pre-loader ...], loads xml etc.) for flash
				* Parameters: options (object)
				*/
				initSWF: function(options) {
					
					setTimeout(function() {
						CU3ER[$(el).attr('id')].onSliderInit();
					}, 100);
					options.params.allowScriptAccess = "always";
					options.vars.id = $(el).attr('id');
					if(typeof swfobject.switchOffAutoHideShow != 'undefined') {
						swfobject.switchOffAutoHideShow();
					}
					swfobject.embedSWF(options.vars.swf_location, $(el).attr('id'), options.vars.width, options.vars.height, "10.0.0", "js/expressinstall.swf", options.vars, options.params, {name:$(el).attr('id'),id:$(el).attr('id')});
				},
				/*
				* prepares javascript, loads CU3ERPlayer and extends CU3ER object once it is loaded, and initialise CU3ER js Player
				*/
				
				prepareJS: function(options) {
					CU3ER[$(el).attr('id')].el = el;
					CU3ER[$(el).attr('id')].id = $(el).attr('id');
					if(typeof CU3ERPlayer == 'undefined') {
						if(typeof options.vars.js_location != 'undefined' && options.vars.js_location != '') {
							newLoc = options.vars.js_location;
						} else {
							var scripts = $('script');
							var regex = new RegExp(/jquery\.cu3er\.js/ig);
							var loc = null;
							scripts.each(function() {
								if(regex.test($(this).attr('src'))) {
									loc = $(this);
								}
							});
							var newLoc = $(loc).attr('src').replace(/jquery\.cu3er\.js/, '') + 'jquery.cu3er.player.js';
						}
						if ($.support.scriptEval) { 
							var head = document.getElementsByTagName("head")[0]; 
							var script = document.createElement('script');
							script.id = 'uploadScript';
							script.type = 'text/javascript';
							script.onload = function() {
								//options.el = el;
								CU3ER[$(el).attr('id')] = $.extend(true, {}, CU3ER[$(el).attr('id')], CU3ERPlayer);
								CU3ER[$(el).attr('id')].initJS(options);
							}; 
							script.src = newLoc; 
							head.appendChild(script);  
						} else {
							$.getScript(newLoc, function() {
								//options.el = el;
								CU3ER[$(el).attr('id')] = $.extend(true, {}, CU3ER[$(el).attr('id')], CU3ERPlayer);
								CU3ER[$(el).attr('id')].initJS(options);
							});
						}
					} else {
						//options.el = el;
						CU3ER[$(el).attr('id')] = $.extend(true, {}, CU3ER[$(el).attr('id')], CU3ERPlayer);
						CU3ER[$(el).attr('id')].initJS(options);
					}
				},
				/*
				 * Functions for api
				 * onTransition
				 * onSlide
				 * onLoadComplete
				 */
				onTransition: function(slideNo) {
	
				},
	
				onSlide: function(slideNo) {
	
				},
	
				onLoadComplete: function(slidesOrder) {
	
				},
				
				onSliderInit: function() {
				
				},
	
				registerFlash: function() {
					if(this.isFlash) {
						if (this.swf == null) {
							this.swf = swfobject.getObjectById($(el).attr('id'));
						}
					}
				},
	
				play: function() {
					if(this.isFlash) {
						this.registerFlash();
						this.swf.playCU3ER();
					} else {
						this.pause();

					}
				},
	
				pause: function () {
					this.registerFlash();
					this.swf.pauseCU3ER();
				},
				
				next: function() {
					this.registerFlash();
					this.swf.next();
				},

				prev: function() {
					this.registerFlash();
					this.swf.prev();
				},
				
				skipTo: function(no) {
					this.registerFlash();
					this.swf.skipTo(no-1);
				},
	
				onSlideChangeStart: function(slideNo) {
					if(this.isFlash) {
						this.currSlide = slideNo;
						this.onTransition(slideNo);
					}
				},
	
				onSlideChange: function(slideNo) {
					if(this.isFlash) {
						this.currSlide = slideNo;
						this.onSlide(slideNo);
					}
				},
				
				onLoadCompleteFlash: function(slidesOrder) {
					this.slidesOrder = String(slidesOrder).split("|");
					this.onLoadComplete(this.slidesOrder);
				}
			}
			CU3ER[$(el).attr('id')].init(options);
		});
	};
})(jQuery);
