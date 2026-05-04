<div class="csr-index social-nav">
    <div class="page-content-wrapper">
        <div class="page-content-innerwrap csr-cats">
            <div class="page-content-div container">
                <h3><span class="csr-title">その他の活動</span></h3>
                <div class="csr-list">
                    <div class="csr-cat-wrapper">
                        <div class="csr-cat-name">
                        <!-- TODO：「もったいプロジェクト」「ボランティア活動」画面smの時のみ折り返し -->
                        <?php
                            $excluded_slugs = ['csr-topics', 'volunteer2', 'clean', 'education', 'education_scholarship'];
                            $csr_parent_terms = get_terms('csr_cat', array('parent' => 0, 'hide_empty' => false));

                            $ordered_terms = array_filter($csr_parent_terms, function($t) use ($excluded_slugs) {
                                return !in_array($t->slug, $excluded_slugs, true);
                            });

                            usort($ordered_terms, function($a, $b) {
                                $order_a = get_field('menu_order', 'csr_cat_' . $a->term_id);
                                $order_b = get_field('menu_order', 'csr_cat_' . $b->term_id);
                                return ($order_a ?? 9999) <=> ($order_b ?? 9999);
                            });

                            foreach ($ordered_terms as $t):
                                $id = $t->term_id;
                                $child = get_term_children($id, 'csr_cat');

                                $url = '/social-contributions/category/?csr_cat=' . $t->slug;
                                if ($child) {
                                    $url = '/social-contribution/?cat_id=' . $id;
                                }
                                if ($id == 82) {
                                    $url = '/social-contribution/#mottainai_pro';
                                } elseif ($id == 84) {
                                    $url = '/social-contributions/category/?csr_cat=csr-activities';
                                } elseif ($id == 305) {
                                    $url = '/social-contributions/category/?csr_cat=brights';
                                }

                                $csr_cat_img = get_field('csr_cat_icon', $t);
                            ?>
                                <div class="csr-cat <?php echo esc_attr($t->slug); ?>">
                                    <?php
                                    // NEW表示：親または子に `csr_new_display` が true なら ● 表示
                                    $show_new = false;
                                    if (get_field('csr_new_display', $t) && !$child) {
                                        $show_new = true;
                                    } elseif ($child) {
                                        foreach ($child as $cid) {
                                            $c = get_term_by('id', $cid, 'csr_cat');
                                            if (get_field('csr_new_display', $c)) {
                                                $show_new = true;
                                                break;
                                            }
                                        }
                                    }
                                    if ($show_new) {
                                        echo '<div class="new">●</div>';
                                    }
                                    ?>
                                    <a href="<?php echo esc_url($url); ?>">
                                        <div class="csr-cat-img">
                                            <?php if (!empty($csr_cat_img['url'])): ?>
                                                <img src="<?php echo esc_url($csr_cat_img['url']); ?>" alt="<?php echo esc_attr($t->name); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="csr-cat-inner">
                                            <p class="mb-0 csr-cat-title"><?php echo esc_html($t->name); ?></p>
                                        </div>
                                        <div class="csr-next_link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                <g transform="translate(8176.361 -1665.095)">
                                                    <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                    <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                </g>
                                            </svg>
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