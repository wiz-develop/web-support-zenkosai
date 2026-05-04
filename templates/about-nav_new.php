<div class="page-content-innerwrap about-page_list">
    <h3>その他関連ページ</h3>
    <div class="page-content-div">
        <div class="about-nav">
            <div class="about-nav-list p-0">
                <?php
                    // 指定したIDの子ページ一覧を表示
                    $about_page_data = get_page_by_path('about');
                    $now_post_data = get_post();
                    $args = array(
                        'post_parent' => $about_page_data->ID,
                        'post_status' => 'publish',
                        'post_type'   => 'page',
                        'order'       => 'ASC',
                        'orderby'     => 'menu_order',
                        'exclude' => $now_post_data->ID,
                    );
                    $children_array = get_children( $args );
                ?>
                <ul>
                <?php
                    foreach ( $children_array as $child ) {
                        if(CFS()->get('restrict_page',$child->ID))
                        {
                            if(!$_SESSION['member_info']){
                                continue;
                            }
                        }
                        $url = get_permalink( $child->ID );
                        $html  = '<li>';
                        $html .= '<a class="w-100" href="' . esc_url( $url ) . '">';
                        $html .= '<div class="link-name">';
                        $html .= esc_html( $child->post_title );
                        $html .= '</div>';
                        $html .= '<div class="about-page_link">';
                        $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">';
                        $html .= '<g transform="translate(8176.361 -1665.095)">';
                        $html .= '<rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>';
                        $html .= '<path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>';
                        $html .= '</g>';
                        $html .= '</svg>';
                        $html .= '</div>';
                        $html .= '</a>';
                        $html .= '</li>';
                        echo $html;
                    };
                ?>
                    <?php if ($_SESSION['member_info']) : ?>
                    <li>
                        <a class="w-100" href="/media/">
                            <div class="link-name">メディアコンテンツ</div>
                            <div class="about-page_link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                    <g transform="translate(8176.361 -1665.095)">
                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                    </g>
                                </svg>
                             </div>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>