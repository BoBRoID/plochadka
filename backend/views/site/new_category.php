<?php
use yii\widgets\ActiveForm;

$form = new ActiveForm();
?>

<div class="container">
    <?php print_r($category->errors); ?>
    <?php $form->begin()?>
    <?=$form->field($category, 'parent')->dropDownList(array_merge(['0' => \Yii::t('site', 'Не выбрано')], $parents))?>
    <?=$form->field($category, 'name')?>
    <?=$form->field($category, 'description')?>
    <?=$form->field($category, 'keywords')?>
    <?=$form->field($category, 'link')?>
    <?=$form->field($category, 'postPrice')?>
    <button type="submit">Отправить</button>
    <?php $form->end()?>
</div>