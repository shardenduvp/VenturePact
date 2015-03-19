<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/javascript/selectize/css/selectize.css" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/javascript/selectize/js/selectize.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/javascript/page1.js"></script>
<?php 
$form=$this->beginWidget('CActiveForm', array('id'=>'login-form', 'enableClientValidation'=>true,'clientOptions'=>array('validateOnSubmit'=>true,),'htmlOptions'=>array('id'=>'project-form','enctype' => 'multipart/form-data','onsubmit'=>'return validate();'))); ?>
<?php 
if(isset($_REQUEST['id']))
	echo CHtml::hiddenField('id' ,$_REQUEST['id'], array('id'=>'id')); 
else
	echo CHtml::hiddenField('docs' ,'', array('id'=>'docs')); 
?>2
<!-- START Get Started Template Container -->
 <section id="main" class="row">
	<div class="page-header" style="border:none;"> <!-- For Top Margin --> </div>
 	<!-- Get Started Form Start -->
    <div  id="project">
    	<!-- Basic Form-->
         <div class="row">
       		 <div class="col-md-12">
             <!-- panel body  BASIC FORM START -->
				<div class="panel-body pb0" id="basicProject"> 
						
                       <!--Title -->
                       	<div class="form-group pa10">
                        
                            <label class="col-sm-4 control-label">Q. Please give your job a title.<span class="text-danger">*</span></label>
                            <div class="col-sm-8" id="pss">
                            <?php echo $form->textField($project,'name',array('required'=>'required','placeholder'=>"Ex: e-Commerce app for fashion brand",'class'=>'form-control required','data-parsley-minlength'=>"2",'data-parsley-pattern'=>"^[a-zA-Z ]+$",'data-parsley-id'=>'123')); ?>
                            <?php //echo $form->error($project,'name'); ?>
                            <?php 	echo $form->hiddenField($project,'id'); ?>

                                    <ul class="parsley-errors-list" id="parsley-id-123"></ul>
                            </div>
                        </div>
                       
                        <!-- Skills -->
                        <div class="form-group pa10 border-top" >
                            <label class="col-sm-4 control-label">Q. Do you have a Language or skill preference. <span class="text-danger">*</span></label>
                            <div class="col-sm-8">

								<select id="satnam-start" class="form-control required" placeholder="Yii, Rails, Oracle SQL" multiple name="Skills[]" data-parsley-id='226'>
									<?php foreach($skills as $skill){
										//if($skill->skillcol !=0){?>
									<option value="<?php echo $skill->id;?>" <?php echo (in_array($skill->id,$selecetedSkills))?'selected="selected"':'';?> >
										<?php echo $skill->name;?>
                                    </option>
									<?php } ?>
								</select>
                                <div><ul class="parsley-errors-list" id="parsley-id-226"></ul>
                                <small class="help-block">If the job requires work on an existing application, select the language its built in. If you need design, select 'Design' as well. Select 'Not sure' if you are unsure.</small>
                                </div>
                            </div>
                        </div>
                        
                        
                       <!--Service Type-->
                        <div class="form-group border-top pa10" id="teamPart">
                            <label class="col-sm-4 control-label">Q.Please select a category. <span class="text-danger">*</span></label>
                            <div class="col-sm-8">

                                <select id="satnam-services" class="form-control required" placeholder="Web app, iOS app, ERP" multiple name="Services[]" data-parsley-id='126'>
                                <option default>Select a Service</option>
                                <?php foreach($services as $service){?>
                                <option value=" <?php echo $service->id;?>" <?php echo (in_array($service->id,$selecetedServices))?'selected="selected"':'';?> ><?php echo $service->name;?> </option>
                                <?php } ?>
                                </select>
                                <div><ul class="parsley-errors-list" id="parsley-id-126"></ul>
                                </div>
                            </div>
                        </div>
                        
                        <!--Industry-->
                          <div class="form-group border-top pa10" id="teamPart">
                            <label class="col-sm-4 control-label">Q.Please select industry. <span class="text-danger">*</span></label>
                            <div class="col-sm-8">

								<select id="satnam-industry" class="form-control required" placeholder="Web app, iOS app, ERP" multiple name="Industries[]" data-parsley-id='426'>
									<option default>Select a Industry</option>
									<?php foreach($industries as $industry){?>
									 <option value=" <?php echo $industry->id;?>" <?php echo (in_array($industry->id,$selecetedIndustries))?'selected="selected"':'';?>  ><?php echo $industry->name;?> </option>
									<?php } ?>
								</select>
                                <div><ul class="parsley-errors-list" id="parsley-id-426"></ul>
                                </div>
                            </div>
                        </div>
						 
                       <!-- Choice-->
                		<div class="form-group pa10">
                        <label class="col-md-4   ">Q. Stage of the Project? <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                      	<?php 
						$lit = CHtml::listData($currentStatus,'id','name');
						echo $form->radioButtonList($project,'current_status_id',$lit,array('separator'=>'','template'=>'<div class="radio-inline">{input} {label}</div>')); ?>   
	                    </div>
                    </div>
               	                   
                       <div class="clearfix "></div>
                       <!-- Start Date-->
                        <div class="form-group pa10">
                            <label class="col-sm-4 control-label">Q. Expected start Date. <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                            	<?php
								echo $form->radioButtonList($project,'project_start_preference',array('1'=>'Immediately','2'=>'Within the next 30 days','3'=>'No Hurry'),array('separator'=>'','template'=>'<div class="radio-inline">{input} {label}</div>')); ?>   
                            </div>
                        </div>          
                        
                       <!-- Summery--> 
						 <div class="form-group border-top pb0 pa10">
                            <label class="col-sm-4 control-label">Q. Please summarize the job. <span class="text-danger">*</span></label>

                            <div class="col-sm-8">
                               <?php echo $form->textArea($project,'description',array('placeholder'=>"Ex: We want to build an ecommerce web application selling women's purses online. We need a landing page, a product listings page, a product page and a standard checkout process. Budget permitting, we may build social logins and referral programs. The site will be design heavy as it is a fashion website.",'class'=>'form-control required','required'=>'required','rows'=>'6', 'data-parsley-maxlength'=>"3000",'maxlength'=>"3000",'data-parsley-id'=>'125','data-container'=>"body",'id'=>"bsummary")); ?>
                                    <ul class="parsley-errors-list" id="parsley-id-125"></ul>
                               <small class="help-block">Try to outline the job, the business problem at hand & your expectations. Please limit your response to 50-150 words.</small>                              
                            </div>
                        </div>                
                </div>
                
                <div class="panel-body pb0" id="productScope">
               <!-- Budget Q1 -->
                <div class="form-group pa10  border-top">
                    <div class="col-sm-12">
                        <label class="control-label col-sm-4 pl0">Q. Where do you want your developer(s) to be located? <span class="text-danger">*</span></label>
                        <div class="col-sm-8 pt5 ">
                       
                        
                        
                        	<span class="radio-inline">
                                    <label>
                                     <input type="radio" data-parsley-id="5322" data-parsley-multiple="a" name="ClientProjects[preferences]" id="customradio1" value="no-preferences"  <?php echo ($project->preferences=='no-preferences')?'checked="checked"':'';?> class="budgetClass myRadio" >
                                     No preference
                                    </label>
                                    <ul class="parsley-errors-list" id="parsley-id-multiple-a"></ul>
                            		<ul id="parsley-id-multiple-a" class="parsley-errors-list"></ul>
                            </span>
                            
                            <span class="radio-inline">
                            	<label>
                                	<input type="radio" data-parsley-id="4433" data-parsley-multiple="a" value="city" name="ClientProjects[preferences]" id="customradio2" class="budgetClass myRadio" <?php echo ($project->preferences=='city')?'checked="checked"':'';?> >In my city</label>
                                    <ul class="parsley-errors-list" id="parsley-id-multiple-a"></ul>
                                    <ul id="parsley-id-multiple-a" class="parsley-errors-list"></ul>
                            </span>
                            
                            
                            <span class="radio-inline">
                            	<label for="customradio3"><input type="radio" data-parsley-id="3557" data-parsley-multiple="a" value="country" name="ClientProjects[preferences]" id="customradio3" class="myRadio budgetClass"  <?php echo ($project->preferences=='country')?'checked="checked"':'';?> >In my country</label>
                                <ul class="parsley-errors-list" id="parsley-id-multiple-a"></ul>
                    	        <ul id="parsley-id-multiple-a" class="parsley-errors-list"></ul>
                            </span>
                            
                            <span class="radio-inline">
									
                                   <label for="customradio4"><input type="radio" data-parsley-id="3557" data-parsley-multiple="a" value="regoin" name="ClientProjects[preferences]" id="customradio4" class="budgetClass myRadio" <?php echo ($project->preferences=='regoin')?'checked="checked"':'';?> >In these regions</label>
								</span>
                                <div style="height: auto;" id="regions" class="col-sm-12 <?php echo ($project->preferences=='regoin')?'':'hide';?>">
                                        <div class="panel-body mt0 pl0 satnamAction">
										<?php $regions	=	Regions::model()->findAllBYAttributes(array('status'=>'1'));
											foreach($regions as $region){?>
                                            <div data-toggle="buttons" class="btn-group mb10 mr10"> 
                                                <label class="btn btn-sm btn-default active_success btn_new btn_rounded <?php echo (in_array($region->id,$selecetedRegions))?'active':'';?>" >
                                                <input type="checkbox" id="option<?php echo $region->id;?>" name="options[]" value="<?php echo $region->id;?>"  <?php echo (in_array($region->id,$selecetedRegions))?'checked="checked"':'';?> class="tireSelectuion" /><?php echo $region->name;?></label>
                                            </div>
                                            <?php }?>
                                            
                                        </div>
                                    </div>
                                    
                            </div>
					</div>
                </div>
                <!-- Budget Q2 -->
                <div class="form-group pt0">    
                    <div class="col-md-12 mt15">
                            <div class="panel-toolbar pl0 pt5 pb5 border-none bg-none">
                                <div class="panel-toolbar">
                                    <label class="control-label mb-15">Q. Given your geographical preferences, the following pricings are available. Please select those that match your budget. <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div novalidate action="" data-parsley-validate="" class="panel panel-default mt10">
                                
                                <div id="satnamBugdet">
                                
                                <?php $this->renderPartial('_budget', array('list'=>$list,'sel'=>$selecetedTier,'preference'=>$project->preferences,'city'=>$city,'countryName'=>$countryName,'current_status'=>$project->current_status));?>
                                </div>
                            </div>
                            <ul class="parsley-errors-list" id="parsley-id-tier-224"></ul>
                            </div>
                </div>
                <!-- Budget Q3 -->
                <div class="form-group" id="teamBudget">            
                    <div class="col-md-12">
                                <div class="form-group mt20 mb100">
                                    <label class="col-sm-4 control-label">Q. Given your selection above, what is the range of your TOTAL budget? <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="col-md-3 pl0">
                                        	<div class="col-md-2 input-group">
                                                <span class="input-group-addon">$</span>
                                                <?php echo $form->textField($project,'min_budget',array('placeholder'=>"Min",'class'=>'form-control number required from width160','data-parsley-type'=>"integer",'data-parsley-required'=>"true",'data-parsley-id'=>'129')); ?>
                                   
                                            </div>
                                            <ul class="parsley-errors-list" id="parsley-id-129"></ul>
                                        </div>
                                        <div class="col-md-3 pl0">
                                            <div class="col-md-2 input-group">
                                                <span class="input-group-addon">$</span>
                                                <?php echo $form->textField($project,'max_budget',array('placeholder'=>"Max",'class'=>'form-control number required to width160','data-parsley-type'=>"integer",'data-parsley-required'=>"true",'data-parsley-id'=>'130')); ?>
                                           </div>
                                           <ul class="parsley-errors-list" id="parsley-id-130"></ul>
                                        </div>
                                        <div class="col-md-12 pl0 pr0">
                                        	<small class="help-block">If you are not sure about your budget, feel free to <script id="timelyScript" src="https://book.gettimely.com/widget/book-button.js"> </script><div style="display:none;"><script id="hideScript">var hideButton = new timelyButton('vp', { buttonId: 'hideScript' });</script></div><a href="#" onclick="hideButton.start();">Schedule a Call</a> to talk to a software architect and get an estimate.</here></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <!-- MockUp-->
                <div class="form-group pa10">
                            <label class="col-sm-4 control-label ">Q. Please upload any mockups, designs or other documentation that will help us better understand your needs. <span class="text-danger"></span></label>
                            
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control" data-parsley-id="3057" name="attachment1[]" id="client-proj-doc">
                                    <ul class="parsley-errors-list" id="parsley-id-3057"></ul>
                                    <span class="input-group-btn ">
                                        <div class="  btn btn-primary btn-file">
                                            <span class="icon iconmoon-file-3"></span> <a href="javascript:void(0)" style="color:#FFF;" id="openBrow">Browse </a>
                                            
                                        </div>
                                    </span>
                                </div>
                               
                            </div>
                            <div class="col-sm-6">
                            	<small class="help-block">
                                                Your IP will remain secure. Please note the following in this regard:
                                                <ul>
												<li class="list">All service providers on VenturePact are legally bound by a Non-Disclosure Agreement for any client information they receive on VenturePact's marketplace.</li>
                                                <li class="list">The information you provide will only be shared with 2-5 service providers that VenturePact deems to be a good fit.</li>
                                                <li class="list">You can review the Non-Disclosure <a href="#" data-toggle="modal" data-target="#bs-modal-agreement">Agreement here</a></li>                                                 
                                                </ul>
                                </small>
                                            </div>
                            <div class="col-sm-8 pull-right mt15">
                              <table class="table table-striped">
                                                    <tbody id="ClientProjects_mockup">
                                                        
                             	<?php 
											if(count($project->clientProjectDocuments)>0){
												foreach($project->clientProjectDocuments as $doc){?>
													<tr>
                                                    <td>
                                                       <span class="label label-success"><?php echo $doc->type;?></span> <?php echo $doc->name;?> (<?php echo round($doc->size/(1024));?> KB)
                                                    </td>
                                                    <td><a href="javascript:OpenFile('<?php echo $doc->path;?>',400,500)">View</a></td>
                                                    <td><a href="javascript:void(0);" class="removeImg" rel="<?php echo $doc->id;?>">Delete</a></td>
                                                        </tr>
                                             	<?php }
											}?>
                                    </tbody></table>                                
                            </div>
						</div>  
             </div>
                <!-- panel body BASIC FORM END -->
				  
          
       		 </div>
    	 </div>
     	<!-- Budget-->
    	 <section class=" " id="productScope">
		    <div class="row">
 				  <div class="col-md-12">
        			 <input type="hidden" value="" id="savePrefName" />
                     <input type="hidden" value="" name="city_pref" id="pref-city" />
          <div class="col-md-12 mb15">
          		<div class="col-md-4"></div>
                 <div class="col-md-8 text-left">          
              <?php echo CHtml::button('Submit', array('class'=>'btn btn-primary','id'=>'projectSave'));?> 
      <?php $this->endWidget(); ?>
      </div>
      </div>
     			   </div>
    		</div>
   	</section>
	</div>
    <!-- Get Started Form End -->
</section>

<script type="text/javascript">
$('#basicProject').delegate('.otherOption','change',function(){
	if($('#stanmOther').hasClass('hide'))
		$('#stanmOther').removeClass('hide');
	else
		$('#stanmOther').addClass('hide');
});
$("#projectSave").on("click", function (event) {
	var el= $(this);
	if(!validate('project') && specialVal()){
		bootbox.dialog({
			message: "<?php echo ((Yii::app()->user->profileStatus)?'<strong>Thank you for completing the job scope</strong>. <br> <p></p>Before confirming your submission, please ensure that you have provided sufficient detail through mock ups or wireframes. Insufficient detail could delay quotes from the service providers.':'There are some required fields that have not been completed. Please complete those in order to get a good estimate from our service providers.'); ?>",
            title: "Confirm Submission",
			buttons: {
				danger: {
					label: "Cancel",
					className: "btn-danger",
					callback: function(){}
				},
                
                success: {
					label: "Confirm",
					className: "btn-success",
					callback: function() {
						<?php if(Yii::app()->user->profileStatus){?>
						$.ajax({
							type:'POST',
							url:"<?php echo CController::createUrl("/client/project");?>",
							data : $('#project-form').serialize(),
							success:function(data){
								$var = jQuery.parseJSON(data);
								if($var.code==1){
									bootbox.alert($var.message,function(){
										$(window).attr("location","<?php echo CController::createUrl("/client/index");?>");	
									}).find("div.modal-body").addClass("bgcolor-teal");
								}else{
									bootbox.alert($var.message).find("div.bootbox-body").html(
									function (){
										console.log($var);
										$var.error.each(function( index ){
											$("div.bootbox-body").append("<li>"+$( this ).text()+"</li>");
										});
									}).find("div.modal-body").addClass("bgcolor-teal");
								}
							}
						}); 
						<?php }?>
					}
				}
			}
		});
	 }else{
		 bootbox.confirm("Some required fields in the job scope are not filled. Please complete them before moving forward.", function (result) {	return true;}).find("div.modal-body").addClass("bgcolor-teal");
		
		if(!specialVal())
			$('html,body').scrollTop(700);
		
		var top=$('.parsley-error:first').offset().top;
		$('html,body').scrollTop(top-1000);
		$('.parsley-error:first').focus();
	}
	return false;
	event.preventDefault();
});

$("#satnam-start").selectize({
	delimiter: ",",
	persist: false,
	create: function (input) {
		$.ajax({
			type:'POST',
			url:"<?php echo CController::createUrl("/client/createSkill");?>",
			data : 'name='+input,
			success: function(id){		}
		});
		return {
			value: input,
			text: input
		}
	}
});


$('#ClientProjects_mockup').delegate('.removeImg','click',function(){
	var that	=	$(this);
	$.ajax({
		type:'POST',
		url:"<?php echo CController::createUrl("/client/mockup",array('id'=>$project->id));?>",
		data : 'action=delete&imageId='+that.attr('rel'),
		success:function(data){
			if(data==1){
				that.parent().parent().hide();
			}
		}
	});
});


$('#project-form').on('change',function(){changeValidate('project-form');});

function specialVal(){
	errorList	=	1;
	if($('.require-one1:checked').size() == 0){
		$('#parsley-id-tier-224').html('<li>Please select required field</li>');
		$('#parsley-id-tier-224').addClass('filled');
		errorList	=	0;
	}else{
		$('#parsley-id-tier-224').removeClass('filled');
		$('#parsley-id-tier-224').html('');
	}
	return	errorList;
}
$('.add_link').click(function(){
	var that	=	$(this);
	var clone	=	that.parent().parent().parent().find('.hide').clone(true);
	var couter	=	that.parent().parent().parent().find('.hide').find('.counterNum');
	couter.val(parseInt(couter.val())+1);
	var Sat	=	couter.find('.add_new');
	Sat.html('Screen'+couter.val());
	$(clone).attr('class', 'col-sm-12 mb5');
	$(clone).removeClass('hide');
	clone.find('.counterNum').each(function (){$(this).parent().find('span').html(''+$(this).val()+'');});	
	var sat	=	that.parent().parent().parent().parent().parent().find('.container_outer').append(clone);
});

$('.delete_link').click(function(){
	var that	=	$(this);
	var couter	=	that.parent().parent().parent().parent().find('.hide').find('.counterNum');
	that.parent().parent().hide();
	that.parent().parent().html('');
	couter.val(parseInt(couter.val())-1);
});

(function($){
	
$("#satnam-services").selectize({delimiter: ",",persist: false,});
$("#satnam-industry").selectize({delimiter: ",",persist: false,});

	$("#customradio4").on("change", function(){
		if($("#customradio4").is(":checked")){
			$("#regions").removeClass('hide');
			$("#regions").show();
			var regions	=	[];
			$("input[name='options[]']:checked").each( function () {
				regions.push($(this).val());
			});
			getData($(this).val(),regions);
		}
	})
	
	$('.satnamAction').delegate('.tireSelectuion','change', function(){
		var regions	=	[];
		$("input[name='options[]']:checked").each( function () {
			regions.push($(this).val());
		});
		getData('region',regions);
	})
	$('#customradio1').on('change', function(){
		$('#regions').hide();
		getData($(this).val(),'');
	})
	$('#customradio2').on('change', function(){
		$('#regions').hide();
		
		getData($(this).val(),'');
	})
	$('#customradio3').on('change', function(){
		$('#regions').hide();
		getData($(this).val(),'');
	});
	function getData(val,list){
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->createUrl('/client/calculate',array('id'=>$project->id));?>",
			data : $('#project-form').serialize(),
			success: function(respose){
				$('#satnamBugdet').html(respose);
			}
		})
	}

	$("#ajaxLoadingDiv" ).hide();
	$( document ).ajaxStart(function() {
		$( "#ajaxLoadingDiv" ).show();
	});
	$( document ).ajaxStop(function() {
		$( "#ajaxLoadingDiv" ).hide();
	});

})(jQuery);
<?php if(isset($_REQUEST['id'])) { ?>
$('#openBrow').click(function(){
	filepicker.setKey("AlqJxqOBnROGcRhBT1jPFz");
	filepicker.pickMultiple({mimetypes: ['image/*', 'text/*', 'application/pdf','application/msword','application/vnd.ms-excel','application/vnd.ms-powerpoint'],},
	function(InkBlob){
		var values	=	['image/jpg', 'image/jpeg','image/gif','image/png'];
		$.ajax({
			type:'POST',
			url:"<?php echo CController::createUrl("/client/mockup",array('id'=>$project->id));?>",
			data : 'data='+JSON.stringify(InkBlob),
			success:function(data){
				$('#ClientProjects_mockup').append(data);
			}
		});
//		$('html,body').scrollTop(0);
	},
	function(FPError){
		console.log(FPError.toString());
  	}
	);
});
<?php } else { ?>
$('#openBrow').click(function(){
	filepicker.setKey("AlqJxqOBnROGcRhBT1jPFz");
	filepicker.pickMultiple({mimetypes: ['image/*', 'text/plain', 'application/pdf'],},
	function(InkBlob){
		for(i in InkBlob){
			var docs = $('#docs').val();
			docs = docs+InkBlob[i].mimetype+"|"+InkBlob[i].filename+"|"+InkBlob[i].size+"|"+InkBlob[i].url+",";
    		$('#docs').val(docs);
			var data = '<tr><td><span class="label label-success">'+InkBlob[i].mimetype+'</span>'+InkBlob[i].filename+'('+Math.round(((InkBlob[i].size)/1024),2)+' KB)</td><td><a href="'+InkBlob[i].url+'" target="_blank">View</a></td></tr>';
			$('#ClientProjects_mockup').append(data);
		}
		console.log($('#docs').val());
	},
	function(FPError){
		console.log(FPError.toString());
  	}
	);
});
<?php } ?>
$('#ClientProjects_name').keyup(function(){
	var value = $('#ClientProjects_name').val();
	if(value[0] === " ")
	{
		$('#ClientProjects_name').val("");
		$('#pss ul.parsley-errors-list').css('display','block');
		$('#pss ul.parsley-errors-list').html('');
		$('#pss ul.parsley-errors-list').append('<li id="satPas">Invalid project name</li>');
	}
	else
	{
		$('#pss ul.parsley-errors-list').html('');
	}
});
</script>

