
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Inner banners Lists</li>
    </ol>
    <?php 
      $error = $this->session->flashdata('error');
      if($error) {
        ?>
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>                    
    </div>
        <?php 
      } 

      $success = $this->session->flashdata('success');
      if($success) { 
        ?>
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('success'); ?>
    </div>
        <?php 
      } 
    ?>
  <!-- Example DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>Inner banners Lists
        <?php
            if($userPermission['add']){
              ?>
          <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/banner/inner-banner-add"><i class="fa fa-plus"></i> Add New Inner Banner </a> 
          <?php
          }
          ?>
        
      </div>
        <?php 

          // pre($blogLists);
        ?>
      <div class="card-body">
        <div class="table-responsive">
          <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <?php
          if($userPermission['list']){
            ?>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
          <select name="" id="multiple_type" class="inner_banner_multiple_type multi_select" data-action="banner/delete-active-inactive-multiple-inner-banner">
                      <option value="">Select</option>
                      <?php
            if($userPermission['edit']){
              ?>
                      <option value="act">Active</option>
                      <option value="inact">Inactive</option>
                      <?php
            }
            if($userPermission['delete']){
            ?>
                      <option value="delete">Delete</option>
                      <?php
            }
            ?>
        </select>
        </div>
        <?php
            }
            ?>
          <tr>
              <th><input type="checkbox" id="checkAll" name="checkAll"></th>
              <th>SL NO</th>
              <th>Page Name</th>
              <th>Image</th>
              <th>Added / Modified Date</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          </thead>
           
            <tbody>
              <?php
              //print_r($cat_lists);
              if(!empty($bannerList)){
                $i=0;
                foreach($bannerList as $bList){
                  $i++;
                  
                ?>
              <tr id="blog-<?php echo base64_encode($bList['innerbannerId']);?>">
              <td><input type="checkbox" id="check" name="check" value="<?php echo $bList['innerbannerId']; ?>"></td>
                <td><?php echo $i ;?></td>
                <td><?php echo $bList['page_name'] ; ?></td>
                
                  <td>
                          <?php
                          if($bList['image'] != ''){
                          ?>
                            <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/banner_image/' . $bList['image']; ?>" alt="" class="preview-sml"/>
                            <?php
                          }
                          ?>
                        </td>
                <td><?php echo ($bList['modifiedOn'] != "") ? date('Y-m-d H:i:s', strtotime($bList['modifiedOn'])) : date('Y-m-d H:i:s', strtotime($bList['addedOn']));?></td>
                      
                <td><?php echo ($bList['bannerStatus'] == 1) ? "Active" : "Inactive";?></td>
                <td>
                <?php
            if($userPermission['edit']){
              ?>
                    <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/banner/inner-banner-edit/'.$bList['innerbannerId']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                    <?php
            }
            if($userPermission['delete']){
            ?>

                    <a class="btn btn-sm btn-danger deleteRow deleteBlog" href="javascript:void(0);" data-delete-href="<?php echo base_url().'admin/banner/inner-banner-delete/'.$bList['innerbannerId']; ?>" data-type="blog" title="Delete"><i class="fa fa-trash"></i></a>
                    <?php }
            ?>   
                </td>
              </tr>
                <?php
                  }
                } else {
                  ?>
              <tr id="emptyBlog">
                <td colspan="6" class="text-center">No records found</td>
              </tr>
                  <?php
                }
            ?>
            </tbody>
          </table>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
            <select name="" id="multiple_type" class="inner_banner_multiple_type multi_select" data-action="banner/delete-active-inactive-multiple-inner-banner">
                        <option value="">Select</option>
                        <?php
            if($userPermission['edit']){
              ?>
                        <option value="act">Active</option>
                        <option value="inact">Inactive</option>
                        <?php
            }
            if($userPermission['delete']){
            ?>
                        <option value="delete">Delete</option>
                        <?php
            }
            ?>
            </select> 
          </div>
          <?php
            }
          }
          ?>
           <?php echo $this->pagination->create_links(); ?>
        </div>
       
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>
  <!-- /tables-->
  </div>
  <!-- /container-fluid-->
</div>

<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this Inner Banner?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>


