<?php

function getEntete()
{
    $entete = '
        <!DOCTYPE html>
        <!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
        <!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width" />
                <title>Le Grand Moulin</title>


                <link rel="stylesheet" href="css/foundation.css" />


                <script src="js/vendor/custom.modernizr.js"></script>

            </head>
            <body>';
    return $entete;
}

function getMenu()
{
    $menu = '
        <nav class="top-bar">
            <ul class="title-area">
                <li class="name">
                    <a href="#"><img src="img/LGM.png" alt="Smiley face" width="240"/></a>
                </li>
                <section class="top-bar-section">
                    <ul class="left">
                        <li class="divider"></li>
                        <li><a href="#">Hotel</a></li>
                        <li class="divider"></li>
                        <li><a href="#">restaurant</a></li>
                        <li class="divider"></li>
                        <li><a href="#">La ville</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Plan</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Contact</a></li>
                        <li class="divider"></li>
                    </ul>
                </section>
            </ul>
        </nav> ';
    return $menu;
}

function getPiedDePage()
{
    $piedDePage = '
            <script>
                document.write(\'<script src=\' +
                        (\'__proto__\' in {} ? \'js/vendor/zepto\' : \'js/vendor/jquery\') +
                        \'.js><\/script>\')
            </script>

            <script src="js/foundation.min.js"></script>
            <!--

            <script src="js/foundation/foundation.js"></script>

            <script src="js/foundation/foundation.alerts.js"></script>

            <script src="js/foundation/foundation.clearing.js"></script>

            <script src="js/foundation/foundation.cookie.js"></script>

            <script src="js/foundation/foundation.dropdown.js"></script>

            <script src="js/foundation/foundation.forms.js"></script>

            <script src="js/foundation/foundation.joyride.js"></script>

            <script src="js/foundation/foundation.magellan.js"></script>

            <script src="js/foundation/foundation.orbit.js"></script>

            <script src="js/foundation/foundation.reveal.js"></script>

            <script src="js/foundation/foundation.section.js"></script>

            <script src="js/foundation/foundation.tooltips.js"></script>

            <script src="js/foundation/foundation.topbar.js"></script>

            <script src="js/foundation/foundation.interchange.js"></script>

            <script src="js/foundation/foundation.placeholder.js"></script>

            -->

            <script>
                $(document).foundation();
            </script>
        </body>
    </html>';
    return $piedDePage;
}

?>
