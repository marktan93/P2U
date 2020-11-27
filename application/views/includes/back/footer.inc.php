        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

        <?php
        $role = $this->session->userdata('role');
        $uid = $this->session->userdata('uid');
        ?>
        <div class="chatbox">
            <div class="chat-header <?=($role=='merchant')?"load-admin":''?>"><span class="fullname"><?=($role=='merchant')?"Contact Admin":'Start chat'?></span> <span class="badge">0</span></div>
            <div class="chatboxwrap">
                <div id="allwrapper" class="mCustomScrollbar" data-mcs-theme="light" >
                    <div class="contentwrap ">
                        <?php
                        // if role = merchant
                        // preload ... all the data 
                        
                        ?>
                    </div>
                </div>
                <input type="text" role="<?=$role;?>" value="" class="txtboxchat" userid="<?=($role=='merchant')?$uid:''?>" placeholder="[Enter] to submit content" />
            </div>
            
        </div>
        
        
       
        <?php if ($role == 'admin') {
            $CI =& get_instance(); 
            $CI->load->model('model_user', 'user');
            $users = $CI->user->read();
        ?>
        
        <div id="merchant-list">
            <div id="merchant-header">Merchant list</div>
            <div id="listwrap" >
                <div id="chatwrap" class="mCustomScrollbar" data-mcs-theme="light">
                    <?php
                    if ($users != null) {
                        foreach ($users as $user) {
                            echo "<div value='{$user['user_id']}' class='merchant-fullname'>{$user['fullname']}  <span class='badge' id='userid{$user['user_id']}'>0</span></div>";
                        }
                    } else {
                        echo '<div class="merchant-fullname">No subscribers yet.</div>';
                    }
                    ?>
                </div>
                <div><input type="text" id="merchant-select" placeholder="Enter merchant name" /></div>
            </div>

        </div>
        <?php }?>
        
    
    
    <!-- Input file button style -->
    <script src="{path}/back/js/bootstrap-filestyle.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="{path}/back/js/sb-admin-2.js"></script>
    
    
    <script type="text/javascript">
    $(document).ready(function(){
        $(".tip-top").tooltip({placement : 'top'});
        $(".tip-right").tooltip({placement : 'right'});
        $(".tip-bottom").tooltip({placement : 'bottom'});
        $(".tip-left").tooltip({ placement : 'left'});
    });
    </script>
    
</body>

</html>
