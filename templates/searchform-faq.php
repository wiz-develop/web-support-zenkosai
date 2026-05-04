<section class="search-faq">
    <div class="columns">
        <div class="container mb-0 d-block">
            <div class="page-content-innerwrap">
                <section>
                    <div class="serch-item">
                        <h2><i class="fas fa-search"></i>フリーワード検索</h2>
                        <?php if (!is_page('faq')): ?>
                        <a href="/faq/keyword/" class="btn btn-dark rounded-pill">一覧を見る</a>
                        <?php endif; ?>
                    </div>
                    <form method="get" class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
                        <input type="hidden" name="post_type" value="ufaq">
                        <input type="text" placeholder="<?php if(!is_search()){ echo '単語など短い言葉を入力してください';} ?>" value="<?php if(is_search()){ echo get_search_query();} ?>" class="ufaq-searchbody" name="s">
                        <button type="submit" class="search-submit btn">検索</button>
                    </form>
                    <?php if (is_page('faq')): ?>
                    <a class="shadow-none" href="<?php echo home_url() ; ?>/non-member_faq-2/">
                        <div class="beginner-guide mx-auto">
                            <img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/images/faq/beginner-guide.png">
                        </div>
                    </a>
                    <?php endif; ?>
                </section>
                <?php if (!is_page('faq')): ?>
                <div class="faq-backlink">
                    <a href="/faq/#search-cat">
                        <div class="faq-backlink__btn">
                            <span>カテゴリーから探す</span>
                        </div>
                    </a>
                    <a href="/faq/">
                        <div class="faq-backlink__btn">
                            <span>FAQ トップページ</span>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>