<?php
    $days = 7; // New を表示させたい期間の日数
    $today = strtotime(wp_date('Y-m-d'));

    $remove_array = ["\r\n", "\r", "\n", " ", "　"];
    $content = wp_trim_words(strip_shortcodes(get_the_content()), $txt_limit, '…' );
    $content = str_replace($remove_array, '', $content);

    $entry = get_post_time();
    $total = wp_date($today - $entry) / 86400;
?>
<div class="news-div">
    <a href="<?php the_permalink(); ?>">
        <div class="news-innerdiv">
            <div class="content-wrapper">
                <div class="news-detail">
                    <div class="news-txt">
                        <div class="new-label">
                            <?php
                                if ($days > $total) {
                                    echo '<span>NEW</span>';
                                }
                            ?>
                        </div>
                        <div class="news-date">
                            <?php the_time('Y.m.d') ?><span>更新</span>
                        </div>
                    </div>
                    <div class="news-title">
                        <p class="mb-0 news-cat-txt bold"><?php the_title(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>