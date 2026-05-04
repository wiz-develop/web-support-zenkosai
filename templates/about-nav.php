<div class="about-nav about-paper-bg">
    <h3 class="mb-3 container"><span class="about-title">全厚済とは</span></h3>
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
                echo '<ul>';
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
                    $html .= esc_html( $child->post_title );
                    $html .= '</a>';
                    $html .= '</li>';
                    echo $html;
                }
                echo '<li class="w-keepall"><a href="https://nihonkyosai.co.jp/">運営業務委託先：<br>日本共済株式会社</a></li>
                </ul>';
                ?>
        </div>
</div>