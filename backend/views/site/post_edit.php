<h1>Посты</h1>
<?php

$form = new \yii\bootstrap\ActiveForm();


$form->begin();

echo $form->field($post, 'category')->dropDownList(\common\models\Category::getList()),
$form->field($post, 'premium'),
$form->field($post, 'title'),
$form->field($post, 'content')->textarea(),
$form->field($post, 'price'),
$form->field($post, 'phone'),
$form->field($post, 'email');
?>

<button class="btn btn-default" type="submit">Сохранить</button>
<?php $form->end(); ?>