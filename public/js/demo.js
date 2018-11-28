/**
 * demo.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2016, Codrops
 * http://www.codrops.com
 */
;(function(window) {

	'use strict';

	// taken from mo.js demos
	function isIOSSafari() {
		var userAgent;
		userAgent = window.navigator.userAgent;
		return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i);
	};

	// taken from mo.js demos
	function isTouch() {
		var isIETouch;
		isIETouch = navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
		return [].indexOf.call(window, 'ontouchstart') >= 0 || isIETouch;
	};
	
	// taken from mo.js demos
	var isIOS = isIOSSafari(),
		clickHandler = isIOS || isTouch() ? 'touchstart' : 'click';

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function Animocon(el, options) {
		this.el = el;
		this.options = extend( {}, this.options );
		extend( this.options, options );

		this.checked = false;

		this.timeline = new mojs.Timeline();
		
		for(var i = 0, len = this.options.tweens.length; i < len; ++i) {
			this.timeline.add(this.options.tweens[i]);
		}

		var self = this;
		this.el.addEventListener(clickHandler, function() {
			if( self.checked ) {
				self.options.onUnCheck();
			}
			else {
				self.options.onCheck();
				self.timeline.start();
			}
			self.checked = !self.checked;
		});
	}

	Animocon.prototype.options = {
		tweens : [
			new mojs.Burst({
				shape : 'circle',
				isRunLess: true
			})
		],
		onCheck : function() { return false; },
		onUnCheck : function() { return false; }
	};


	function init() {
		/* Icon 1 */
		var el1 = document.querySelector('button.icobutton'), el1span = el1.querySelector('span');


		/* Icon 8 */
		var el8s = document.querySelector('button.icobutton');
		el8s.each(function () {
			var el8 = this;
			var el8span = this.querySelector('span');
            var scaleCurve8 = mojs.easing.path('M0,100 L25,99.9999983 C26.2328835,75.0708847 19.7847843,0 100,0');
            new Animocon(el8, {
                tweens : [
                    // burst animation
                    new mojs.Burst({
                        parent: el8,
                        duration: 1600,
                        shape : 'circle',
                        fill: '#988ADE',
                        x: '50%',
                        y: '50%',
                        opacity: 0.6,
                        childOptions: { radius: {'rand(20,5)':0} },
                        radius: {50:110},
                        count: 28,
                        isSwirl: true,
                        swirlSize: 15,
                        isRunLess: true,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
                    }),
                    // burst animation
                    new mojs.Burst({
                        parent: el8,
                        duration: 1800,
                        delay: 300,
                        shape : 'circle',
                        fill: '#988ADE',
                        x: '50%',
                        y: '50%',
                        opacity: 0.6,
                        childOptions: {
                            radius: {'rand(20,5)':0},
                            type: 'line',
                            stroke: '#988ADE',
                            strokeWidth: 2
                        },
                        angle: {0:10},
                        radius: {140:200},
                        count: 18,
                        isRunLess: true,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
                    }),
                    // burst animation
                    new mojs.Burst({
                        parent: el8,
                        duration: 2000,
                        delay: 500,
                        shape : 'circle',
                        fill: '#988ADE',
                        x: '50%',
                        y: '50%',
                        opacity: 0.6,
                        childOptions: { radius: {'rand(20,5)':0} },
                        radius: {40:80},
                        count: 18,
                        isSwirl: true,
                        swirlSize: 15,
                        isRunLess: true,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
                    }),
                    // burst animation
                    new mojs.Burst({
                        parent: el8,
                        duration: 3000,
                        delay: 750,
                        shape : 'circle',
                        fill: '#988ADE',
                        x: '50%',
                        y: '50%',
                        opacity: 0.6,
                        childOptions: {
                            radius: {'rand(20,10)':0}
                        },
                        angle: {0:-10},
                        radius: {90:130},
                        count: 20,
                        isRunLess: true,
                        easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
                    }),
                    // icon scale animation
                    new mojs.Tween({
                        duration : 400,
                        easing: mojs.easing.back.out,
                        onUpdate: function(progress) {
                            var scaleProgress = scaleCurve8(progress);
                            el8span.style.WebkitTransform = el8span.style.transform = 'scale3d(' + progress + ',' + progress + ',1)';
                        }
                    })
                ],
                onCheck : function() {
                    el8.style.color = '#988ADE';
                },
                onUnCheck : function() {
                    el8.style.color = '#C0C1C3';
                }
            });
        });

		/* Icon 8 */

		// bursts when hovering the mo.js link
		// var molinkEl = document.querySelector('.special-link'),
		// 	moTimeline = new mojs.Timeline(),
		// 	moburst1 = new mojs.Burst({
		// 		parent: molinkEl,
		// 		duration: 1300,
		// 		shape : 'circle',
		// 		fill : [ '#988ADE', '#DE8AA0', '#8AAEDE', '#8ADEAD', '#DEC58A', '#8AD1DE' ],
		// 		x: '0%',
		// 		y: '-50%',
		// 		radius: {0:60},
		// 		count: 6,
		// 		isRunLess: true,
		// 		easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
		// 	}),
		// 	moburst2 = new mojs.Burst({
		// 		parent: molinkEl,
		// 		duration: 1600,
		// 		delay: 100,
		// 		shape : 'circle',
		// 		fill : [ '#988ADE', '#DE8AA0', '#8AAEDE', '#8ADEAD', '#DEC58A', '#8AD1DE' ],
		// 		x: '-100%',
		// 		y: '-20%',
		// 		radius: {0:120},
		// 		count: 14,
		// 		isRunLess: true,
		// 		easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
		// 	}),
		// 	moburst3 = new mojs.Burst({
		// 		parent: molinkEl,
		// 		duration: 1500,
		// 		delay: 200,
		// 		shape : 'circle',
		// 		fill : [ '#988ADE', '#DE8AA0', '#8AAEDE', '#8ADEAD', '#DEC58A', '#8AD1DE' ],
		// 		x: '130%',
		// 		y: '-70%',
		// 		radius: {0:90},
		// 		count: 8,
		// 		isRunLess: true,
		// 		easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
		// 	}),
		// 	moburst4 = new mojs.Burst({
		// 		parent: molinkEl,
		// 		duration: 2000,
		// 		delay: 300,
		// 		shape : 'circle',
		// 		fill : [ '#988ADE', '#DE8AA0', '#8AAEDE', '#8ADEAD', '#DEC58A', '#8AD1DE' ],
		// 		x: '-20%',
		// 		y: '-150%',
		// 		radius: {0:60},
		// 		count: 14,
		// 		isRunLess: true,
		// 		easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
		// 	}),
		// 	moburst5 = new mojs.Burst({
		// 		parent: molinkEl,
		// 		duration: 1400,
		// 		delay: 400,
		// 		shape : 'circle',
		// 		fill : [ '#988ADE', '#DE8AA0', '#8AAEDE', '#8ADEAD', '#DEC58A', '#8AD1DE' ],
		// 		x: '30%',
		// 		y: '-100%',
		// 		radius: {0:60},
		// 		count: 12,
		// 		isRunLess: true,
		// 		easing: mojs.easing.bezier(0.1, 1, 0.3, 1)
		// 	});
		//
		// moTimeline.add(moburst1, moburst2, moburst3, moburst4, moburst5);
		// molinkEl.addEventListener('mouseenter', function() {
		// 	moTimeline.start();
		// });
	}
	
	init();

})(window);