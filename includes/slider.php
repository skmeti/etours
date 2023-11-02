<script src="/assets/js/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>

<!-- jssor slider scripts-->
<script type="text/javascript" src="/assets/js/jssor.slider.min.js"></script>


<script>
        jQuery(document).ready(function ($) {

            var _SlideshowTransitions = [
                 {$Duration:800,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2049,$Easing:$Jease$.$OutQuad}
            ];


            var options = {
                $FillMode: 2,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
                $AutoPlay: 1,                                    //[Optional] Auto play or not, to enable slideshow, this option must be set to greater than 0. Default value is 0. 0: no auto play, 1: continuously, 2: stop at last slide, 4: stop on click, 8: stop on user navigation (by arrow/bullet/thumbnail/drag/arrow key navigation)
                $Idle: 4000, 
                $SlideDuration: 1200, 


                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: _SlideshowTransitions,
                    $TransitionsOrder: 1,
                    $ShowLink: true
                }

            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
</script>





<div style="min-height: 50px; box-shadow: 0 0 15px #444;">
        <!-- Jssor Slider Begin -->
        
        <style>
            /* jssor slider loading skin spin css */
            .jssorl-009-spin img {
                animation-name: jssorl-009-spin;
                animation-duration: 1.6s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }

            @keyframes jssorl-009-spin {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(360deg);
                }
            }
        </style>
        <div id="slider1_container" style="visibility: hidden; position: relative; margin: 0 auto;
        top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="/assets/img/loading/static-svg/spin.svg" />
            </div>

            <!-- Slides Container -->
            <div u="slides" style="position: absolute; left: 0px; top: 0px; width: 1300px; height: 500px; overflow: hidden;">
                <?php

                $qSlider = "SELECT * FROM slider ORDER BY id";
                $rSlider = mysqli_query($db, $qSlider);
                while ($dSlider = mysqli_fetch_assoc($rSlider)){
                    echo '<div>';
                    firstImageSlider($dSlider['id']);
                    echo '</div>';
                }

                ?>
                <div data-u='any' style='position: absolute; bottom: 10px; left: 790px; border-radius: 5px; background-color: rgba(0, 0, 0, 0.6); color:#fff; padding: 0.6em; font-size: 2em;'>
                    <?php

                    if ($slider['name']) {
                        echo $slider['name'];
                    } else {
                        echo 'Dobrodošli na našu web stranicu';
                    }
                    ?>
                </div>
            </div>
            


            <!--#endregion Arrow Navigator Skin End -->
        </div>
        <!-- Jssor Slider End -->
</div>