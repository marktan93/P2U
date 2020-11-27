

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?=  asset_url();?>back/css/plugins/blueimp/jquery.fileupload.css">

<style type="text/css">
    .text {
        z-index: 1000;
    }
</style>

        <div id="page-wrapper">
            <div class="row">
                
                <div class="col-lg-12">
                    
                    <h1 class="page-header">Card management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li><a href="<?=  site_url('card');?>">Card</a></li>
                        <li>Edit</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                   <ul class="nav nav-pills nav-justified" role="tablist">
                        <li role="presentation" ><a href="<?=  site_url('card');?>">Info</a></li>
                        <li role="presentation" class="active"><a href="<?=  site_url('card/edit');?>">Edit</a></li>
                        <li role="presentation"><a href="<?=  site_url('card/rules');?>">Rules</a></li>
                   </ul>
                    <br />
                    <br />
                    <form method="POST" action="#">
                    <div class='service_info form-horizontal col-lg-7'>
                                
                                 
                                  
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Card name</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="cardname" id="cardname" placeholder="Enter card name" class="form-control" />
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Add Text</label>
                                  <div class="col-sm-10">
                                    <input type="text" id="addtext" name="addtext" placeholder="Enter text to add" class="form-control" />
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Background color</label>
                                  <div class="col-sm-10">
                                      <input type="text" value="" class="form-control" id="picker" placeholder="Please select a background color" />
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Images</label>
                                  <div class="col-sm-10">
                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div>
                                            <span id="btn-select" class="btn btn-default btn-file">
                                                <span >Select image</span>
                                            </span>
                                            <input type="file" id="image-upload" name="product_image" style="opacity: 0; position: absolute; top: -1000px;">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <div id="text" style="display: none;">
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Font color</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="fontcolor" id="fontcolor" placeholder="Enter font color" class="form-control" />
                                  </div>
                                </div>
                                    
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Font type</label>
                                  <div class="col-sm-10">
                                    <select id="fonttype" class="form-control">
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Serif">Serif</option>
                                        <option value="Consolas">Consolas</option>
                                        <option value="Impact">Impact</option>
                                        <option value="Monospace">Monospace</option>
                                        <option value="Tahoma">Tahoma</option>
                                      </select>
                                  </div>
                                </div>
                        
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Font size</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="size" id="fontsize" placeholder="Enter font size" class="form-control" />
                                  </div>
                                </div>
                        
                                <div style="text-align: right">
                                    <input type="button" value="Delete" class="btn btndelete btn-danger btn-sm" />
                                </div>
                                <br /><br />
                        
                                </div> 
                        
                        <div id="image" style="display: none;">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Height</label>
                              <div class="col-sm-10">
                                <input type="text" name="height" id="imgheight" placeholder="Enter height" class="form-control" />
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Width</label>
                              <div class="col-sm-10">
                                <input type="text" name="width" id="imgwidth" placeholder="Enter width" class="form-control" />
                              </div>
                            </div>
                            
                            <div style="text-align: right">
                                <input type="button" value="Delete" class="btn btn-danger btndelete btn-sm" />
                            </div>
                            <br /><br />
                        </div>
                                
                    </div>
                    
                    <div class="col-lg-5">
                        <div id="preview_card" style="background-color: #FFF">
                            
                        </div>
                        <br />
                        <br />
                        
                        <div id="img_out">
                        </div>
                        
                        <div style="text-align: center">
                            <input type="button" value="Save my card" class="btn btnsave btn-success btn-lg" />
                        </div>
                        
                    </div>
                    </form>
                </div>
            <!-- /.row -->

        </div>
            

        <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
        <script src="<?=  asset_url();?>back/js/plugins/blueimp/vendor/jquery.ui.widget.js"></script>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="<?=  asset_url();?>back/js/plugins/blueimp/jquery.iframe-transport.js"></script>
        <!-- The basic File Upload plugin -->
        <script src="<?=  asset_url();?>back/js/plugins/blueimp/jquery.fileupload.js"></script>
        
        <script src="<?=  asset_url();?>back/js/plugins/html2canvas/build/html2canvas.js"></script>
        
        <script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    $('.text').draggable({containment: "parent"});

    // color picker

    $('#picker').colpick({
	layout:'hex',
	submit:0,
	colorScheme:'dark',
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		//$(el).css('background-color','#'+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val("#"+hex);
                
                // update card background color
                $('#preview_card').css('background-color', '#'+hex);
	}
    })

    // color picker
    
    $('#fontcolor').colpick({
	layout:'hex',
	submit:0,
	colorScheme:'dark',
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val("#"+hex);
                
                // update card background color
                $('.selected').css('color', '#'+hex);
	}
    })

    // update preview card

    $('#fonttype').change(function() {
        $('.selected').css('font-family', $(this).val());
    });
    
    $('#fontsize').keypress(function(e) {
        if(e.which == 13) 
            $('.selected').css('font-size', $(this).val()+'px');
    });

    $('#cardname').keypress(function(e) {
        if(e.which == 13) 
            if ($('#preview_cardname').length) {
                // element exist
                $('#preview_cardname').text($(this).val());
            } else {
                // create the element
                $('#preview_card').append('<span id="preview_cardname" class="text" style="cursor: pointer;">'+$(this).val()+'</span>');
            }
            $('.text').draggable({containment: "parent"});
    });
    
    $('#addtext').keypress(function(e) {
        if(e.which == 13) {
           $('#preview_card').append('<span class="text" style="cursor:pointer; display: inline-block;">'+$(this).val()+'</span>');
           $('.text').draggable({containment: "parent"});
           $(this).val("");
        }
    });
    
    $('#imgheight').keypress(function(e) {
        if (e.which == 13) {
            var height = 200;
            if ($(this).val() <= 200)
                height = $(this).val();
            $('.selected').attr('height', height+' px');
        }
    });
    
    $('#imgwidth').keypress(function(e) {
        if (e.which == 13) {
            var width = 390;
            if ($(this).val() <= 390) 
                width = $(this).val();
            $('.selected').attr('width', width+' px');
        }
    });
    
    $(document).click(function() {
        $('#text').slideUp();
        $('#image').slideUp();
        $('.text').removeClass('selected');
        $('.imgsize').removeClass('selected');
    });
    
    $('#text').click(function(e) {
        e.stopPropagation();
    });
    
    $('#image').click(function(e) {
        e.stopPropagation();
    });
    
    $('.colpick ').click(function(e) {
        e.stopPropagation();
    });
    
    $('.btndelete').click(function(e) {
        $('.selected').remove();
    });
    
    // show settings on preview card's element
    $(document).on('click', '.text', function(e) {
        $('#text').slideDown('fast');
        $('.text').removeClass('selected');
        $(this).addClass('selected');
        $('.imgsize').removeClass('selected');
        $('#image').slideUp();
        e.stopPropagation();
    });
    
    $(document).on('click', '.imgsize', function(e) {
        $('#image').slideDown('fast');
        $('.imgsize').removeClass('selected');
        $(this).addClass('selected');
        $('.text').removeClass('selected');
        $('#text').slideUp();
        e.stopPropagation();
    });    
    
    $('#btn-select').click(function() {
        $('#image-upload').click();
    });
                    
    
    $('#image-upload').change(function() {
       readURL(this);
    });
        
    $('.btnsave').click(function() {
        html2canvas($("#preview_card"), {
                onrendered: function(canvas) {
                    // display image at below
                    //document.body.appendChild(canvas);

                    // Convert and download as image 
                    var data = canvas.toDataURL('image/png');
                    
                    $.ajax({
                      type: "POST",
                      url: base_url+"card/save",
                      data: { image: data, name: $('#cardname').val() }
                    })
                    .done(function( msg ) {
                        if (msg == 'null')
                            error('Failed to save the card.');
                        else 
                            success('Successfully saved the card, please proceed to setup the card rules.');
                    });
                    
                }
            });
        
    });
        
});

// read the preview image url
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview_card').append("<img class='draggable imgsize' style='cursor:pointer;' src='"+e.target.result+"' height='100' width='100' />");
            $('.draggable').draggable({containment: "parent"});
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>