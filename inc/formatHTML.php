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


                <link rel="stylesheet" href="'.$cheminRacine.'css/knacss.css" media="all"/>
                <link rel="stylesheet" href="'.$cheminRacine.'owl-carousel/owl.carousel.css" media="all"/>
                <link rel="stylesheet" href="'.$cheminRacine.'owl-carousel/owl.theme.css" media="all"/>
            </head>
            <body>';
    return $entete;
}

function getMenu($cheminRacine="")
{
    $menu = '
        <header class="row">
            <div class="col w75"><img src="'.$cheminRacine.'img/LGM.png" alt="lol"/></div>
            <div class="col w25 reservation"><table><tr><td><a class="center" href="#">R&eacute;server en ligne</a></td></tr></table></div>
        </header>

        <nav class="row">
            <div class="col w75">
                <a href="#">Hotel                </a>
                <a href="#">Restaurant           </a>
                <a href="#">La ville             </a>
                <a href="#">Plan                 </a>
                <a href="#">Contact              </a>
            </div>
            <div class="col w25 txtright">
                <a href="#">Se connecter</a>
            <div>
        </nav>  ';
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
