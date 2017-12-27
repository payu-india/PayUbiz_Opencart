<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-payu" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-payu" class="form-horizontal">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-status" data-toggle="tab"><?php echo $tab_order_status_payubiz; ?></a></li>
          </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab-general"> 
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-merchant"><?php echo $entry_merchantid1; ?></label>
            <div class="col-sm-10">
              <input type="text" name="payu_merchantid1" value="<?php echo $payu_merchantid1; ?>" placeholder="<?php echo $entry_merchantid1; ?>" id="input-merchant" class="form-control" />
              <?php if ($error_merchant) { ?>
              <div class="text-danger"><?php echo $error_merchant; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_salt1; ?>"><?php echo $entry_salt1; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_salt1" value="<?php echo $payu_salt1; ?>" placeholder="<?php echo $entry_salt1; ?>" id="input-password" class="form-control" />
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-currency"><span data-toggle="tooltip" title="<?php echo $help_currency1; ?>"><?php echo $entry_currency1; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_currency1" value="<?php echo $payu_currency1; ?>" placeholder="<?php echo $entry_currency1; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_merchantid2; ?>"><?php echo $entry_merchantid2; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_merchantid2" value="<?php echo $payu_merchantid2; ?>" placeholder="<?php echo $entry_merchantid2; ?>" id="input-password" class="form-control" />
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_salt2; ?>"><?php echo $entry_salt2; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_salt2" value="<?php echo $payu_salt2; ?>" placeholder="<?php echo $entry_salt2; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-currency"><span data-toggle="tooltip" title="<?php echo $help_currency2; ?>"><?php echo $entry_currency2; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_currency2" value="<?php echo $payu_currency2; ?>" placeholder="<?php echo $entry_currency2; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_merchantid3; ?>"><?php echo $entry_merchantid3; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_merchantid3" value="<?php echo $payu_merchantid3; ?>" placeholder="<?php echo $entry_merchantid3; ?>" id="input-password" class="form-control" />
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_salt3; ?>"><?php echo $entry_salt3; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_salt3" value="<?php echo $payu_salt3; ?>" placeholder="<?php echo $entry_salt3; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-currency"><span data-toggle="tooltip" title="<?php echo $help_currency3; ?>"><?php echo $entry_currency3; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_currency3" value="<?php echo $payu_currency3; ?>" placeholder="<?php echo $entry_currency3; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_merchantid4; ?>"><?php echo $entry_merchantid4; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_merchantid4" value="<?php echo $payu_merchantid4; ?>" placeholder="<?php echo $entry_merchantid4; ?>" id="input-password" class="form-control" />
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_salt4; ?>"><?php echo $entry_salt4; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_salt4" value="<?php echo $payu_salt4; ?>" placeholder="<?php echo $entry_salt4; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-currency"><span data-toggle="tooltip" title="<?php echo $help_currency4; ?>"><?php echo $entry_currency4; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_currency4" value="<?php echo $payu_currency4; ?>" placeholder="<?php echo $entry_currency4; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_merchantid5; ?>"><?php echo $entry_merchantid5; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_merchantid5" value="<?php echo $payu_merchantid5; ?>" placeholder="<?php echo $entry_merchantid5; ?>" id="input-password" class="form-control" />
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_salt5; ?>"><?php echo $entry_salt5; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_salt5" value="<?php echo $payu_salt5; ?>" placeholder="<?php echo $entry_salt5; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-currency"><span data-toggle="tooltip" title="<?php echo $help_currency5; ?>"><?php echo $entry_currency5; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_currency5" value="<?php echo $payu_currency5; ?>" placeholder="<?php echo $entry_currency5; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_merchantid6; ?>"><?php echo $entry_merchantid6; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_merchantid6" value="<?php echo $payu_merchantid6; ?>" placeholder="<?php echo $entry_merchantid6; ?>" id="input-password" class="form-control" />
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="<?php echo $help_salt6; ?>"><?php echo $entry_salt6; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_salt6" value="<?php echo $payu_salt6; ?>" placeholder="<?php echo $entry_salt6; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-currency"><span data-toggle="tooltip" title="<?php echo $help_currency6; ?>"><?php echo $entry_currency6; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_currency6" value="<?php echo $payu_currency6; ?>" placeholder="<?php echo $entry_currency6; ?>" id="input-password" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-test"><?php echo $entry_test; ?></label>
            <div class="col-sm-10">
              <select name="payu_test" id="input-test" class="form-control">
                <?php if ($payu_test == 'live') { ?>
                <option value="live" selected="selected"><?php echo $text_live; ?></option>
                <?php } else { ?>
                <option value="live"><?php echo $text_live; ?></option>
                <?php } ?>
                <?php if ($payu_test == 'demo') { ?>
                <option value="demo" selected="selected"><?php echo $demo; ?></option>
                <?php } else { ?>
                <option value="demo"> <?php echo $demo; ?></option>
                <?php } ?>
                
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="payu_total" value="<?php echo $payu_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="payu_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $payu_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_status" id="input-status" class="form-control">
                <?php if ($payu_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="payu_sort_order" value="<?php echo $payu_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
        </div>
        <div class="tab-pane" id="tab-status">
           <!-- <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div> -->

            <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_captured_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_captured_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_captured_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_auth_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_auth_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_auth_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

             <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_bounced_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_bounced_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_bounced_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

            <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_dropped_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_dropped_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_dropped_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_failed_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_failed_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_failed_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_user_cancelled_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_user_cancelled_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_user_cancelled_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_cancelled_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_cancelled_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

            <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_inprogress_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_inprogress_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_inprogress_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

            <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_initiated_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_initiated_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_initiated_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_auto_refund_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_auto_refund_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_auto_refund_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_pending_order_status; ?></label>
            <div class="col-sm-10">
              <select name="payu_pending_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payu_pending_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>


        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>