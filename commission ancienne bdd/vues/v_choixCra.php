<div class="container">
 <div class="form-style-5">
<form method="post" action="index.php?uc=cra&action=afficherCra">
<fieldset>
        <legend align="center">Informations du CRA</legend><br>
<select class="select" name="idContrat">
<?php

foreach ($lesContrats as $unContrat){
        var_dump($unContrat);
    ?>

    <option value=" <?php echo $unContrat->getidContrat(); ?>"> <?php echo "Consultant : ". $unContrat->getcleconsultant()->getNom()." ".$unContrat->getcleconsultant()->getPrenom()." - Date debut : ".$unContrat->getdatedebut()." - Date fin : ".$unContrat->getdatefin() ?></option>

                                            <?php
                                            }
                                            ?> 
</select>
<input type="month" name="annee" min="<?php echo $dateMin; ?>" max="<?php echo $dateMax; ?>" required/>

<input type="submit" value="valider" name="valider" style="width: 100%!important">
</form>
 <br></div>