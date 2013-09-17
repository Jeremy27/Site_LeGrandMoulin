<?php 
$chemin = 'inc/';
include_once '../'.$chemin.'formatHTML.php';
?>

<?php   
echo getEntete('../');
echo getMenu('../');
?>
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
    <div class="txtcenter" id="owl-demo" class="owl-carousel owl-theme">
      <div class="item"><img src="../img/fullimage1.jpg" alt="The Last of us"></div>
      <div class="item"><img src="../img/fullimage2.jpg" alt="GTA V"></div>
      <div class="item"><img src="../img/fullimage3.jpg" alt="Mirror Edge"></div>
    </div>
    
    <div>
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