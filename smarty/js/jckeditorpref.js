
$(document).ready(function(){
   var tSourcingDocument = CKEDITOR.replace( 'Data[tSourcingDocument]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tSourcingDocument.setData($('#tSourcingDocument').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tSourcingDocument.updateElement();
/*	var text = CKEDITOR.instances.tSourcingDocument.getData(); */
});

$(document).ready(function(){
   var tGlobalAgreement =CKEDITOR.replace( 'Data[tGlobalAgreement]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
   $("#reset_btn").click(function(){
	  tGlobalAgreement.setData($('#tGlobalAgreement').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tGlobalAgreement.updateElement();
/*	var text = CKEDITOR.instances.tGlobalAgreement.getData(); */
});


$(document).ready(function(){
   var tPaymentTerms =CKEDITOR.replace( 'Data[tPaymentTerms]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tPaymentTerms.setData($('#tPaymentTerms').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tPaymentTerms.updateElement();
/*	var text = CKEDITOR.instances.tPaymentTerms.getData(); */
});


$(document).ready(function(){
   var tFOB = CKEDITOR.replace( 'Data[tFOB]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
   $("#reset_btn").click(function(){
	  tFOB.setData($('#tFOB').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tFOB.updateElement();
/*	var text = CKEDITOR.instances.tFOB.getData(); */
});


$(document).ready(function(){
   var tDeliveryTerms = CKEDITOR.replace( 'Data[tDeliveryTerms]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tDeliveryTerms.setData($('#tDeliveryTerms').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tDeliveryTerms.updateElement();
/*	var text = CKEDITOR.instances.tDeliveryTerms.getData(); */
});


$(document).ready(function(){
   var tShippingControl = CKEDITOR.replace( 'Data[tShippingControl]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tShippingControl.setData($('#tShippingControl').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tShippingControl.updateElement();
/*	var text = CKEDITOR.instances.tShippingControl.getData(); */
});


$(document).ready(function(){
   var tConditionsForPayment = CKEDITOR.replace( 'Data[tConditionsForPayment]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tConditionsForPayment.setData($('#tConditionsForPayment').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tConditionsForPayment.updateElement();
/*	var text = CKEDITOR.instances.tConditionsForPayment.getData(); */
});


$(document).ready(function(){
   var tPenalties = CKEDITOR.replace( 'Data[tPenalties]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tPenalties.setData($('#tPenalties').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tPenalties.updateElement();
/*	var text = CKEDITOR.instances.tPenalties.getData(); */
});


$(document).ready(function(){
   var tSpecialInstruction = CKEDITOR.replace( 'Data[tSpecialInstruction]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tSpecialInstruction.setData($('#tSpecialInstruction').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tSpecialInstruction.updateElement();
/*	var text = CKEDITOR.instances.tSpecialInstruction.getData(); */
});


$(document).ready(function(){
   var tNote = CKEDITOR.replace( 'Data[tNote]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tNote.setData($('#tNote').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tNote.updateElement();
/*	var text = CKEDITOR.instances.tNote.getData(); */
});


$(document).ready(function(){
   var tTermsAndConditions = CKEDITOR.replace( 'Data[tTermsAndConditions]', { "filebrowserBrowseUrl": "<?=$ckfinderpath?>ckfinder.html", "filebrowserImageBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "<?=$ckfinderpath?>ckfinder.html?type=Flash", "filebrowserUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "<?=$ckfinderpath?>core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" ,toolbar : 'Basic'});
	$("#reset_btn").click(function(){
	  tTermsAndConditions.setData($('#tTermsAndConditions').val());
	});
});

$("#btnOk").click(function(){
	CKEDITOR.instances.tTermsAndConditions.updateElement();
/*	var text = CKEDITOR.instances.tTermsAndConditions.getData(); */
});
