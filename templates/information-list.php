<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php
  $skip = false;
  if (get_post_type() === 'social-contribution') {
      if (!$loggedin && CFS()->get('csr_info_nologin', get_the_ID())) { $skip = true; }
  }
  if ($skip) continue;

  $p_type = (get_post_type() === 'social-contribution') ? 'csr_cat' : 'news';
  $terms = get_the_terms(get_the_ID(), $p_type);
  $t = is_array($terms) && !empty($terms) ? $terms[0] : null;

  // タームが無い場合のガード
  $cat_term = ($p_type === 'csr_cat') ? get_term_by('slug', 'csr', 'news') : $t;
  $logo = $cat_term ? get_field('n_logo', $cat_term) : null;
  $color = $cat_term ? get_field('n_color', $cat_term) : '';
  $cat_name = ($p_type === 'csr_cat') ? '社会貢献活動' : ($t ? $t->name : '');
  $title = mb_strimwidth(strip_tags(get_the_title()), 0, $txt_limit, '…', 'UTF-8');

  $important = CFS()->get('important_information') ? 'important-news' : '';
  // ★ isset で未定義注意
  $is_unread = (isset($_SESSION['is_unread']) && in_array(get_the_ID(), $_SESSION['is_unread'], true));
  $unread = $is_unread ? 'unread-news' : '';
?>
<div class="info-item <?php echo $is_unread ? 'unread-news' : ''; ?>" data-id="<?php echo get_the_ID(); ?>" data-unread="<?php echo $is_unread ? '1' : '0'; ?>">
  <div class="info-news mx-auto my-1">
    <?php if ($is_unread): ?>
        <span class="info-dot"></span>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>">
      <div class="info-news-bar d-flex align-items-center">
        <div class="news-cat d-flex align-items-center" style="background-color: <?php echo esc_attr($color); ?>">
          <div class="cat-img-div">
              <img src="<?php echo esc_url($logo['url'] ?? ''); ?>" alt="<?php echo esc_attr($cat_name); ?>" />
          </div>
          <p class="mb-0 news-cat-txt bold pl-2"><?php echo esc_html($cat_name); ?></p>
        </div>
        <div class="news-date ml-2"><?php the_time('Y/m/d'); ?></div>
      </div>
    </a>
  </div>
  <p class="mb-0 news-title py-1">
      <?php if ($important) echo '<span class="important rounded07 px-2 text-center text-white bg-danger mr-2">重要</span>'; ?>
      <?php echo esc_html($title); ?>
  </p>
  <!-- 選択ボタンは初期非表示 -->
  <button class="select-btn btn btn-outline-primary btn-sm" style="display:none;">選択する</button>
  <!-- 既読ラベルは既読のみ、初期は非表示 -->
  <?php if ($login): ?>
    <?php if ($is_read): ?>
        <span class="read-label text-secondary" style="display:none;">既読</span>
    <?php endif; ?>
  <?php endif; ?>
  </div>
<?php endwhile; ?>