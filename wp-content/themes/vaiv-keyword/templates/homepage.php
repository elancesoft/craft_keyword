<?php

/**
 * Template Name: Home Page
 */

get_header();
?>

<main id="primary" class="site-main">
  <div class="container">
    <div class="hot-brand">
      <div class="row">
        <div class="col-5">
          <div>
            <div data-aos="fade-up">
              <h4 class="hot-brand-date fade show">2022년 01월 1주</h4>
              <h3 class="widget-title hot-brand-title">화제의 브랜드</h3>
            </div>

            <div class="hot-brand-detail" data-aos="fade-up" id="hot-brand-top1">
              <div><span class="hot-brand-detail-item-order">Top 1</span><span class="hot-brand-detail-item-title">카카오페이</span></div>
              <div class="hot-brand-detail-text">
                <a href="#">
                  카카오페이가 모으는 행복 이벤트를 진행하여 사람들의 언어 속에 많이 떠올랐다.
                  카카오페이 앱으로 프로모션 공유만 해도 커피 재료 5가지 중 한가지를 주는 이벤트를 통해 많이 회자되고 공유되었다.
                </a>
              </div>
            </div>

            <div class="hot-brand-detail d-none" data-aos="fade-up" id="hot-brand-top2">
              <div><span class="hot-brand-detail-item-order">Top 2</span><span class="hot-brand-detail-item-title">리니지</span></div>
              <div class="hot-brand-detail-text">
                <a href="#">
                  카카오페이가 모으는 행복 이벤트를 진행하여 사람들의 언어 속에 많이 떠올랐다.
                  카카오페이 앱으로 프로모션 공유만 해도 커피 재료 5가지 중 한가지를 주는 이벤트를 통해 많이 회자되고 공유되었다.
                </a>
              </div>
            </div>

            <div class="hot-brand-detail d-none" data-aos="fade-up" id="hot-brand-top3">
              <div><span class="hot-brand-detail-item-order">Top 3</span><span class="hot-brand-detail-item-title">키세스</span></div>
              <div class="hot-brand-detail-text">
                <a href="#">
                  카카오페이가 모으는 행복 이벤트를 진행하여 사람들의 언어 속에 많이 떠올랐다.
                  카카오페이 앱으로 프로모션 공유만 해도 커피 재료 5가지 중 한가지를 주는 이벤트를 통해 많이 회자되고 공유되었다.
                </a>
              </div>
            </div>

          </div>
        </div>

        <div class="col-7">
          <div class="hot-brand-right" data-aos="fade-up">
            <ul class="hot-brand-list">
              <li class="host-brand-item active" data-alias="hot-brand-top1"><span>1. 카카오페이</span></li>
              <li class="host-brand-item" data-alias="hot-brand-top2"><span>2. 리니지</span></li>
              <li class="host-brand-item" data-alias="hot-brand-top3"><span>3. 키세스</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="today-pick">
      <div class="row">
        <div class="col-md-4">
          <div data-aos="fade-up">
            <h3 class="widget-title today-pick-title mb-4">오늘의 PICK</h3>
            <p class="mb-0">지금 가장 주목받고 있는 콘텐츠</p>
            <h4 class="widget-title today-pick-sub-title">누림의 대중화</h4>
          </div>
        </div>
        <div class="col-md-8">
          <div class="content-today-pick">
            <div class="today-pick-thumbnails">
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="your-class">
      <div>your content 1</div>
      <div>your content 2</div>
      <div>your content 3</div>
    </div>

    <div class="trend">
      <div data-aos="fade-up">
        <h3 class="widget-title">요즘 트렌드</h3>
        <p>데이터로 찾아낸 떠오르는 트렌드</p>
      </div>

      <div class="trend-list" data-aos="fade-up">
        <div class="row">
          <div class="col-md-4">
            <div class="card mb-3">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/trend-1.png' ?>" class="card-img-top" alt="Trend 1">
              <div class="card-body">
                <h5 class="card-title">벤츠를 역적한 테슬라</h5>
                <p class="card-text"><small class="text-muted">2022년 01월 1주</small></p>
                <p class="card-text">테슬라가 100년 전통의 브랜드 벤츠를 역전하다. 혁신과 미래의 아이콘으로 성장한 테슬라.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-3">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/trend-2.png' ?>" class="card-img-top" alt="Trend 2">
              <div class="card-body">
                <h5 class="card-title">지구에 대한 죄책감과 도구 </h5>
                <p class="card-text"><small class="text-muted">2022년 01월 1주</small></p>
                <p class="card-text">소비 변화의 커다란 키워드 ‘죄책감’, 2021년 사람들은 ‘죄책감’을 더 많이 느끼고 더 넓은 영역에서 죄책감을 느낀다.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-3">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/trend-3.png' ?>" class="card-img-top" alt="Trend 3">
              <div class="card-body">
                <h5 class="card-title">일상을 정비하 는 느린 책 읽기</h5>
                <p class="card-text"><small class="text-muted">2022년 01월 1주</small></p>
                <p class="card-text">
                  1. 독자와 작가의 새로운 관계 형성<br>
                  2. 코드를 갖춘 장르성<br>
                  3. 편당 100원이라는 새로운 과금 체계
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="text-end py-3 trend-link-more">
          <a href="#">더 보기 ></a>
        </div>
      </div>
    </div>

    <div class="monthly-insight">
      <div data-aos="fade-up">
        <h3 class="widget-title">월간 인사이트</h3>
        <p>오직 한 달에 한 번, 관측소 연구원이 기록한 인사이트</p>
      </div>

      <div class="monthly-insight-content">
        <div class="row">
          <div class="col-md-4" data-aos="fade-right">
            <a href=""><img src="<?php echo get_template_directory_uri() . '/assets/images/monthly-insight.png' ?>" class="img-fluid" alt="monthly insight"></a>
          </div>

          <div class="col-md-1">&nbsp;</div>

          <div class="col-md-5" data-aos="fade-left">
            <p class="monthly-insight-content-date">2022년 01월 호</p>
            <h3 class="monthly-insight-content-title">디지털 콘텐츠의 교본, 웹소설의 작동방식</h3>
            <p class="monthly-insight-content-writer">박현영 소장</p>
            <div class="monthly-insight-content-desc">
              <a href="#">
                생활변화관측소에서 웹소설에 주목하기 시작한 것은 대표적인 웹소설 플랫폼 리디북스가 교보문고를 역전하던 때부터이다. 2019년 상반기, 대표적 웹소설 콘텐츠 플랫폼인 리디북스의 언급량이 교보문고를 앞질렀다.
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="text-end monthly-insight-link-more">
        <a href="#">더 보기 ></a>
      </div>
    </div>
  </div>
</main><!-- #main -->

<?php
get_footer();
