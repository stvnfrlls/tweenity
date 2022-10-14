<?php
require_once("../utils/server.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <h1>Scan QR Code</h1>
    <a href="../index.php">Home</a>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>
            </div>
            <div class="col-md-6">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="form-horizontal">
                    <label>Scan QR Code</label>
                    <input type="text" name="qrcode_input" id="qrcode_input" class="form-control" required>
                    <input type="submit" value="present" name="present" id="present">
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table style="width: 100%; border: 1px solid black">
                    <?php
                    $get_present_student = "SELECT * FROM attendance";
                    $result = $mysqli->query($get_present_student);

                    if ($result->num_rows > 0) { ?>
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;text-align: center;">Student Number</th>
                            <th style="border: 1px solid black;text-align: center;">Time In</th>
                            <th style="border: 1px solid black;text-align: center;">Time Out</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;text-align: center;"><?php echo $row['SR_number'] ?></td>
                                <td style="border: 1px solid black;text-align: center;"><?php echo $row['A_time_in'] ?></td>
                                <td style="border: 1px solid black;text-align: center;"><?php echo $row['A_time_out'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php
                    } else { ?>
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;text-align: center;">Student Number</th>
                            <th style="border: 1px solid black;text-align: center;">Time In</th>
                            <th style="border: 1px solid black;text-align: center;">Time Out</th>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td colspan="3" style="text-align: center;">NO DATA</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then((cameras) => {
            if (cameras.length > 0) {
                if (cameras[2]) {
                    scanner.start(cameras[2]);
                } else if (cameras[1]) {
                    scanner.start(cameras[1]);
                } else {
                    scanner.start(cameras[0]);
                }            
            } else {
                alert('No Cameras');
            }
        }).catch((err) => {
            console.error(err);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('qrcode_input').value = c;

        })
    </script>
</body>

</html>