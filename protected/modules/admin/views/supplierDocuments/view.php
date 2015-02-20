<?php
/* @var $this SupplierDocumentsController */
/* @var $model SupplierDocuments */

$this->breadcrumbs=array(
	'Supplier Documents'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SupplierDocuments', 'url'=>array('index')),
	array('label'=>'Create SupplierDocuments', 'url'=>array('create')),
	array('label'=>'Update SupplierDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SupplierDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SupplierDocuments', 'url'=>array('admin')),
);
?>
<br/><br/>
<div class="box inverse">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   			<div class="panel panel-info">
            	<div class="panel-heading ">
              		<h3 class="panel-title">View Supplier has Documents #<?php echo $model->id; ?></h3>
              	</div>
        <div class="panel-body">
            <div class="row">
              	<div class="col-md-3 col-lg-3 " align="center"> 
                  <img alt="User Pic" class="img-circle" width="100px" src="<?php 
                                if($model->image==null){
                          echo Yii::app()->theme->baseUrl."/img/user.png";
                                }
                                else{
                                  echo $model->image;
                                }
          ?>" > 
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  	<table class="table table-user-information">
                    	<tbody>
							<?php
                    			$attributes=array('id',
													'suppliers_propsal_id',
													'name',
													'path',
													'extension',
													'size',
													'type',
													'status',
													'add_date',
												  
												);
                    			foreach($attributes as $attr) {
                    				$value=$model->$attr;
                    				//if password display same number of stars instead
                    				
         					?>    
         					<tr>
         						<td><?php echo ucfirst($attr); ?></td>
         						<td><?php echo $value; ?></td>
         					</tr>     
         					<?php }?>    		
                        		  </tbody>
                  	</table>
                </div>
            </div>
        </div>
              
          </div>
        </div>
      </div>
    </div>
// <?php //$this->widget('zii.widgets.CDetailView', array(
// 	'data'=>$model,
// 	'attributes'=>array(
// 		'id',
// 		'suppliers_propsal_id',
// 		'name',
// 		'path',
// 		'extension',
// 		'size',
// 		'type',
// 		'status',
// 		'add_date',
// 	),
// )); ?>
