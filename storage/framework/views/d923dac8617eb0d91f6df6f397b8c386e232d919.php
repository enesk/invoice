<ul class="dropdown-menu" role="menu">
    <?php foreach(array_keys(config('locale.languages')) as $lang): ?>
        <li><?php echo link_to('lang/'.$lang, trans('menus.language-picker.langs.'.$lang)); ?></li>
    <?php endforeach; ?>
</ul>