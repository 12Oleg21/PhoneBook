<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "Numbers".
 *
 * @property int $id
 * @property string|null $number
 * @property int $contact_id
 * @property string|null $description
 */
class Number extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Numbers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id'], 'integer'],
            [['description'], 'string'],
            [['number'], 'string', 'max' => 255],
            [['number'], 'required'],
            [['number'], 'match', 'pattern' => '/^(\+\d+|\d+)$/', 'message' => 'Please use only digit or this format +380675797883']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'contact_id' => 'Contact ID',
            'description' => 'Description',
        ];
    }

        /**
     * Check all rows if it is the same then show error messages
     * invoked from Route model when we use the Ajax validation
     * return  array of errors for attributes
     */
    static function validatePatterns($models)
    {
      $result = [];
      $tempModels = $models;
        while($tempModels)
        {
          $lastmodel = end($tempModels);
          $tmp = array_keys($tempModels);
          $lastitem = end($tmp);
          array_pop($tempModels);
          $result_cool = $lastmodel->cool_validator($tempModels,$lastitem,$lastmodel);
          if(!empty($result_cool)) $result = array_merge($result,$result_cool);
        }
        return $result;
    }

    /**
     * Invoked from validatePatterns function for the same reason
     * return  array of errors for attributes
     */
    public function cool_validator($tempModels,$lastitem,$lastmodel)
    {
      $result = [];
      if ($lastmodel->number && !$lastmodel->hasErrors())
      {
        foreach ($tempModels as $model){
          if (!$model->hasErrors()){
              if($model->number == $lastmodel->number){
                 $lastmodel->addError('number', "The same number has already existed");
                foreach ($lastmodel->getErrors() as $attribute => $errors){
                  $result[Html::getInputId($lastmodel, "[$lastitem]" . $attribute)] = $errors;
                }
              }
          }
        }
      }
      return $result;
    }
  
}
