<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
        <table border="1px">
            <tr>
                <td>Tompon'ny trosa</td>
                <td>Date nitrosany</td>
                <td>Totalin'ny trosany</td>
                <td>Etat</td>
            </tr>
            <?php foreach($users as $u): ?>
            <tr>
                
                <td> <?php echo $u['nom']; ?> </td>
                <td><?php echo $u['datetrosa']; ?></td>
                <td><?php echo $u['total']; ?></td>
                <td><?php echo $u['etat']; ?></td>
                <td><a href="<?php echo site_url('trosa/rembourser/'.$u['id'].'/'.$u['iddette']); ?>"> Simuler remboursement </a></td>

                
            </tr> 
            <?php endforeach; ?>   
        </table>
    <!-- Eto ny liste an'ny trosa | Tompon'ny trosa | Date nitrosany | Totalin'ny trosany | Ny efa nalohany | Reste à payer | ETAT | -->
</body>
</html>