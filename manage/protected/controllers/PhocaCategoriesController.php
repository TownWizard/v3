<?php

class PhocaCategoriesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','updatestatus','ajaxupdate','approvedstatus','findchildren'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PhocaCategories;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PhocaCategories']))
		{
			$model->attributes=$_POST['PhocaCategories'];
			if(isset($_POST['PhocaCategories']['title'])){
				$model->alias = $_POST['PhocaCategories']['title'];
			}
			if($model->save()){
				 Yii::app()->user->setFlash('success', '<i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i><strong>Success!</strong> Your Category added Successfully.');
				//$this->redirect(array('/phocaCategories'));
				//$pre_url_sep = explode('?', $_POST['PhocaCategories']['last_url']);
				$this->redirect($_POST['PhocaCategories']['last_url']);
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PhocaCategories']))
		{
			$model->attributes=$_POST['PhocaCategories'];
			if(isset($_POST['PhocaCategories']['title'])){
				$model->alias = $_POST['PhocaCategories']['title'];
			}
			if($_POST['PhocaCategories']['published'] == '0'){
				if($this->actionFindChildren($model->id)){
					Yii::app()->user->setFlash('success','<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true"></span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i>&nbsp;<strong>Sorry!</strong> Your Can not Unpublished Category Assigned to Menu.');
				}else{
					if($model->save()){
						Yii::app()->user->setFlash('success', '<i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i><strong>&nbsp; Success!</strong> Your Category updated successfully.');
					}
				}
			}else{
				if($model->save()){
					Yii::app()->user->setFlash('success', '<i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"></i><strong>Success!</strong> Your Category updated successfully.');
				}
			}
			$pre_url_sep = explode('?', $_POST['PhocaCategories']['last_url']);
			$this->redirect(array('/phocaCategories?'.$pre_url_sep[1]));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		try{
			if($this->actionFindChildren($id)){
				$model = $this->loadModel($id);
				$menuName = $model->title;
				if(!isset($_GET['ajax']))
			        Yii::app()->user->setFlash('success','<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-circle-exclamation-mark" style="color:#d9534f;font-size: 16px;"></i><span style="color:#d9534f;"><strong> Sorry!! </strong> Category(ies): '.$menuName.' cannot be removed as they contain Articles. There may currently be Articles within the Article Trash Manager which you must delete first..</span>');
			    else
			        echo '<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-circle-exclamation-mark" style="color:#d9534f;font-size: 16px;"></i><span style="color:#d9534f;"><strong> Sorry!! </strong> Category(ies): '.$menuName.' cannot be removed as they contain Articles. There may currently be Articles within the Article Trash Manager which you must delete first..</span>';
			}else{
			    $this->loadModel($id)->delete();
			    if(!isset($_GET['ajax']))
			        Yii::app()->user->setFlash('success','<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i><strong>Success!</strong> Your Category deleted successfully.');
			    else
			        echo '<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"></i><strong>Success!</strong> Your Category deleted successfully.';
			}
		}catch(CDbException $e){
			    if(!isset($_GET['ajax']))
			        Yii::app()->user->setFlash('error','Normal - error message');
			    else
			        echo "<div class='flash-error'>Ajax - error message</div>"; //for ajax
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new PhocaCategories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PhocaCategories']))
			$model->attributes=$_GET['PhocaCategories'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->redirect(array('index'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PhocaCategories the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PhocaCategories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PhocaCategories $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='phoca-categories-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	* Function to change Category status from Active to Inactive and Vice versa
	* Developer: rinkal 
	*/	
	public function actionUpdatestatus($id) {
		$newStatus = ($_REQUEST['status'] == 1)?0:1;
        $model = PhocaCategories::model()->findByPk($id);
        $model->published = $newStatus;
		
		if($newStatus == 0){
			if($this->actionFindChildren($id)){
				Yii::app()->user->setFlash('success','<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true"></span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i>&nbsp;<strong>Sorry!</strong> Your Can not Unpublished Category Assigned to Menu.');
			}else{
				$model->save();
				Yii::app()->user->setFlash('success','<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true"></span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i>&nbsp;<strong>Success!</strong>Category Unpublished Successfully!');
			}
		}else{
    	    $model->save();
			Yii::app()->user->setFlash('success','<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true"></span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i>&nbsp;<strong>Success!</strong>Category Unpublished Successfully!');
		}
		
		//$this->redirect(array('categories/index?type=com_content'));
		$this->redirect($_SERVER['HTTP_REFERER']);
    }
	
	public function actionApprovedstatus($id) {
		$newStatus = ($_REQUEST['approved'] == 1)?0:1;
        $model = PhocaCategories::model()->findByPk($id);
        $model->approved = $newStatus;
        $model->save();
		//$this->redirect(array('categories/index?type=com_content'));
		$this->redirect($_SERVER['HTTP_REFERER']);
    }
	
	public function actionAjaxupdate(){

		$act = $_GET['act'];
		if($act=='doSortOrder'){
		    $sortOrderAll = $_POST['ordering'];
		    if(count($sortOrderAll)>0){
		        foreach($sortOrderAll as $bid=>$ordering){
		            $model=$this->loadModel($bid);
		            $model->ordering = $ordering;
		            $model->save();
		        }
		    }
		}else{  
		    $autoIdAll = $_POST['autoId'];
		    if(count($autoIdAll)>0){
		        foreach($autoIdAll as $autoId){
		            $model=$this->loadModel($autoId);
		            if($act=='doDelete'){
						if($this->actionFindChildren($autoId)){
							$menuName = $model->title;
							$msg = '<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-circle-exclamation-mark" style="color:#d9534f;font-size: 16px;"></i><span style="color:#d9534f;"><strong> Sorry!! </strong> Category(ies): '.$menuName.' cannot be removed as they contain Articles. There may currently be Articles within the Article Trash Manager which you must delete first..</span>';
						}else{
							$model->delete();
							$msg = '<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i>&nbsp;<strong>Success!</strong> Your Category deleted successfully.';
						}
						
					}
		            if($act=='doActive'){
		                $model->published = '1';
						$model->save();
						$msg = '<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i>&nbsp;<strong>Success!</strong> Your category published successfully.';	
					}
		            if($act=='doInactive'){
						$model->published = '0';  
						# CHECK IF ARTICLE ASSIGNED TO THIS CATEGORY OR NOT
						# IF YES THEN NOT ABLE TO UNPUBLISH
						if($this->actionFindChildren($autoId)){
							$menuName = $model->title;
							$msg = '<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-circle-exclamation-mark" style="color:#d9534f;font-size: 16px;"></i><span style="color:#d9534f;"><strong> Sorry!! </strong> Category(ies): '.$menuName.' cannot be removed as they contain Articles. There may currently be Articles within the Article Trash Manager which you must delete first..</span>';
						}else{
							$model->save();
							$msg = '<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&nbsp;×</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-ok-sign" style="font-size: 16px;"> </i>&nbsp;<strong>Success!</strong> Your Category unpublished successfully.';
						}
					}               
		            /*if($model->save())
		                echo '';
		            else
		                throw new Exception("Sorry",500);*/

		        }
				echo $msg;
		    }
		}
	} // Ending Function
	
	/**
	* check category if it has child article or not
	* @param int $id
	* @param int $level
	* 
	* @return bool true if child else false
	*/
	public function actionFindChildren($id,$level = 0)
	{
		$return = FALSE;
		if((int)$level > 0){
			$return = true;
		}
		if((int)$level == 0){
			$criteria = new CDbCriteria;
	        $criteria->condition='parent_id=:id';
	        $criteria->params=array(':id'=>$id);
	        $model = PhocaCategories::model()->findAll($criteria);
			foreach ($model as $key) {
				$return = $this->actionFindChildren($key->id, (int)$level+1);
			}
		}
		return $return;
	}

}
