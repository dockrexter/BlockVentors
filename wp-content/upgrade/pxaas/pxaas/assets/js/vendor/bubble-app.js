(function( $, window, document, undefined ){
    $.fn.bubbleUp = function(options) {
        
        // This is the easiest way to have default options.
        // var settings = $.extend({
        //     // These are the defaults.
        //     color: "#556b2f",
        //     backgroundColor: "white"
        // }, options );

        // Canvas manipulation
        function Circle(width, height, ctx) {
            var _this = this;

            // constructor
            (function() {
                _this.pos = {};
                init();
                // console.log(_this);
            })();

            function init() {
                _this.pos.x = Math.random()*width;
                _this.pos.y = height+Math.random()*100;
                _this.alpha = 0.1+Math.random()*0.3;
                _this.scale = 0.1+Math.random()*0.4;
                _this.velocity = Math.random();
            }

            this.draw = function() {
                if(_this.alpha <= 0) {
                    init();
                }
                _this.pos.y -= _this.velocity;
                _this.alpha -= 0.0005;
                ctx.beginPath();
                ctx.arc(_this.pos.x, _this.pos.y, _this.scale*50, 0, 5 * Math.PI, false);
                ctx.fillStyle = 'rgba(255,255,255,'+ _this.alpha+')';
                ctx.fill();
            };
        }



        return this.each(function() {
            // Do something to each element here.

            var self = this,
                $this = $(this);

            var width, height, largeHeader, canvas, ctx, circles, target, animateHeader = true;

            (function(){
                width = $this.outerWidth();
                height = $this.outerHeight();
                target = {x: 0, y: height};
                canvas = document.createElement("canvas");
                canvas.className = "bubbles-canvas";
                $this.prepend(canvas);
                canvas.width = width;
                canvas.height = height;
                ctx = canvas.getContext('2d');

                
                // create particles
                circles = [];
                for(var x = 0; x < width*0.5; x++) {
                    var c = new Circle(width, height, ctx);
                    circles.push(c);
                }

                function animate() {
                    
                    if(animateHeader) {
                        ctx.clearRect(0,0,width,height);
                        for(var i in circles) {
                            circles[i].draw();
                        }
                    }
                    requestAnimationFrame(animate);
                }
                animate();
            }());
            $(window).on('resize',function(){
                width = $this.outerWidth();
                height = $this.outerHeight();
                // largeHeader.style.height = height;
                canvas.width = width;
                canvas.height = height;
            });
            $(window).on('scroll',function(){
                var doc = document.documentElement;
                // var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
                var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
                if(top > $this.offset().top + height) animateHeader = false;
                else animateHeader = true;
            });

        });
    }

}(jQuery, window, document));

jQuery('.use-bubbleUp').bubbleUp();

