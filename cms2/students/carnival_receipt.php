<?php require_once 'inc/top.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}

$session_email = $_SESSION['email'];
$session_name = $_SESSION['name'];
$session_regid = $_SESSION['regid'];
$session_program = $_SESSION['program'];
$session_image = $_SESSION['image'];
$session_phone = $_SESSION['phone'];

?>

</head>

<body>

<div id="wrapper">

    <?php
    $check_query = $con->prepare('SELECT * FROM carnival_invoice ');
    $check_query->execute();
    if ($check_query->rowCount() > 0) {
        while ($row = $check_query->fetch()) {
            $name = $row['name'];
            $session = $row['session'];
            $amount = $row['payment'];
            $level = $row['level'];
            $fee = $row['carnival_fee'];
            $code = $row['confirmation_code'];

        }
    }
    ?>
    <div class="container carn " style="">
        <h3 class="text-center text-black">FEDERAL POLYTECHNIC NEKEDE</h3>
        <h6 class="text-center text-black">COMPUTER SCIENCE DEPARTMENT</h6>
        <div class="row">
            <div class="col-md-5">
                <img src="img/<?php echo $session_image; ?>" alt="" width="150px" class=" img-fluid">
            </div>
            <div class="col-md-7">
                <h5>Payment Receipt</h5>
                <h6>Generated on:  <?php echo date('d-m-y'); ?></h6>
                <h5>Confirmation Code</h5>
                <h1><b><?php echo $code; ?></b></h1>
            </div>
        </div>
        <br>
        <h5>PAYER INFORMATION </h5>
        <table class="table" cellspacing="0" border="0">
            <tr>

                <td><b>NAME :</b></td>
                <td><b> <?php echo  strtoupper($name); ?></b></td>
            </tr>
            <tr>
                <td><b>EMAIL:</b></td>
                <td><b> <?php echo  strtoupper($session_email); ?></b></td>
            </tr>
            <tr>
                <td><b>PHONE NUMBER:</b></td>
                <td><b> <?php echo  $session_phone; ?></b></td>
            </tr>
        </table>

        <h5>PAYMENT DETAILS </h5>
        <table class="table">
            <tr>
                <th>PAYMENT DATE</th>
                <th>SERVICE DESCRIPTION</th>
                <th>AMOUNT</th>
            </tr>

            <tr>
                <td>12/12/2001</td>
                <td><b><?php echo strtoupper("$level / $session_program $fee");?> </b></td>
                <td><b># <?php echo  $amount; ?></b></td>
            </tr>

        </table>
    </div>

    <?php require_once 'inc/invoice_footer.php'; ?>
