<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = $contact->name;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <h1><?= Html::encode($this->title) ?></h1>

<div class="box box-default">
    <div class="box-body">
        <div class="row">
        <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?= DetailView::widget([
                        'model' => $contact,
                        'attributes' => [
                            'name',
                            'surname',
                            'description:ntext',
                        ],
                    ]) ?>
                </div>
            </div><!-- class="col-md-6"-->
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div id = 'inbound_routes_patternlist' class="panel-heading">
                        <h4>
                            Phone numbers
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?= GridView::widget([
                                'dataProvider' => $list,
                                'layout' => '{items}{pager}',
                                'showHeader' => true,
                                'columns' => [
                                    ['attribute' => 'number'],
                                    ['attribute' => 'description'],
                                ],
                                'showOnEmpty' => false,
                                'tableOptions' => [
                                    'class' => 'table table-striped table-bordered',
                                    'id' => 'numbersGrid',
                                ],
                            ]);
                        ?>
                    </div>
                </div><!-- .panel -->
                </div><!--div class="form-group"-->
            </div><!-- class="col-md-6"-->
        </div><!--div class="row"-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::a('Cancel', ['index'] ,['class' => 'btn btn-default pull-right', 'style' => "margin-left: 5px;"])?>
                    <?= Html::a('Edit', ['update', 'id' => $contact->id], ['class' => 'btn btn-primary pull-right', 'name' => 'edit-button']) ?>
                </div>
            </div><!-- class="col-md-12"-->
        </div><!--div class="row"-->
        <?php ActiveForm::end() ?>
    </div><!-- class="box-body"-->
</div><!--div class="box box-default"-->
