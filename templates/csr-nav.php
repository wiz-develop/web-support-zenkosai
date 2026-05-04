<div class="csr-index social-nav">
    <div class="page-content-wrapper">
        <div class="page-content-innerwrap csr-cats container-fluid">
            <div class="page-content-div">
                <h3><span class="csr-title">活動内容</span></h3>
                <div class="csr-list">
                    <div class="csr-cat-wrapper container">
                        <div class="csr-cat-name">
                        <!-- TODO：「もったいプロジェクト」「ボランティア活動」画面smの時のみ折り返し -->
                        <?php $i = 1; foreach (get_terms('csr_cat', array('parent' => 0, 'hide_empty' => false, 'orderby' => 'id')) as $t): ?>
                            <?php $id = $t->term_id; $child = get_term_children( $id, 'csr_cat' ); ?>
                                <div class="csr-cat <?php echo $t->slug; ?>">
                                    <!-- 子ありのカテゴリの場合子カテゴリ一覧表時用URL -->
                                    <?php
                                        $id = $t->term_id; $child = get_term_children( $id, 'csr_cat' );
                                        // 子なしの場合
                                        $url = '/social-contributions/category/?csr_cat='.$t->slug;
                                        if($child){
                                            // 子ありの場合
                                            $url = '/social-contribution/?cat_id='.$id;
                                        }
                                    ?>
                                    <!-- NEWの表記設定 -->
                                    <?php
                                        if(get_field('csr_new_display', $t) && !$child)
                                        { echo '<div class="new">●</div>'; }
                                        if($child){
                                            foreach ($child as $cid){
                                                $c = get_term_by('id', $cid, 'csr_cat');
                                                if(get_field('csr_new_display', $c)){
                                                    echo '<div class="new">●</div>';
                                                    break;
                                                }
                                            }
                                        }
                                    ?>
                                    <a href="<?php echo $url; ?>">
                                        <div class="csr-cat-inner">
                                            <p class="mb-0 csr-cat-title"><?php echo $t->name; ?></p>
                                        </div>
                                    </a>
                                </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>