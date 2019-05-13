<?php

add_action('wp_ajax_filter_all', 'filter_all');
add_action('wp_ajax_nopriv_filter_all', 'filter_all');

function filter_all() {
    if (isset($_POST['filters'])) {
        $filters = $_POST['filters'];
        if (empty($filters[2])) {
            $filters[2] = [];
        }
        $cat = $_POST['cat'];

        $postHandler = new postHandler();

        $search_result = array();
        if (isset($_POST['searchIDs'])) {
            $search_result = $_POST['searchIDs'];
        }

        $chunks = $postHandler->getFiltered('no', $filters, $cat, $search_result);

        $numberOfResults = $postHandler->numberOfResults;

        if (!$chunks) {
            echo '<span class="no-results-text">';
            pll_e('ingen träff');
            echo '</span>';
        }

        foreach ($chunks[0] as $index => $postdata) {
            $post = get_post($postdata);
            include locate_template('template-parts/content/content-shop.php');
        }

        $chunks = json_encode($chunks);
        echo '
        <script type="text/javascript">
            chunks = ' . $chunks . '
        </script>
        ';

        echo '<span id="nmbOfResults" style="display: none">' . $numberOfResults . '</span>';
    }

    wp_send_json_error('Error');
}
