<?php
class Usuario extends EMongoDocument
{
      public $nome;
      public $login;
      public $senha;
      public $email;
      public $sexo;
      public $sexo;
      public $dtnascimento;
      public $created;
      public $modified;
      
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
          array('nome, email, login, senha, sexo, dtnascimento', 'required'),
          array('dtnascimento', 'format' => 'dd/MM/yyyy' , 'message' => 'Data invalida'),
          array('login, senha', 'length', 'max' => 25 , 'tooLong' => "Esse campo deve conter, no maximo, 25 caracteres" , 'min' => 4 , 'tooShort'=>'Esse campo deve conter, no minimo, 4 caracteres'),
          array('nome', 'length', 'max' => 255, 'tooLong' => "Esse campo deve conter, no maximo, 255 caracteres" , 'min' => 4 , 'tooShort'=>'Esse campo deve conter, no minimo, 4 caracteres'),
        );
      }
 
      public function attributeLabels()
      {
        return array(
            'nome' => 'Nome Completo',
            'email' => 'E-mail',
            'sexo' => 'Sexo',
            'login' => 'Nick Name',
            'senha' => 'Senha',
            'dtnascimento' => 'Data de Nascimento',
            'created' => 'Criado',
            'modified' => 'Modificado'
        );
      }
} 
?>