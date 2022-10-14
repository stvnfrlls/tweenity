<?php
require_once("../utils/server.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encode Grades</title>
</head>

<body>
    <h1>Encode Grades</h1>
    <a href="../index.php">Home</a>
    <!-- 
        add ng list nung students sa left side para iclick for encoding. 
        right side naman is yung buong table na pag i inputan ni teacher ng grades.
        
        i l loop yung class list sa subject tapos ganito gagawin 
        ->https://stackoverflow.com/questions/8338774/update-cart-mysql-table-update-while-loop
        naka AJAX(auto refresh) para pagka click ng nung student number sa left side 
        mag p pop up nalang yung pag e encodan sa right side
    -->
    <!-- 
            <div class="wrapper">
        <form action="<?php $_SERVER[" PHP_SELF"] ?>" method="post">
            <table style="width: 100%">
                <tr>
                    <th>Student Number:</th>
                    <?php
                    $getClasslist = "SELECT * FROM classlist";
                    $result = $mysqli->query($getClasslist);

                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                        <td>
                            <input type="text" name="SR_number[<?php echo $row['SR_number'] ?>]" value="<?php echo $row['SR_number'] ?>" readonly>
                            <input type="hidden" name="cl_id[<?php echo $row['CL_id'] ?>]" value="<?php echo $row['SR_number'] ?>">
                            <input type="submit" name="encode_this_sr_number" value="Encode">
                        </td>
                    <?php
                    if (isset($_POST['encode_this_sr_number'])) {
                        foreach ($_POST['cl_id'] as $key => $cl_id) {
                            echo $_POST['cl_id']['$key'];
                        }
                    }
                    }
                    ?>
                </tr>
            </table>
        </form>
    </div>
    -->
</body>

</html>