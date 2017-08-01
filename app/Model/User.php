<?php
App::uses('AppModel','Model');
App::uses('SimplePasswordHasher','Controller/Component/Auth');
class User extends AppModel{
  public $name ='User';

  public function beforeSave($options=array()){
    if(isset($this->data[$this->alias])){
      $passwordHasher = new SimplePasswordHasher();
      $this->data[$this->alias]['password'] =$passwordHasher->hash(
        $this->data[$this->alias]['password']
      );
    }
    return true;
  }


  public $validate = array(
    'first_name'=>array(
      'alphaNumeric'=>array(
        'rule' =>'alphaNumeric',
        'required'=> true,
        'message'=>'Letters and numbers only'
      ),
      'notEmpty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Please enter your first name'
      )
    ),
    'last_name'=>array(
      'alphaNumeric'=>array(
        'rule' =>'alphaNumeric',
        'required'=> true,
        'message'=>'Letters and numbers only'
      ),
      'notEmpty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Please enter your last name'
      )
    ),
    'email'=>array(
      'email'=>array(
        'rule' =>'email',
        'required'=> true,
        'message'=>'Please Enter an email address '
      ),
      'notEmpty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Please enter your email address'
      )
    ),
    'password'=>array(
      'notEmpty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Please enter your email address'
      )
    ),
    'confirm_password'=>array(
      'notEmpty'=>array(
        'rule'=>'notEmpty',
        'message'=>'Please enter your email address'
      )
    ),
    'matchPasswords'=>array(
      'notEmpty'=>array(
        'rule'=>array('identicalFieldValues','password'),
        'message'=>'Your Passwords are not Matches'
      )
    ),
  );
  function identicalFieldValues($field=array(), $compare_field=null){
    foreach ($field as $key => $value) {
      $v1 =$value;
      $v2 =$this->data[$this->name][$compare_field];
      if($v1 !== $v2){
        return FALSE;
      }else {
        continue;
      }
    }
    return TRUE;
  }





}
 ?>
