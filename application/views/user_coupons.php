<?php echo $head; ?>
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>USER ACCOUNT</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="/user_coupons" class="list-group-item active"><i class="fa fa-tags"> My Coupons</i></a>
                    <a href="/user_profile" class="list-group-item"><i class="fa fa-user"> Profile</i></a>
                    <a href="/user_change_password" class="list-group-item"><i class="fa fa-gears"> Change Password</i></a>
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
                <h3>My Coupons</h3>
                <div class="panel-body">
                 <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Deal ID</th>
                                            <th>View Deal</th>
                                            <th>Coupon Code</th>
                                            <th>Redeem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($user_coupons as $key => $value) {?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value['deal_id']; ?></td>
                                            <td><a href="/deal/<?php echo preg_replace('/[\s%&]+/','-',$value['deal_title']).'-'.$value['deal_id'] ?>">View Deal</a></td>
                                            <td><?php echo $value['coupon_code']; ?></td>
                                            <td><?php if($value['redeem'] == 0) { echo "No";} else { echo "Yes";} ?></td>
                                        </tr>
                                     <?php } ?> 
                                    </tbody>
                                </table></div></div>
            </div>
        </div>
</div>
   <?php
    echo $foot;
   ?>


    <!-- jQuery -->
    <script src="/assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/assets/js/bootstrap.min.js"></script>

    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap.min.js"></script>


    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="/assets/js/classie.js"></script>
    <script src="/assets/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="/assets/js/jqBootstrapValidation.js"></script>
    <script src="/assets/js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/assets/js/agency.js"></script>
      <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
