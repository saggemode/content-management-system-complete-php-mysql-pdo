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


    <div class="container carn" style="">
        <h3 class="text-center text-black">FEDERAL POLYTECHNIC NEKEDE</h3>
        <h6 class="text-center text-black">COMPUTER SCIENCE DEPARTMENT</h6>
        <div class="row">
            <blockquote class="blockquote bq-warning">
                <p>
                    Please Note that this print out is just an invoice for payment of departmental fee
                </p>
            </blockquote>
        </div>
        <br>
        <?php
        $check_query = $con->prepare('SELECT * FROM department_invoice ');
        $check_query->execute();
        if ($check_query->rowCount() > 0) {
            while ($row = $check_query->fetch()) {
                $invoice_no = $row['invoice_no'];
                $session = $row['session'];
                $amount = $row['payment'];
                $level = $row['level'];
                $fee = $row['department_fee'];
                $code = $row['confirmation_code'];

            }
        }
        ?>
        <span class="float-right">invoice no: <b><?php echo $invoice_no; ?></b></span>
        <table class="table" cellspacing="0" border="0">
            <tr>
                <td><b>Confirmation Code :</b></td>
                <td><b> <?php echo  $code; ?></b></td>
            </tr>
            <tr>
                <td><b>Full Name</b></td>
                <td><b><?php echo strtoupper($session_name); ?></b></td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td><b> <?php echo strtoupper($session_email); ?></b></td>
            </tr>

            <tr>
                <td><b>Session</b></td>
                <td><b> <?php echo $session; ?></b></td>
            </tr>
            <tr>
                <td><b>Payment For</b></td>
                <td><b> <?php echo strtoupper("$level $session_program - $fee"); ?></b></td>
            </tr>
            <tr>
                <td><b>Amount</b></td>
                <td><b># <?php echo $amount; ?></b></td>
            </tr>
        </table>

    </div>

    <?php require_once 'inc/invoice_footer.php'; ?>
