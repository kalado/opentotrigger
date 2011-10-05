<?php
class Usuario extends EMongoDocument
{
      public $login;
      public $nome;
      public $senha;
      public $email;
      
 
      // This has to be defined in every model, this is same as with standard Yii ActiveRecord
      public static function model($className=__CLASS__)
      {
        return parent::model($className);
      }
 
      // This method is required!
      public function getCollectionName()
      {
        return 'usuarios';
      }
      
      public function rules()
      {
        return array(
          array('login, senha, nome, email', 'required'),
          array('login, senha', 'length', 'max' => 25),
          array('nome, email', 'length', 'max' => 255),
        );
      }
 
      public function attributeLabels()
      {
        return array(
          'login'  => 'Login',
          'nome'   => 'Nome Completo',
          'senha'  => 'Senha',
          'email'  => 'E-mail',
        );
      }
} 
?>