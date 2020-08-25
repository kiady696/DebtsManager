<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vous aller rembourser un prêt</title>
</head>
<body>
    <h1>Vous aller rembourser un prêt Mr <?php echo $trosaOfUser['nom']; ?> </h1>

<!-- Asiana recapitulatif du Trosa an'i $nom_user -->
    <h4>Total du prêt :<b>Ar <?php echo $trosaOfUser['total']; ?></b></h4>
    <h4>Remboursés :Ar<b><?php echo $rembs; ?></b></h4>
    <h4>Reste à payer :Ar<b><?php echo $reste; ?></b></h4>
    
<?php echo form_open('trosa/allegerDette/'.$trosaOfUser['id'].'/'.$trosaOfUser['iddette']); ?>

    <label for="dateRemb">Date de remboursement</label>
    <input type="text" name="dateRemb" /><br />

    <label for="montantRemb">Montant</label>
    <input type="number" name="montantRemb"></input><br />

    <input type="submit" name="submit" value="Payer" />

</form>
<?php echo validation_errors(); ?>

    

</body>
</html>