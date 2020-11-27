<script type="text/javascript" src="<?=  asset_url()?>back/js/order.js"></script>

        <div id="page-wrapper">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <h1 class="page-header">Customers List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>Customers</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                    
                    <?php 
                    
                     if ($customers != null) {
                    ?>
                    <br />
                    <form method="POST" action="<?=  site_url("customers/search");?>">
                        <div class="col-lg-4">
                            <input type="text" value="" name="keyword" id="filter" placeholder="Search customer name" class="form-control" />
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" value="Search" class="form-control btn-success" />
                        </div>
                    </form>
                    <br />
                    <br />
                    <br />
                    <table id="product-data" class="table table-bordered">
                        <thead>
                            <tr class="success">
                                <th>Customer ID</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Contact</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php
                           
                                $i=0;
                                foreach ($customers as $customer) {
                            ?>
                            
                            <tr>
                                <td><?=$customer['id'];?></td>
                                <td><?=$customer['fullname']?></td>
                                <td><?=  strtoupper($customer['gender'])?></td>
                                <td><?=$customer['age']?></td>
                                <td><?=$customer['contact']?></td>
                                <td><?=$customer['address']?></td>
                                    
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
                                echo "<li ".(($i == $current_page)?"class='active'":"")." ><a href='".  site_url("customers/$page_name/$i")."'>".$i."</a></li>";
                            }
                          ?>
                        </ul>
                      </nav>
                    
                     <?php } else {
                         echo '<br />';
                         echo 'No records found.';
                         
                     }?>
                <!-- /.col-lg-4 -->
                </div>
            <!-- /.row -->

        </div>
<script type="text/javascript" >
$(document).ready(function(){
    $("#filter").keyup(function(){
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
 
        // Loop through the comment list
        $(".table-hover tr").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
            }
        });
 
    });
});
</script>