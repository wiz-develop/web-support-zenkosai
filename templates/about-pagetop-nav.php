<div class="about-pagetop-nav">
    <div class="container">
        <?php
            // 指定したIDの子ページ一覧を表示
            $page_ID = get_page_by_path('about');
            $args = array(
                'post_parent' => $page_ID->ID,
                'post_status' => 'publish',
                'post_type'   => 'page',
                'order'       => 'ASC',
                'orderby'     => 'menu_order',
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
                $html .= '</a>';
                $html .= '</li>';
                echo $html;
            }
        ?>
            <?php if ($_SESSION['member_info']) : ?>
                <li>
                    <a class="w-100" href="/media/">
                        <div class="link-name">メディアコンテンツ</div>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
