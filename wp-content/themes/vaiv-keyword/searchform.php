<form id="searchform" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="search-textbox-wrap d-flex">
    <button type="submit" class="btn-search"><i class="bi-search"></i></button>
    <input type="text" class="search-field" name="s" placeholder="최신 트렌드를 찾아보세요" value="<?php echo get_search_query(); ?>">
    <select name="search-type" class="search-type">
      <option value="1">전체</option>
      <option value="2">제목 + 내용</option>
      <option value="3">해시태그</option>
    </select>
  </div>

  <div class="hastags-suggestion">
    <a href="#">추천 검색어</a>
    <a href="#">트렌드</a>
    <a href="#">MZ세대</a>
    <a href="#">인사이트</a>
  </div>
</form>