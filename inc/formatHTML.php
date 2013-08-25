<?php

function getEntete($cheminRacine="")
{
    $entete = '
        <!DOCTYPE html>
        <!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
        <!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width" />
                <title>Le Grand Moulin</title>


                <link rel="stylesheet" href="'.$cheminRacine.'css/knacss.css" />

            </head>
            <body>';
    return $entete;
}

function getMenu($cheminRacine="")
{
    $menu = '
        <nav class="top-bar">
            <ul class="title-area">
                <li class="name">
                    <a href="#"><img src="'.$cheminRacine.'img/LGM.png" alt="Smiley face" width="240"/></a>
                </li>
                <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
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
                    <ul class="right">
                        <li><a href="#">Se connecter</a></li>
                    </ul>
                </section>
            </ul>
        </nav> ';
    return $menu;
}

function getPiedDePage()
{
    $piedDePage = '
        </body>
    </html>';
    return $piedDePage;
}

?>
