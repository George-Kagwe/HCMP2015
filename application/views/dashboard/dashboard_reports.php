<?php //echo "<pre>";print_r($facility_count);exit; ?>
<style>
  .select2{
    float:left!important;
    width:100%!important;
  }
  .filter_button{
    padding:8px 22px!important;
    margin:0;
    float:left;
    border-radius:0px;
    width:100%
  }
  .download{
    padding: 8px 22px !important;
    margin: 0;
    border-radius: 0px;
    width: 100%;
    float: left;
    margin-left: 2px !important;
  }
  .full-width{
    width:100%;
  }
  .excel_{
    cursor: pointer;
  }
</style>
 <div class="container body">
      <div class="main_container">
        <?php $this->load->view('dashboard/dashboard_sidebar'); ?>

        <!-- top navigation -->
        <div class="top_nav">

        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">

          <?php $this->load->view('dashboard/dashboard_top_tiles'); ?>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 x_panel">
              <div class="dashboard_graph">

                <div class="row x_title">
                <div class="col-md-12"><h2><?php echo $page_title; ?></h2></div>
                <hr/>
                <div class="col-md-12"><h5>Select the County, Subcounty and Facility</h5></div>
                
                <div class="col-md-12" style="margin-top:1%">
                  <div class="col-md-4 padding-hor-sm">
                    <select class="form-control select2 padding-hor-sm" id="county_filter">
                    <option value="0">All Counties</option>
                    <?php foreach ($county_data as $county => $value):?> 
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['county']; ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-4 padding-hor-sm">
                    <select class="form-control select2 padding-hor-sm" id="sub_county_filter">
                    <option value="0">All Subcounties</option>
                    </select>
                  </div>
                  <div class="col-md-4 padding-hor-sm">
                    <select class="form-control select2 padding-hor-sm" id="facility_id">
                    <option value="0">All Facilities</option>
                    </select>
                  </div>                     
                </div>
              <br/><br/>              
              <div class="col-md-12" style="margin-top:1%">
              <!-- <div class="col-md-6" style="margin-top:1%;float:left;"><h5>Select the Type of Report</h5></div> -->
              <div class="col-md-12" style="margin-top:1%;border:1px ridge;">
                  <div class="col-md-12" style="margin-top:1%;"><h5>Select the Type of Report</h5></div>
                  <br/>
                  <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                    <label><input type="radio" name="report_type" checked="checked" id="consumption">Consumption</label>
                  </div>
                  <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                    <label><input type="radio" name="report_type" id="stock_level">Stock Level</label>
                  </div>

                  <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                    <label><input type="radio" name="report_type" id="orders">Orders</label>
                  </div>

                  <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                    <label><input type="radio" name="report_type" id="potential_expiries">Potential Expiries</label>
                  </div>

                  <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                    <label><input type="radio" name="report_type" id="actual_expiries">Actual Expiries</label>
                  </div>
                                      
                </div>               
                <!-- <div class="col-md-6" style="margin-top:1%;float:right"><h5>Select Commodity</h5></div> -->
                <div class="col-md-12" style="margin-top:1%;border:1px ridge;">
                    <div class="col-md-12" style="margin-top:1%;"><h5>Select Commodity Category</h5></div>
                    <br/>
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="commodity_category" id="all_commodities" checked="checked">All Commodities</label>
                    </div>
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="commodity_category" id="tracer_commodities">Tracer Commodities</label>
                    </div>

                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="commodity_category" id="specific_commodity">Specify Commodity</label>                      
                    </div>   
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">                      
                    </div>   
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">                      
                    </div>   
                    <div class="col-md-12 padding-hor-sm" id="commodity_dropdown_div" style="margin-top:1%;margin-bottom:2%">
                      <div class="col-md-3 padding-hor-sm" style="margin-top:1%;">                      
                      <select class="form-control select2 padding-hor-sm" id="commodity_selected">
                      <?php
                        foreach ($commodities as $value => $commodity) :
                            $c_id = $commodity['id'];
                            $c_name = $commodity['commodity_name'];
                              echo "<option value='$c_id'>$c_name</option>";
                        endforeach;
                      ?>                        
                      </select>
                      </div>
                    </div>   
                  </div>  

                  <div id="duration_normal" class="col-md-12" style="margin-top:1%;border:1px ridge;">
                    <div class="col-md-12" style="margin-top:1%;"><h5>Select the Duration</h5></div>
                    <br/>
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="text" class="form-control clone_datepicker_normal_limit_today" name="from_date" id="from_date" placeholder="Duration"/></label>
                    </div>
                  <!--   <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="text" class="form-control clone_datepicker_normal_limit_today" name="to_date" id="to_date" placeholder="To"/></label>
                    </div> -->

                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      OR
                    </div>

                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <button type="button" class="btn btn-success generate-annual">
                      <span class="glyphicon glyphicon-file"></span>  Generate Annual Report
                      </button>
                    </div>

                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      
                    </div>
                                        
                  </div> 

                  <div id="duration_potential" class="col-md-12" style="margin-top:1%;border:1px ridge;">
                    <div class="col-md-12" style="margin-top:1%;"><h5>Select the Interval</h5></div>
                    <br/>
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="potential_interval" checked="checked">Next 3 Months</label>
                    </div>

                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="potential_interval">Next 6 Months</label>
                    </div>
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="potential_interval">Next 1 Year</label>
                    </div>


                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      
                    </div>
                                        
                  </div>     

                  <div class="col-md-12" style="margin-top:1%;border:1px ridge;">
                    <div class="col-md-12" style="margin-top:1%;"><h5>Select Comodity Size</h5></div>
                    <br/>                    
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="commodity_size" checked="checked">Packs</label>
                    </div>

                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <label><input type="radio" name="commodity_size">Units</label>
                    </div>


                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      
                    </div>
                                        
                  </div>
                  <div class="col-md-12" style="margin-top:1%;border:1px ridge;">
                    <div class="col-md-12" style="margin-top:1%;"><h5>Generate Report</h5></div>
                    <br/>                    
                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      <button type="button" class="btn btn-success generate-annual">
                      <span class="glyphicon glyphicon-file"></span>  Generate Excel Report
                      </button>
                    </div>

                    <div class="col-md-2 padding-hor-sm" style="margin-top:1%;">
                      
                    </div>
                                        
                  </div>

                </div>  
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">
            
          </div>
          <br />
         <div class="col-md-12">
           
          
                  <!-- <br /> -->
         </div>
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
    
          <div class="col-md-12">
          <center>
            <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. | All Rights Reserved
              <!-- <a data-toggle="popover" title="Experiencing any challenges?  Send an Email to hcmphelpdesk@googlegroups.com" data-content=" Send an Email to hcmphelpdesk@googlegroups.com">Report problems</a> -->
            </p>
          </center>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>




    <script type="text/javascript">
      var baseurl = '<?php echo base_url(); ?>';
      $(document).ready(function(){
      

      
      });




    </script>