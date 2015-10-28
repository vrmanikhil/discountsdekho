<?php echo $head; ?>
    <section id="merchant">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">TESTIMONIALS</h2>
                </div>
            </div>
                       <div class="row">
                        <?php foreach ($testimonials as $key => $value) { ?>
                <div class="col-sm-4">
                    <div class="team-member">
                       
                        <h4><?php echo $value['name']; ?></h4>
                        <p class="text-muted"><?php echo $value['testimonial']; ?></p>
                       
                    </div>
                </div>
                
               <?php } ?>
            </div>
    </section>

    <?php
        echo $foot;
    ?>


    <!-- jQuery -->
    <script src="/assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="/assets/js/classie.js"></script>
    <script src="/assets/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="/assets/js/jqBootstrapValidation.js"></script>
    <script src="/assets/js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/assets/js/agency.js"></script>

</body>

</html>
