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
    <aside class="item"><img src="../img/fullimage1.jpg" alt="Mirror Edge"></aside>
    <aside class="item"><img src="../img/fullimage2.jpg" alt="Mirror Edge"></aside>
    <aside class="item"><img src="../img/fullimage3.jpg" alt="Mirror Edge"></aside>
</section>
    
    
<section>    
    <table>
        <!-- ---------------------------- Titre des colonnes ---------------------------- -->
        <tr>
            <th>

            </th>
            <th class="txtcenter">
                Salle de bain 
            </th>
            <th class="txtcenter">
                WC
            </th>
            <th class="txtcenter">
                Capacité
            </th>
            <th class="txtcenter">
                Tarif
            </th>
        </tr>
        <!-- ---------------------------- Chambre 1 ---------------------------- -->
        <tr>
            <td>
                chambre 1
            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
        </tr>
        <!-- ---------------------------- Chambre 2 ---------------------------- -->
        <tr>
            <td>
                njojklj
            </td>
            <td>
                kljkjljkl
            </td>
            <td>
                kljkljlkj
            </td>
            <td>
                kljjljlk
            </td>
            <td>
                kljjklj
            </td>
        </tr>
    </table>
</section>



    
    
    
    
    
    
<?php 
    echo getPiedDePage();
?>