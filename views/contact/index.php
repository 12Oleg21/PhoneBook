<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\assets\DataTableAsset;
use app\assets\ContactsAsset;

DataTableAsset::register($this);
if(!empty($list->allModels))
    ContactsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $list,
        'tableOptions' => ['id' => 'contactsTable', 'class' => 'table table-striped table-bordered',],
        'layout' => "{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'surname',
            'description:ntext',
            ['attribute' =>'phoneNumbers',
                'format' => 'text',
                'headerOptions' => ['style' => "width:600px"],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => "width:60px"],
                'footer' => Html::a('Add', ['create'], ['class' => 'btn btn-primary', 'name' => 'add-button' ]),
            ],
        ],
        'showFooter' => true,
    ]);
?>

</div>
