
        <div id="page-wrapper">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <h1 class="page-header">Merchants Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>Merchants</li>
                      </ol>
                    <!--e breadcrumb-->
                    <form method="POST" action="<?=  site_url('merchants/search')?>">
                        <div class="col-lg-4">
                            <input type="text" value="" name="search" placeholder="Press enter to search" class="form-control" />
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" value="Search" class="form-control btn-success" />
                        </div>
                    </form>
                    <?php if ($merchants != null) {?>
                    <table id="product-data" class="table table-bordered">
                        <caption>Merchant's list</caption>
                        <thead>
                            <tr class="success">
                                <th>No</th>
                                <th>Passport image</th>
                                <th>Full name</th>
                                <th>IC No</th>
                                <th>Company name</th>
                                <th>Company code</th>
                                <th>Verification</th>
                                <th>Activation</th>
                                <th>Register date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php
                            $count = 1;
                                if ($merchants != null)
                                    foreach ($merchants as $merchant) {
                            ?>
                            <tr >
                                <td><?=$count++?></td>
                                <?php
                                $img = explode('.', $merchant['ic_img']);
                                $img = $img[0].'_thumb.'.$img[1];
                                ?>
                                <td><img src="{path}upload/ic/thumbnail/<?=$img;?>" height="100" width="200" /></td>
                                <td><?=$merchant['fullname'];?></td>
                                <td><?=$merchant['icno'];?></td>
                                <td><?=$merchant['company_name'];?></td>
                                <td><?=$merchant['company_code'];?></td>
                                <td><label href="#" class="btn-activate">
                                        <span class="label label-<?=(($merchant['company_verification'] == true)?'success':'danger');?>"><?=(($merchant['company_verification'] == true)?'Activated':'Deactivated');?></span>
                                    </label></td>
                                <td><label href="#" class="btn-activate">
                                        <span class="label label-<?=(($merchant['acc_activation'] == true)?'success':'danger');?>"><?=(($merchant['acc_activation'] == true)?'Activated':'Deactivated');?></span>
                                    </label></td>
                                <td><?=$merchant['last_update'];?></td>
                                <td><a href="<?=  site_url("merchants/details/".$merchant['user_id']);?>"><label style="cursor: pointer;" href="#" class="btn-activate btn-lg">
                                        <span class="label label-info">More details</span>
                                    </label></a></td>
                            </tr>
                            <?php 
                                    }
                            ?>
                        </tbody>
                    </table>
                        
                    
                    <nav style="text-align: center;" >
                        <ul class="pagination">
                          <?php
                                                      
                            for($i=1; $i<=$total_pages; $i++) {
                                echo "<li ".(($i == $current_page)?"class='active'":"")." ><a href='".  site_url("merchants/search/$i")."'>".$i."</a></li>";
                            }
                          ?>
                        </ul>
                      </nav>
                    <?php } else {
                        echo '<br /><br /><br />Merchants not found.';
                    }?>
            <!-- /.row -->

        </div>

