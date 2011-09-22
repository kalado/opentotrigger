<?php
class Idioma extends EMongoDocument
    {
      public $idioma;
      
      // This has to be defined in every model, this is same as with standard Yii ActiveRecord
      public static function model($className=__CLASS__)
      {
        return parent::model($className);
      }
 
      // This method is required!
      public function getCollectionName()
      {
        return 'idiomas';
      }
      
      public function rules()
      {
        return array(
          array('idioma', 'required'),
          array('idioma', 'length', 'min' => 3 , 'tooShort' => 'O idioma deve conter, no mínimo, 3 caracteres.' ,'max'=>20 ),
        );
      }
      
      
      public function attributeLabels()
      {
        return array(
          'idioma'   => 'Idioma',
        );
      }
    }
?>