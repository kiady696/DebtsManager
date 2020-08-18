<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vous aller rembourser un prêt</title>
</head>
<body>
    <h1>Vous aller rembourser un prêt Mr <?php echo $nom_user; ?> </h1>

<!-- Asiana recapitulatif du Trosa an'i $nom_user -->


    <?php echo form_open('trosa/rembourser'); ?>

    <label for="datePaye">Date de Payement</label>
    <input type="text" name="datePaye" /><br />

    <label for="rembMontant">Montant</label>
    <input type="number" name="rembMontant" /><br />

    <input type="submit" name="submit" value="Payer" />

</form>

<?php echo validation_errors(); ?>


</body>
</html>