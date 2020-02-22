<div class="list-group">
    <a href="index.php" class="list-group-item active">
        <i class="fa fa-tachometer"></i> Dashboard
    </a>

    <div id="accordion" role="tablist">
        <div class="card">
            <div class="card-header" role="tab" id="headingOne">
                <h5 class="mb-0">
                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa fa-dot-circle-o text-info"></i> Cannival Fee <i
                                class="fa fa-arrow-circle-down float-right"></i>
                    </a>
                </h5>
            </div>

            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne"
                 data-parent="#accordion">
                <div class="card-body">
                    <a href="gen_carn_invoice.php"  class="btn btn-outline-info text-info btn-block">
                       generate Carnival Fee invoice
                    </a> <br>

                    <a href="pay_carn_fee.php"  class="btn btn-outline-info text-info btn-block">
                        Pay Carnival Fee
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false"
                       aria-controls="collapseTwo">
                        <i class="fa fa-deviantart text-info"></i> Departmental Fee <i
                                class="fa fa-arrow-circle-down float-right"></i>
                    </a>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                 data-parent="#accordion">
                <div class="card-body">
                    <a href="gen_dep_invoice.php"  class="btn btn-outline-info text-info btn-block">
                       generate Department invoice
                    </a> <br>

                    <a href="pay_dept_fee.php"  class="btn btn-outline-info text-info btn-block">
                        Pay Department Fee
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false"
                       aria-controls="collapseThree">
                        <i class="fa fa-shirtsinbulk text-info"></i> T_Shirt <i
                                class="fa fa-arrow-circle-down float-right"></i>
                    </a>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                 data-parent="#accordion">
                <div class="card-body">
                     <a href="gen_tshirt_invoice.php"  class="btn btn-outline-info text-info btn-block">
                       generate T_Shirt invoice
                    </a> <br>

                    <a href="pay_tshirt_fee.php"  class="btn btn-outline-info text-info btn-block">
                        Pay Department Fee
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" role="tab" id="headingFive">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false"
                       aria-controls="collapseFive">
                        <i class="fa fa-history text-info"></i> Payment History <i
                                class="fa fa-arrow-circle-down float-right"></i>
                    </a>
                </h5>
            </div>
            <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive"
                 data-parent="#accordion">
                <div class="card-body">
                    <a href="payments.php" class="btn btn-outline-info text-info btn-block">
                        Payment History
                    </a>
                </div>
            </div>
        </div>

    </div>
    <a href="logout.php" class="list-group-item list-group-item-action">
        <i class="fa fa-power-off text-danger"></i> Log out
    </a>

</div>








