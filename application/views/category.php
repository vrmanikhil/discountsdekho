<!DOCTYPE html>
<?php echo $head; ?>
     <script src="/assets/js/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script>
  $( document ).ready(function() {
    $('#s').keyup(function(){
     var valThis = $(this).val().toLowerCase();
      $('.mallList>li').each(function(){
       var text = $(this).text().toLowerCase();
          (text.indexOf(valThis) == 0) ? $(this).show() : $(this).hide();            
     });
    });
  });
  </script>
    <div class="container">
        <div class="row">
            <h4 style="color:#C80237"><a href="http://www.discountsdekho.com">Home</a>/<a href="/category/<?php echo $category; ?>"><?php echo $category; ?></a></h4>
            <input type="hidden" id="category" value="<?=$category?>">
            <div class="col-lg-3">
                <h4 style="text-align: center;">FILTER BY</h4>
                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                                Locations 
                                        </h4>
                                    </div>
                                        <div class="panel-body">
                                            <ul style="padding: 0px; margin: 0px;" id="locationsList">
                                                <?php foreach ($regions as $key => $value) {
                                                    if($value['region'] == $this->input->cookie('region')){
                                                        $value['areas'] = json_decode($value['areas']);
                                                        foreach ($value['areas'] as $key2 => $value2) {?>
                                                        <li style="list-style: none">
                                                            <div class="checkbox">
                                                                <label>
                                                                  <input type="checkbox" value="<?=$value2?>" onclick="getFilteredDealsByCategory()"> <?=$value2?>
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <?php }
                                                    }
                                                }?>  
                                            </ul>
                                        </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            Sub-Category
                                        </h4>
                                    </div>
                                        <div class="panel-body">
                                            <ul style="padding: 0px; margin: 0px;" id="subCategoryList">
                                                <?php foreach ($subCategory as $key => $value) {
                                                    if($key == $category) {
                                                        foreach ($value as $key2 => $value2) {?>
                                                            <li style="list-style: none">
                                                                <div class="checkbox">
                                                                    <label>
                                                                      <input type="checkbox" value="<?=$value2?>" onclick="getFilteredDealsByCategory()"> <?=$value2?>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                <?php  }  
                                                    }
                                                 } ?>
                                            </ul>
                                        </div>   
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            Malls
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="overflow-y: scroll; height:208px;">
                                       <input placeholder="Search from listed malls" id="s" type="text" class="form-control">
                                       <ul style="padding: 0px; margin: 0px;" id="mallsList">
                                            <?php foreach ($malls as $key => $value) {?>
                                                <li style="list-style: none">
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" value="<?=$value['name']?>" onclick="getFilteredDealsByCategory()"> <?=$value['name'];?>
                                                    </label>
                                                  </div>
                                                </li>
                                            <?php } ?>                                               
                                        </ul>
                                    </div>   
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            Coupons
                                        </h4>
                                    </div>
                                        <div class="panel-body">
                                            <ul style="padding: 0px; margin: 0px;">
                                                <li style="list-style: none">
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" id="dealsWithCoupons" onclick="getFilteredDealsByCategory()"> Offers with coupons
                                                    </label>
                                                  </div>
                                            </ul>
                                        </div>
                                </div>
                            </div>
            </div>
            <div class="col-lg-9 dealContainer">
            <?php foreach ($categorydeals as $key => $value) {
            $value['images'] = json_decode(($value['images']),true); ?> 
             <div class="col-lg-4">
                <div class="dealBox">
                    <div class="heading">
                        <h2><?php echo $value['brand'] ?></h2>
                    </div>
                    <div class="body">
                        <div class="img">
                            <img src="<?php echo $value['images']['Image1'] ?>">
                        </div>
                        <div class="details">
                            <div class="detailHead">
                                <p><strong><?php echo $value['title'] ?></strong></p>
                            </div>
                            <div class="detailBody">
                                <p><strong>Offer Starts on:</strong> <span><?php echo date('d-F-Y',strtotime($value['start_date'])) ?></span></p>
                               <p><strong>Offer Ends on:</strong> <span><?php if ($value['active']==1){ ?><?php if($value['end_date'] != '0000-00-00') echo date('d-F-Y',strtotime($value['end_date']));else echo "Limited period offer"; ?><?php } else { echo "Offer Expired";} ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="viewButton">
                        <a href="/deal/<?php echo preg_replace('/[\s%&]+/','-',$value['title']).'-'.$value['id'] ?>">View Deal</a>
                    </div>
                </div>
            </div>
         <?php } ?>          
            </div>
        </div>
    </div>
<?php
    echo $foot;
   ?>  

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
    <script src="/assets/js/custom.js"></script>

</body>

</html>
