<?php
        include 'connection.php';
        $sql='SELECT * FROM users';
        $query=  mysqli_query($con, $sql)or die(mysqli_error($con));
        ?>
<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<table>
    <tr>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Telefon</th>
        <th>Gen</th>
        <th>Website</th>
        <th>Comentarii</th>
    </tr>
    <?php while($row=mysqli_fetch_array($query)){ ?>
            <tr>
            <td><?php echo $row["nume"];?></td>
            <td><?php echo $row["prenume"];?></td>
            <td><?php echo $row["telefon"];?></td>
            <td><?php echo $row["gen"];?></td>
            <td><?php echo $row["website"];?></td>
            <td><?php echo $row["comentarii"];?></td>
        <?php  } ?>
        </table>

<br/><br/>
<a href="register.php">Register</a>
