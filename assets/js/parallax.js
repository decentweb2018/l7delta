(function ($) {

    $.fn.parallax = function () {
        var window_width = $(window).width();
        // Parallax Scripts
        return this.each(function (i) {
            var $this = $(this);
            $this.addClass('parallax');

            function updateParallax(initial) {
                var container_height;
                if (window_width < 601) {
                    container_height = ($this.height() > 0) ? $this.height() : $this.children(".parallax_item").height();
                }
                else {
                    container_height = ($this.height() > 0) ? $this.height() : 500;
                }
                var $img = $this.children(".parallax_item").first();
                var img_height = $img.height();
                var parallax_dist = img_height - container_height;
                var bottom = $this.offset().top + container_height;
                var top = $this.offset().top;
                var scrollTop = $(window).scrollTop();
                var windowHeight = window.innerHeight;
                var windowBottom = scrollTop + windowHeight;
                var percentScrolled = (windowBottom - top) / (container_height + windowHeight);
                var parallax = Math.round((parallax_dist * percentScrolled));

                parallax = Math.round(((bottom - windowBottom) - (bottom - windowBottom) / 1.05) * 100) / 100;


                if (initial) {
                    $img.css('display', 'block');
                }
                if ((bottom > scrollTop) && (top < (scrollTop + windowHeight))) {
                    //$img.css('transform', "translate3D(-50%," + parallax + "px, 0)");
                    $img.css('backgroundPosition', "center top " + (parallax) + "px");
                }

            }

            // Wait for image load
            $this.children(".parallax_item").one("load", function () {
                updateParallax(true);
            }).each(function () {
                if (this.complete) $(this).load();
            });

            $(window).scroll(function () {
                window_width = $(window).width();
                updateParallax(false);
            });

            $(window).resize(function () {
                window_width = $(window).width();
                updateParallax(false);
            });

            $(document).ready(function () {
                updateParallax(true);
            });

        });

    };

}(jQuery));