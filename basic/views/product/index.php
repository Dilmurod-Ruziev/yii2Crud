    <?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success','data-method'=>"post"]) ?>
        </p>
    <?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'title',
            'cost',
            'category',
            'rating',
            'user_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
   <?
   ?>


</div>
