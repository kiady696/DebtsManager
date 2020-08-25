<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validation payement</title>
</head>
<body>
    <h4> valider ou annuler ce Payement : </h4>
    <table border = "1px">
        <tr>
            <td>Somme</td>
            <td>Au prêt de </td>
        </tr>
        <tr>
            <td><?php echo $PayementObject['sommepayement'];?></td>
            <td><?php echo $trosaCible['total'];?></td>
        </tr>

    </table>
    <a href="<?php echo site_url('trosa/rembourser/valider/'.$PayementObject['idpayement']); ?>"> Valider </a>
    <a href="<?php echo site_url(''); ?>"> Annuler </a>
</body>
</html>