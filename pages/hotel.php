<?php 
$chemin = 'inc/';
include_once '../'.$chemin.'formatHTML.php';
?>

<?php   
echo getEntete('../');
echo getMenu('../');
?>
<!-- ---------------------------------------------------------------------- Appel des fichiers javascript nécésssaire au bon fonctionnement du carousel ---------------------------------------------------------------------- -->
<script type="text/Javascript" src="../js/jquery.js">
</script>
<script type="text/Javascript" src="../owl-carousel/owl.carousel.js">
</script>
<script type="text/Javascript" src="../owl-carousel/owl.carousel.min.js">
</script>
<script type="text/Javascript">
    $(document).ready(function() {

    $("#owl-demo").owlCarousel({

        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true

        // "singleItem:true" is a shortcut for:
        // items : 1, 
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false
    });

});
</script>
    
    <!-- ---------------------------------------------------------------------- Appel des fichiers javascript nécésssaire au bon fonctionnement du carousel ---------------------------------------------------------------------- -->
<section class="txtcenter" id="owl-demo" class="owl-carousel owl-theme">
    <aside class="item">trou du cul de jérémy</aside>
    <aside class="item">jérémy jérémy </aside>
    <aside class="item"><img src="../img/fullimage3.jpg" alt="Mirror Edge"></aside>
</section>

<div class="lorem">
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
</div>

    
    
    
    
    
    
<?php 
    echo getPiedDePage();
?>