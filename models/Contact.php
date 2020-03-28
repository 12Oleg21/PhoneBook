<?php

namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Model;
use yii\widgets\ActiveForm;
/**
 * This is the model class for table "Contacts".
 *
 * @property int $id
 * @property string $name
 * @property string|null $surname
 * @property string|null $description
 */
class Contact extends \yii\db\ActiveRecord
{
    public $phoneNumbers;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name', 'surname'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'description' => 'Description',
        ];
    }

    /*
     * Get all contacts and add all his numbers
     * invoked from index action 
     * return dataProvider
     */
    public function listAll()
    {
        $contacts = $this->find()->with('numbers')->all();
        $allContactsNumbers = $this->addNumbersToModel($contacts);
        $list = new ArrayDataProvider(['allModels' => $allContactsNumbers, 'key' => 'id',  'pagination' => false]);
        return $list;
    }

    public function addNumbersToModel($contacts)
    {
        foreach($contacts as $contact){
            $allNumbers = $contact->numbers;
            $contactNumbers = [];
            foreach($allNumbers as $number){
                $contactNumbers[] = $number->number;
            }
            $contact->phoneNumbers = implode(', ', $contactNumbers);
        }
        return $contacts;
    }

    public function buildMultiple($patternlist, $pattern)
    {
        $oldIDs = ArrayHelper::map($patternlist, 'id', 'id');
        $patternlist = Model::createMultiple($pattern::classname(), $patternlist);
        Model::loadMultiple($patternlist, Yii::$app->request->post());
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($patternlist, 'id', 'id')));
        return [$deletedIDs, $patternlist];
    }

    public function mergeAllArray($patternlist, $pattern)
    {
        return ArrayHelper::merge(
                ActiveForm::validateMultiple($patternlist),
                ArrayHelper::merge(ActiveForm::validate($this),
                $pattern->validatePatterns($patternlist)));
    }

    /*
     * Save/Update model and all number models with transaction.
     * (If something wrong with it then it doesn't be saved/updated in DB)
     * Create new line in table if it needs.
     * Invoked from create/update action in Controller
     */
    public function saveContactAndNumbers($numbers, $deletedIDs, $number)
    {
        $transaction = $this->getDb()->beginTransaction();
        try
        {
            if($this->isNewRecord){
                $flag = $this->save();
            }else{
                $flag = $this->update(false) === false ? false : true;
            }

            if ($flag) {
                if (!empty($deletedIDs)) {
                    $number->deleteAll(['id' => $deletedIDs]);
                }
                foreach ($numbers as $entry) {
                    $entry->contact_id = $this->id;
                     if (!($flag = $entry->save(false))){
                        $transaction->rollBack();
                        break;
                    }
                }
                $transaction->commit();
            }
        }catch(\Throwable $e) {
              $transaction->rollBack();
              throw $e;
        }
    }

    /*
     *  Create a relationship with Number model
     */
    public function getNumbers()
    {
      return $this->hasMany(Number::className(), ['contact_id' => 'id']);
    }


}
