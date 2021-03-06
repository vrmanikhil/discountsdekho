<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DiscountsDekho|Shopping se Pehle Discounts Dekho</title>
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/agency.css" rel="stylesheet">
    <link href="/assets/css/etalage.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-social.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/assets/css/dealBox.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/assets/js/jquery.js"></script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "3e8a7408-39c1-4a4a-826d-461709853454", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>


<script type="text/javascript">

 window.fbAsyncInit = function() {
  FB.init({
    appId      : '1670164483230232',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });
};
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


function abc(){
FB.getLoginStatus(function(response) {
   console.log(response);
   if (response.status === 'connected') {
    FB.api('/me?fields=email,name',function(response){
      console.log(JSON.stringify(response));
      params = response;
      params.csrf_test_name = $('input[name="csrf_test_name"]').val();
      console.log(params);
      $.ajax({
        url: "/home/fbLogin",
        method: "POST",
        data:params
      })
      .done(function( data ) {
        if(data==1){
          window.location = '/';
        }
      })
      .fail(function( jqXHR, textStatus ) {
        console.log(textStatus);
      });
    })
  }
    else{
FB.login(function(response){
 FB.api('/me?fields=email,name',function(response){
     console.log(JSON.stringify(response));
      params = response;
      params.csrf_test_name = $('input[name="csrf_test_name"]').val();
      console.log(params);
      $.ajax({
        url: "/home/fbLogin",
        method: "POST",
        data:params
      })
      .done(function( data ) {
        if(data==1){
          window.location = '/';
        }
      })
      .fail(function( jqXHR, textStatus ) {
        console.log(textStatus);
      });
})
},{scope: 'email'});

    }
});

} 





</script>
</head>
<body id="page-top" class="index">
 
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div style="float:right;">
          <label>Select Region</label>                         
          <select class="btn" name="location">
          <?php foreach ($regions as $key => $value) {?>
            <option <?= ($region == $value['region'])? 'selected':''; ?> ><?= $value['region'] ?></option>
          <?php } ?>
          </select>
        </div>
        <div class="col-md-4">
        <a href="/"><img src="/assets/img/logos/web-logo.png" width="100%" style="margin-top:20px;"></a>
        </div>
        <div class="col-md-5">
          <div style="margin-top:35px;">
            <form onsubmit="window.location='/search?query='+$('#topSearchBar').val();return false;">
              <input type="text" class="form-control" required style="border:1px solid #ccc;width: 85%;display:inline-block" id="topSearchBar" placeholder="Search DiscountsDekho for deals, coupons, etc">
              <input type="submit" class="btn"  value="Go">
            </form>
          </div>
        </div>
        <div class="col-md-3">
          <div style="float:right;">
          <?php if($isLoggedIn){
            $name = explode(' ',trim($_SESSION['user_data']['name']));?>
            <span style="display: inline-block; padding: 10px; margin-top: 5px; float: left;">Welcome <label><?php echo $name[0];  ?></label></span>
            <a class="btn btn-default" style="margin-bottom: 4px; margin-top:15px;" href="/home/logout"><i class="fa fa-sign-out"> Logout</i></a>
            <br>
            <label style="float:right;"><a href="<?php if($this->session->userdata('merchantLoggedIn')){ echo "/merchant_settings"; } else if($this->session->userdata('userLoggedIn')){ echo "/user_profile"; } ?>">My Account</a></label>
            <?php } else{?>
            <button class="btn" data-toggle="modal" data-target="#myModal" style="margin-bottom: 4px; margin-top:15px;"><i class="fa fa-user"> Login</i></button>
            <button class="btn" data-toggle="modal" data-target="#myModal1" style="margin-bottom: 4px; margin-top:15px;"><i class="fa fa-users"> Register</i></button>
            <br>
          <?php } ?>
          <div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="text-align:center;" class="modal-title" id="myModalLabel">Forgot your Password?</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-lg-5">
                          <img src="/assets/img/forget_Password.png" width="100%" style="text-align: center;">
                        </div>
                        <div class="col-lg-7">
                          <div class="form-group" style="margin-top: 50px;">
                            <form class="forgotPasswordForm" onsubmit="return false;" method="post">
                              <label>Registered E-Mail Address</label>
                              <input type="email" class="form-control" required name="email" placeholder="Enter E-Mail Address">
                              <input type="hidden" name="type" value="user">
                              <input type="hidden" name="<?=$csrf_token_name ?>" value="<?=$csrf_token?>">
                              <button type="submit" class="btn btn-primary" style="float:right; margin:5px; 0px;">Send</button>
                            </form>
                          </div>                                    
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
                            </div>
                         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form action="/home/login" method="post">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 style="text-align:center;" class="modal-title" id="myModalLabel">Signin into DiscountsDekho.com</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-md-6">
                                           <img src="/assets/img/login.png" width="100%">
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Enter E-Mail Address" required autocomplete="on">
                                           </div>
                                           <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            <a data-dismiss="modal" data-toggle="modal" href="#forgot_password">Forgot your password?</a>
                                            <input type="hidden" name="<?=$csrf_token_name ?>" value="<?=$csrf_token?>">
                                            <button type="submit" class="btn btn-primary" style="float:right; margin:3px; 0px;">Login</button>
                                           </div>


                                        <div class="form-group">
                                           <a class="btn btn-block btn-social btn-facebook" onclick="abc()"><i class="fa fa-facebook"></i> Sign in with Facebook</a>
                                       </div>

                                        <div class="form-group">
                                           <a class="btn btn-block btn-social btn-twitter" href="<?php echo site_url('Twitter/redirect');?>"><i class="fa fa-twitter"></i> Sign in with Twitter</a>
                                       </div>
                                        
                                       </div>


                                        </div></div></div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                           </form>
                            </div>

                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 style="text-align:center;" class="modal-title" id="myModalLabel">Register with DiscountsDekho.com</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-md-6">
                                    <form method="post" action="/home/signup">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Full Name" required autocomplete="on">
                                           </div>
                                          <div class="form-group">
                                            <label>E-Mail Address</label>
                                            <input type="text" class="form-control" name="email" placeholder="Enter E-Mail Address" required autocomplete="on">
                                           </div>
                                           <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                           </div>
                                           <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" placeholder="City" required>
                                           </div>
                                           <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="tel" class="form-control" name="mobile" placeholder="Mobile Number" required autocomplete>
                                           </div>
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" placeholder="City" required autocomplete>
                                           </div>
                                            <div class="form-group">
                                            <label>Sex</label>
                                            <select type="text" class="form-control" name="gender">
                                                <option value="Male">Male</option>
                                                 <option value="Female">Female</option>
                                                  <option value="Prefer not to say">Prefer not to say</option>
                                            </select>
                                           </div>
                                           <input type="hidden" name="<?=$csrf_token_name ?>" value="<?=$csrf_token?>">
                                            <input type="submit" class="btn btn-primary" style="float:right; margin:3px; 0px;" value="Register">

                                       </div>
                                   </form>
                                                <div class="col-md-6">
                                           <img src="/assets/img/register.png" width="100%">
                                           <br>
                                            <div class="form-group">
                                         
                                       </div>
                                      
                                       </div>



                                        </div></div></div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                         
                            </div>

                    </div>      </div>

                </div>
            </div>

        </div>

    <!-- Navigation -->
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav menu">
                    <?php foreach ($subCategory as $key => $value) {?>
                        <li>
                            <a class="page-scroll" href="/category/<?php echo $key; ?>"><?php echo $key ?></a>
                            <div class="subMenu">
                            <p><?php echo $key ?></p>
                            <ul>
                                <?php foreach ($value as $key2 => $value2) {?>                                
                                    <li>
                                        <a href="/subcategory/<?php echo $value2; ?>" data-id=""><?php echo $value2 ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
