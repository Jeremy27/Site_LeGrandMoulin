<?php 
    $chemin = 'inc/';
    include_once $chemin.'formatHTML.php';

    echo getEntete();
    echo getMenu();
?>


<script language="JavaScript">  
    <!-- debut  
    //alert(document.body.clientWidth);
</script>

<section class="row txtcenter">
    <aside class="col w33 tiny-w100 txtleft">test 1</aside>
    <aside class="col w33 tiny-w100">test 2</aside>
    <aside class="col w33 tiny-w100">test 3</aside>
</section>

        
<?php 
    echo getPiedDePage();
?>
