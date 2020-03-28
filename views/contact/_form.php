<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $contact app\models\Contact */
/* @var $form yii\widgets\ActiveForm */

$this->title = $contact->isNewRecord ? 'New contact' : "Update ". $contact->name;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $contact->name, 'url' => ['view', 'id' => $contact->id]];
$this->params['breadcrumbs'][] = $contact->isNewRecord ? 'Create' : 'Update';

?>

<div class="box box-default">
    <div class="box-body">
        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'dynamic-form','enableAjaxValidation' => true ]); ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($contact, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($contact, 'surname')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($contact, 'description')->textarea(['rows' => 6]) ?>
                </div>
            </div><!-- class="col-md-6"-->
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 20, // the maximum times, an element can be added (default 999)
                            'min' => 0, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $numbers[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'id',
                                'number',
                                'description'
                            ],
                        ]);
                    ?>
                <br>
                <div class="panel panel-default">
                    <div id = 'inbound_routes_patternlist' class="panel-heading">
                        <h4>
                            Phone numbers
                        </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <?= Html::label("Number") ?>
                                    </th>
                                    <th>
                                        <?= Html::label('Description') ?>
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="container-items">
                                <?php foreach ($numbers as $i => $entry): ?>
                                    <tr class="item">
                                        <?php
                                            // necessary for update action.
                                            if (!$entry->isNewRecord) {
                                                echo Html::activeHiddenInput($entry, "[{$i}]id");
                                            }
                                        ?>
                                        <td>
                                            <?= $form->field($entry, "[{$i}]number")->label(false) ?>
                                        </td>
                                        <td>
                                            <?= $form->field($entry, "[{$i}]description")->label(false) ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                        </td>
                                    </tr> 
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-center">
                                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- .panel -->
                <?php DynamicFormWidget::end(); ?>
                </div><!--div class="form-group"-->
            </div><!-- class="col-md-6"-->
        </div><!--div class="row"-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::a('Cancel', ['index'] ,['class' => 'btn btn-default pull-right', 'style' => "margin-left: 5px;"])?>
                    <?= Html::submitButton($contact->isNewRecord ? 'Create': 'Update', ['class' => 'btn btn-primary pull-right']) ?>
                </div>
            </div><!-- class="col-md-12"-->
        </div><!--div class="row"-->
        <?php ActiveForm::end() ?>
    </div><!-- class="box-body"-->
</div><!--div class="box box-default"-->
