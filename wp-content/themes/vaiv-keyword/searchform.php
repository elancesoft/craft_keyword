<form id="searchform" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="search-textbox-wrap d-flex">
    <div class="align-self-center">
      <button type="submit" class="btn-search"><i class="bi-search"></i></button>
    </div>
    <div class="flex-grow-1 align-self-center">
      <input type="text" class="search-field" name="s" placeholder="최신 트렌드를 찾아보세요" value="<?php echo get_search_query(); ?>">
    </div>
    <div class="align-self-center">
      <select name="search-type" class="search-type">
        <option value="1">전체</option>
        <option value="2">제목 + 내용</option>
        <option value="3">해시태그</option>
      </select>
    </div>
  </div>

  <div class="hastags-suggestion">
    <label>추천 검색어</label>
    <a href="<?php echo esc_url(home_url('?s=트렌드')); ?>">트렌드</a>
    <a href="<?php echo esc_url(home_url('?s=MZ세대')); ?>">MZ세대</a>
    <a href="<?php echo esc_url(home_url('?s=인사이트')); ?>">인사이트</a>
  </div>
</form>