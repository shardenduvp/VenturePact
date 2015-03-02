<?php

/**
 * This is the model class for table "admin_logs".
 *
 * The followings are the available columns in table 'admin_logs':
 * @property integer $id
 * @property string $username
 * @property string $ipaddress
 * @property string $logtime
 * @property string $controller
 * @property string $action
 * @property string $details
 * @property string $action_param
 * @property string $browser
 * @property string $query_string
 * @property string $refer_url
 * @property integer $user_id
 * @property string $request_url
 */
class AdminLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('ipaddress', 'length', 'max'=>45),
			array('controller', 'length', 'max'=>245),
			array('action', 'length', 'max'=>145),
			array('action_param', 'length', 'max'=>60),
			array('logtime, details, browser, query_string, refer_url, request_url', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, ipaddress, logtime, controller, action, details, action_param, browser, query_string, refer_url, user_id, request_url', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'ipaddress' => 'Ipaddress',
			'logtime' => 'Logtime',
			'controller' => 'Controller',
			'action' => 'Action',
			'details' => 'Details',
			'action_param' => 'Action Param',
			'browser' => 'Browser',
			'query_string' => 'Query String',
			'refer_url' => 'Refer Url',
			'user_id' => 'User',
			'request_url' => 'Request Url',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('ipaddress',$this->ipaddress,true);
		$criteria->compare('logtime',$this->logtime,true);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('action_param',$this->action_param,true);
		$criteria->compare('browser',$this->browser,true);
		$criteria->compare('query_string',$this->query_string,true);
		$criteria->compare('refer_url',$this->refer_url,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('request_url',$this->request_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdminLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
