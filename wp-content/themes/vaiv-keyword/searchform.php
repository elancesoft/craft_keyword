<form id="searchform" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="search-textbox-wrap d-flex">
    <div class="d-flex align-self-center">
      <button type="submit" class="btn-search-form">&nbsp;</button>
    </div>
    <div class="flex-grow-1 align-self-center">
      <input type="text" class="search-field" name="s" placeholder="최신 트렌드를 찾아보세요" value="<?php echo get_search_query(); ?>">
    </div>
    <div class="align-self-center">
      <div class="dropdown-wrap d-none">
        <div class="dropdown-select">
          <div class="dropdown-select-value">전체</div>
        </div>

        <div class="dropdown-list">
          <div class="dropdown-item-option">전체</div>
          <div class="dropdown-item-option">제목 + 내용</div>
          <div class="dropdown-item-option">해시태그</div>
        </div>
      </div>
      
      <select name="search_type" class="search-type">
        <option value="1">전체</option>
        <option value="2">제목 + 내용</option>
        <option value="3">해시태그</option>
      </select>
    </div>
  </div>

  <?php
  // Get recommended keywords from config
  $search_options = get_field('search', 'options');
  $recommended_keywords = $search_options['recommend_keywords'];

  if (sizeof($recommended_keywords) > 0) {

    $html_recommended_keywords = '';
    foreach ($recommended_keywords as $item) {
      $link = esc_url(home_url('?s=' . $item['recommend_keyword_text']));
      $html_recommended_keywords .= '<a href="' . $link . '">' . $item['recommend_keyword_text'] . '</a>';
    }

    echo '
    <div class="hastags-suggestion">
      <label>추천 검색어</label>
      ' . $html_recommended_keywords . '
    </div>';
  }
  ?>


</form>