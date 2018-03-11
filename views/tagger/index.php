<?php
/**
 *  $tagger - app\components\Tagger
 */
?>



<div class="row">
    <div class="col-lg-6">
        <h1>Общий список тегов</h1>
        <?php foreach ($tagger->labelsList as $label => $count): ?>
            <p> <?php echo $label . ' - ' . $count; ?> </p>
        <?php endforeach; ?>
    </div>

    <div class="col-lg-6">
        <h1>Список тегов по изображениям</h1>
        <?php foreach ($tagger->labelsByImg as $title => $labels): ?>
            <h3> <?php print_r($title); ?> </h3>
            <?php foreach ($labels as $label => $count): ?>
                <p> <?php echo $label . ' - ' . $count; ?> </p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>