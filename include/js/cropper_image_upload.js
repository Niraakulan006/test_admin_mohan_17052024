// JavaScript Document
jQuery(document).ready(function() {
	if(jQuery('#logo').length > 0) {
		jQuery('#logo').change(function(event) {
			if(jQuery('#logo_cover').find('.alert').length > 0) {
				jQuery('#logo_cover').find('.alert').remove();
			}
			var count = jQuery(this).get(0).files.length;
			if(count != 0) {
				upload_files(this, 'logo', '0');
			}
		});	
	}
});

function upload_files(obj, field, cropper) {
	var fileName = jQuery(obj).get(0).files[0];	
	var image_type = fileName.type;
				
	var idxDot = fileName.name.lastIndexOf(".") + 1;
	var extFile = fileName.name.substr(idxDot, fileName.name.length).toLowerCase();
	if(extFile=="jpg" || extFile=="jpeg" || extFile=="png") {
		var image_size = fileName.size;
		if(image_size < 2000000) {
			var width = ""; var height = "";		
			var reader = new FileReader();				
			reader.readAsDataURL(fileName);					
			reader.onload = function(event) {
				var image = new Image();
				image.src = event.target.result;
				image.onload = function() {
					if(cropper == 1) {
						jQuery("#"+field+"_preview").fadeIn("fast").attr('src',event.target.result);
						width = this.width;
						height = this.height;
						start(field, width, height, image_type);
					}
					else {
						var width = ""; var height = "";
						/*if(field == "home_banner") { width = 1500; height = 500; }
						else { */ width = this.width; height = this.height; //}

						if(this.width == parseInt(width) && this.height == parseInt(height)) {
							jQuery("#"+field+"_preview").fadeIn("fast").attr('src',event.target.result);
							var image_url = event.target.result;
							var request = jQuery.ajax({ url: "image_upload.php", type: "POST", data: {"image_url" : image_url, "image_type" : image_type, "field" : field}});							
							request.done(function(result) {
								var msg = result;
								jQuery('#'+field+'_cover .cover').html(msg);
							});
						}
						else {
							if(jQuery('div.alert').length > 0) {
								jQuery('div.alert').remove();
							}
							jQuery('#'+field+'_cover .cover').before('<div class="alert alert-danger w-100 text-center">Give Image size should be required size</div>');
						}
						
					}
				}
			}
		}
		else {
			if(jQuery('div.alert').length > 0) {
				jQuery('div.alert').remove();
			}
			jQuery('#'+field+'_cover .cover').before('<div class="alert alert-danger w-100 text-center">Image size is greater than 2MB</div>');
		}
		
	}
	else if(extFile=="pdf") {
		var width = ""; var height = "";		
		var reader = new FileReader();				
		reader.readAsDataURL(fileName);					
		reader.onload = function(event) {
			jQuery("#"+field+"_preview").fadeIn("fast").attr('src',event.target.result);
			var image_url = event.target.result;
			var request = jQuery.ajax({ url: "pdf_upload.php", type: "POST", data: {"image_url" : image_url, "image_type" : image_type, "field" : field}});							
			request.done(function(result) {
				var msg = result;
				jQuery('#'+field+'_cover .cover').html(msg);
			});
		}
	}
	else {
		if(jQuery('div.alert').length > 0) {
			jQuery('div.alert').remove();
		}
		jQuery('#'+field+'_cover .cover').before('<div class="alert alert-danger w-100 text-center">Please upload only Image or PDF or Excel</div>');
	}
}

var cropper;
function start(field, width, height, image_type) {	
	jQuery('#'+field+'_cover').css({"height" : height});
	jQuery('#'+field+'_cover').css({"margin-bottom" : "100px"});
	jQuery('#'+field+'_cover .'+field+'_container').css({"display" : "block"});
	jQuery('#'+field+'_cover .'+field+'_container').css({"height" : height});
	
	var canvas = document.getElementById(field+'_canvas');
	
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(document.getElementById(field+"_preview"), 0, 0, width, height, 0, 0, width, height);
	cropper = new Cropper(canvas);
	jQuery('#'+field+'_cover .image-upload').css({"display" : "none"});
	
	var string = "'"+field+"'";
	
	if(jQuery('.save_cancel').length > 0) { jQuery('.save_cancel').remove(); }
	
	if(jQuery('.save_cancel').length == 0) {
		jQuery('#'+field+'_cover .'+field+'_container').append('<div class="save_cancel form-group text-center mt-2 mb-0"><button type="button" class="btn btn-success" onclick="Javascript:save_crop_image('+string+');">Save</button> &nbsp; <button type="button" class="btn btn-danger" onclick="Javascript:delete_error_msg('+string+');">Cancel</button></div>');
	}
}

function save_crop_image(field, image_type) {
	var upload_image = cropper.getCroppedCanvas();
	var upload_image_url = upload_image.toDataURL();
		
	var request = jQuery.ajax({ url: "cropper_image_upload.php", type: "POST", data: {"image_url" : upload_image_url, "image_type" : image_type, "field" : field}});					
	request.done(function(result) {
		cropper.destroy();
		jQuery('#'+field+'_cover .image-upload').css({"display" : "block"});
		jQuery('#'+field+'_cover .'+field+'_container').css({"display" : "none"});
		var msg = result;
		jQuery('#'+field+'_cover .cover').html(msg);
		
		if(jQuery('#'+field+'_cover').find('.alert').length > 0) {
			jQuery('#'+field+'_cover').find('.alert').remove();
		}
		
		jQuery('#'+field+'_cover').css({"height" : "auto"});
		
		jQuery('#'+field+'_cover').css({"margin-bottom" : "auto"});
		
	});

}

function delete_error_msg(field, image_type) {
	jQuery('#'+field+'_cover .cover').html('<img src="include/images/upload_image.png" style="max-width: 100px;" id="'+field+'_preview"/>');
	jQuery('#'+field+'_cover .image-upload').css({"display" : "block"});
	jQuery('#'+field+'_cover').css({"height" : "auto"});
	jQuery('#'+field+'_cover').css({"margin-bottom" : "auto"});
	jQuery('#'+field+'_cover .'+field+'_container').css({"display" : "block"});
	jQuery('#'+field+'_cover .'+field+'_container').css({"height" : "auto"});
	jQuery('#'+field+'_cover #canvas').removeAttr('width').removeAttr('height').removeAttr('class');
	//jQuery('.submit_div').css({"margin-top" : "0px"});
	
	if(typeof cropper !== "undefined") {
		cropper.destroy();
	}
	
	var canvas = document.getElementById(field+'_canvas');
	canvas.width = 0;
	canvas.height = 0;
	canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
	
	if(jQuery('#'+field+'_cover .'+field+'_container .save_cancel').length > 0) {
		jQuery('#'+field+'_cover .'+field+'_container .save_cancel').remove();
	}
}

function delete_upload_image_before_save(obj, field, delete_image_file) {
	jQuery(obj).parent().html('<img src="include/images/upload_image.png" style="max-width: 100px;" id="'+field+'_preview"/>');
	
	if(typeof cropper != "undefined") {
		cropper.destroy();
	}
}

function delete_multiple_files(obj) {
	jQuery(obj).parent().remove();
	if(typeof cropper != "undefined") {
		cropper.destroy();
	}
}