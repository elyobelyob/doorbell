<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<?php require_once 'settings.php'; ?>
<html>
<head>
    <title>Home security doorbell</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/latest/jquery.mobile.css" type="text/css">
    <link type="text/css" href="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.min.css" rel="stylesheet">
    <link type="text/css" href="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.css" rel="stylesheet">
    <link type="text/css" href="http://dev.jtsage.com/jQM-DateBox2/css/demos.css" rel="stylesheet">
    <link type="text/css" href="<?php echo "http://".$url;?>/js-slider.css" rel="stylesheet"><!-- NOTE: Script load order is significant! -->

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js">
</script>
    <script type="text/javascript" src="http://code.jquery.com/mobile/latest/jquery.mobile.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/jquery.mousewheel.min.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.datebox.min.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.flipbox.min.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.durationbox.min.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.slidebox.min.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.en_US.utf8.js">
</script>
    <script type="text/javascript" src="http://dev.jtsage.com/cdn/simpledialog/latest/jquery.mobile.simpledialog.min.js">
</script>
    <script type="text/javascript" src="<?php echo "http://".$url;?>/js-slider.js">
</script><!--<script type="text/javascript" src="demos/extras.js"></script>-->

    <script type="text/javascript" src="http://dev.jtsage.com/gpretty/prettify.js">
</script>
    <link type="text/css" href="http://dev.jtsage.com/gpretty/prettify.css" rel="stylesheet">
    <link href="<?php echo "http://".$url;?>/js/photoswipe/jquery-mobile.css" type="text/css" rel="stylesheet">
    <link href="<?php echo "http://".$url;?>/js/photoswipe/photoswipe.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo "http://".$url;?>/js/photoswipe/lib/klass.min.js">
</script>
    <script type="text/javascript" src="<?php echo "http://".$url;?>/js/photoswipe/code.photoswipe.jquery-3.0.4.min.js">
</script>
    <script type="text/javascript">

        /*
         * IMPORTANT!!!
         * REMEMBER TO ADD  rel="external"  to your anchor tags.
         * If you don't this will mess with how jQuery Mobile works
         */

        (function(window, $, PhotoSwipe){

            $(document).ready(function(){

                $('div.gallery-page')
                    .live('pageshow', function(e){

                        var
                            currentPage = $(e.target),
                            options = {},
                            photoSwipeInstance = $("ul.gallery a", e.target).photoSwipe(options,  currentPage.attr('id'));

                        return true;

                    })

                    .live('pagehide', function(e){

                        var
                            currentPage = $(e.target),
                            photoSwipeInstance = PhotoSwipe.getInstance(currentPage.attr('id'));

                        if (typeof photoSwipeInstance != "undefined" && photoSwipeInstance != null) {
                            PhotoSwipe.detatch(photoSwipeInstance);
                        }

                        return true;

                    });

            });

        }(window, window.jQuery, window.Code.PhotoSwipe));

    </script>
</head>

<body>
    <div data-role="page" id="Home">
        <div data-role="header">
            <h1>Doorbell</h1>
        </div>

        <div data-role="content">
            <div style="margin-left: 2em" data-role="listview" data-inset="true">
                <form action="ajax-doorbell.php" method="get" class="ui-body ui-body-a ui-corner-all">
                    <fieldset>
                        <div data-role="fieldcontain">
                            <ul>
                                <li style="list-style: none; display: inline">
                                    <div class="timeRangeInfo">
                                        <label for="time_slider_min">Time</label><input type="range" name="time_slider_min" id="time_slider_min" class="minTimeSlider" value="0" min="0" max="24"> <input type="range" name="time_slider_max" id="time_slider_max" class="maxTimeSlider" value="24" min="0" max="24" data-track-theme="b">
                                    </div>
                                </li>

                                <li style="list-style: none">Date : <input name="mydate" id="mydate" type="date" data-role="datebox" data-options='{"mode": "slidebox"}'></li>

                            </ul>
                        </div><button type="submit" data-theme="b" name="submit" value="submit-value">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>

        <div data-role="footer">
            <h4>Cleaveland Road</h4>
        </div>
    </div>
</body>
</html>
