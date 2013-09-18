<?php 
    $chemin = '../inc/';
    include_once $chemin.'formatHTML.php';

    echo getEntete('../');
    echo getMenu('../');
?>

<section class="w50 txtleft">
    <h2>Nous contacter</h2>
    <hr>
    <section class="row">
        <aside class="col w30 tiny-w100"><label for="nomContact">Votre nom : </label></aside>
        <aside class="col w70 tiny-w100"><input class="w50" type="text" name="nomContact" id="nomContact"/></aside>
    </section>
    <section class="row">
        <aside class="col w30 tiny-w100"><label for="telephoneContact">Votre num&eacute;ro de t&eacute;l&eacute;phone : </label></aside>
        <aside class="col w70 tiny-w100"><input class="w50" type="text" name="telephoneContact" id="telephoneContact"/></aside>
    </section>
    <section class="row">
        <aside class="col w30 tiny-w100"><label for="emailContact">Votre e-mail : </label></aside>
        <aside class="col w70 tiny-w100"><input class="w80" type="text" name="emailContact" id="emailContact"/></aside>
    </section>
    <section class="row">
        <aside class="col w30 tiny-w100"><label for="messageContact">Votre message : </label></aside>
        <aside class="col w70 tiny-w100"><textarea class="w100" rows="12" name="messageContact" id="messageContact"></textarea></aside>
    </section>
</section>

<?php 
    echo getPiedDePage();
?>
