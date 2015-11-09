<h1>
    Категории
</h1>
<?=\yii\helpers\Html::a('Добавить категорию', \yii\helpers\Url::toRoute(['createcategory']), [
    'class' =>  'btn btn-default'
])?>
<br>
<br>
<div class="row">
    <?=\yii\widgets\ListView::widget([
        'dataProvider'  =>  $dataProvider,

        'itemView'  =>  function($model){
            return $this->render('_category_list_view', [
                'category'      =>  $model
            ]);
        },
    ])?>
</div>