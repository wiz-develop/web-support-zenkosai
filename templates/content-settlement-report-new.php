<div class="settlement-report">
    <div class="page-content-wrapper columns p-0">
        <div class="container mt-0">
            <div class="page-content-innerwrap">
                <h3>決算報告</h3>
                    <div class="page-content-div">
                        <h4>一般財団法人全国福利厚生共済会貸借対照表（B/S）</h4>
                            <?php
                                $page_data = get_page_by_path('about/settlement-report');
                                $page_id = $page_data->ID;
                                foreach( CFS()->get('report_list', $page_id) as $report_list ) :
                            ?>
                                <div class="report-list">
                                    <button class="btn btn-primary acor-about-menu">
                                        <p class="mb-0"><?php echo $report_list['year']; ?></p>
                                    </button>
                                    <div class="report-list__detail acor-menu-child">
                                        <?php
                                            $fields = $report_list['table'];
                                            foreach ((array)$fields as $field):
                                        ?>
                                            <div class="report-list__detail__table" id="">
                                                <h5><?php echo $field['table_name']; ?></h5>
                                                    <div class="">
                                                        <?php echo $field['financial_results']; ?>
                                                        <p class="mb-0">
                                                        （単位：千円）
                                                        </p>
                                                    </div>
                                            </div>
                                        <?php
                                            endforeach;
                                        ?>
                                    </div>
                                </div>
                            <?php
                                endforeach;
                            ?>
                    </div>
            </div>
            <?php get_template_part('templates/about-nav_new');?>
        </div>
    </div>
</div>

<script>
jQuery(function($){
    $(document).on('click','.acor-about-menu',function(){
        $(this).toggleClass("opened");
        $(this).next('.acor-menu-child').toggleClass('opened');

    });
});
</script>
<style>
    .report-list__detail{
        display: none;
        height: 0;
        transition: height .5s ease-out;
    }
    .report-list__detail.opened{
        display: flex;
        height: auto;
        transition: height .5s ease-out;
    }
</style>