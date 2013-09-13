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

            </head>
            <body>';
    return $entete;
}

function getMenu($cheminRacine="")
{
    $menu = '
        <header>
            <div class="grid2-1">
                <div><img src="'.$cheminRacine.'img/LGM.png" alt="lol"/></div>
                <div>lol</div>
            </div>
        </header>

        <nav>
            <a href="#">Hotel                </a>
            <a href="#">Restaurant           </a>
            <a href="#">La ville             </a>
            <a href="#">Plan                 </a>
            <a href="#">Contact              </a>
            <a href="#">Se connecter         </a>
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
