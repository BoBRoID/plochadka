<?php
use yii\widgets\ActiveForm;

$form = new ActiveForm();
?>

<div class="container">
    <?php $form->begin()?>
    <?=$form->field($category, 'parent')->dropDownList(array_merge(['0' => 'Не выбрано'], $parents))?>
    <?=$form->field($category, 'name')?>
    <?=$form->field($category, 'description')?>
    <?=$form->field($category, 'keywords')?>
    <?=$form->field($category, 'link')?>
    <?=$form->field($category, 'postPrice')?>
    <button type="submit">Сохранить</button>
    <?php $form->end()?>
</div>