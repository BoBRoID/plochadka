<?php
$form = new \yii\widgets\ActiveForm();
?>
<div class="container">
    <?php $form->begin() ?>
    <?=$form->field($post, 'category')->dropDownList(array_merge(['0' => \Yii::t('site', 'Не выбрано')], $categoryList))?>
    <?=$form->field($post, 'title')?>
    <?=$form->field($post, 'content')->textarea()?>
    <?=$form->field($post, 'price')?>
    <?=$form->field($post, 'phone')?>
    <?=$form->field($post, 'email')?>
    <button type="submit">Отправить</button>
    <?php $form->end() ?>
</div>