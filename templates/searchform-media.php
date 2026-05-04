<?php
$media_cat = 'media_cat';
$media_csr_cat = 'media_csr_cat';
$media_list = 'media_list';

$media_list = get_term_by('slug', $media_list, $media_cat);
$media_csr_cat_term = get_term_by('slug', $media_csr_cat, $media_cat);
$media_parent_terms = array($media_list, $media_csr_cat_term);

if ($media_parent_terms) :
?>
<div class="col-12 col-md-3">
    <div class="media-search">
        <h2>
            <i class="fas fa-search"></i>
            <span>記事を探す</span>
        </h2>
        <?php
            foreach ($media_parent_terms as $media_parent_term ) :
                $parent_cat_name = $media_parent_term->name;
                $parent_cat_slug = $media_parent_term->slug;
        ?>
            <div class="cat-list">
            <h3 class="archive-item"><?php echo $parent_cat_name; ?>から探す</h3>
            <div class="acor-menu opened">
                <?php echo $parent_cat_name; ?>を選ぶ
            </div>
            <div class="acor-menu-child opened" style="display: block;">
                <ul>
                    <li>
                        <a href="/media/"><span class="text-dark">全て</span></a>
                    </li>
                    <?php
                        $second_args = array(
                            'child_of' => $media_parent_term->term_id, //すべての子孫ターム
                            // 'parent' => $media_parent_term->term_id, //直下の子タームだけ
                            // 'hide_empty' => 0,
                        );
                        $terms = get_terms($media_cat, $second_args);
                        foreach ($terms as $term) :
                    ?>
                    <li>
                        <a href="/<?php echo $media_cat.'/'.$term->slug; ?>/"><span class="text-dark"><?php echo $term->name; ?></span></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php
            endforeach;
        ?>
        <div class="search-btn text-center">
            <button onclick="location.href='/media/'">
                <p class="mb-0 pr-2">全て表示</p>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>