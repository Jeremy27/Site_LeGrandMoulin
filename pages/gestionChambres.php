<?php
$cheminRacine = '../';

include_once $cheminRacine.'inc/formatHTML.php';

echo getEntete($cheminRacine);
echo getMenu($cheminRacine);
?>

<div class="row">
    <div class="large-12 columns">
        <h2>Gestion des chambres</h2>
        <hr />
        <form>
            <div class="row">
                <div class="small-3 large-3 columns left">
                    <label for="nomChambre" class="right inline">Nom : </label>
                </div>
                <div class="small-4 large-4 columns left">
                    <input type="text" id="nomChambre" name="nomChambre" placeholder="Nom de la chambre" required>
                </div>
            </div>
            <div class="row">
                <div class="small-3 large-3 columns left">
                    <label for="informationsChambre" class="right inline">Description : </label>
                </div>
                <div class="small-6 large-6 columns left">
                    <textarea id="informationsChambre" name="informationsChambre" placeholder="Description de la chambre" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="small-3 large-3 columns left">
                    <label for="capaciteChambre" class="right inline">Capacit&eacute; : </label>
                </div>
                <div class="small-2 large-2 columns left">
                    <input type="text" id="capaciteChambre" name="capaciteChambre" placeholder="Capacit&eacute; de la chambre" required>
                </div>
            </div>
            <div class="row">
                <div class="small-3 large-3 columns left">
                    <label for="wcChambre" class="right inline">WC : </label>
                </div>
                <div class="small-2 large-2 columns left">
                    <div class="switch small round">
                        <input id="wcExterieur" name="wcDansChambre" type="radio" checked>
                        <label for="wcExterieur" onclick="">Ext&eacute;rieur</label>

                        <input id="wcInterieur" name="wcDansChambre" type="radio">
                        <label for="wcInterieur" onclick="">Int&eacute;rieur</label>

                        <span></span>
                    </div>
                </div>
                <div class="small-2 large-2 columns left">
                    <div class="switch small round">
                        <input id="wcCommun" name="wcPartage" type="radio" checked>
                        <label for="wcCommun" onclick="">Commun</label>

                        <input id="wcNonCommun" name="wcPartage" type="radio">
                        <label for="wcNonCommun" onclick="">Priv&eacute;</label>

                        <span></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="small-3 large-3 columns left">
                    <label for="sdbChambre" class="right inline">Salle de bain : </label>
                </div>
                <div class="small-2 large-2 columns left">
                    <div class="switch small round">
                        <input id="sdbExterieur" name="sdbDansChambre" type="radio" checked>
                        <label for="sdbExterieur" onclick="">Ext&eacute;rieur</label>

                        <input id="wcInterieur" name="sdbDansChambre" type="radio">
                        <label for="sdbInterieur" onclick="">Int&eacute;rieur</label>

                        <span></span>
                    </div>
                </div>
                <div class="small-2 large-2 columns left">
                    <div class="switch small round">
                        <input id="sdbCommune" name="sdbPartagee" type="radio" checked>
                        <label for="sdbCommune" onclick="">Commune</label>

                        <input id="sdbNonCommun" name="sdbPartagee" type="radio">
                        <label for="sdbNonCommun" onclick="">Priv&eacute;e</label>

                        <span></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
echo getPiedDePage($cheminRacine);
?>
