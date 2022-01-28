<?php

/**
 * Template Name: About Page
 */

get_header();
?>

<main id="primary" class="site-main">
  <div class="container">
    <div class="aboutus-banner main-banner-section">

      <div class="aboutus-banner-text text-center">
        <h1 class="entry-title">
          <span class="main-color-black">상식의 변화,</span><br>
          그 이상의 데이터
        </h1>
        <div class="aboutus-banner-desc">
          “데이터는 사실의 집합이며<br>
          더 중요한 것은 그 안에서 ‘이야기’를 읽어내는 능력입니다.<br>
          생활변화관측소는 사실에서 통찰을 읽어 콘텐츠를 만듭니다.”
        </div>
      </div>
    </div>

    <div class="aboutus-description" data-aos="fade-up">
      <?php
      while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
    </div>

    <div class="aboutus-activity">
      <div class="row">
        <div class="col-md-4">
          <div class="aboutus-activity-item" data-aos="fade-right">
            <div class="aboutus-activity-image"><img src="<?php echo get_template_directory_uri() . '/assets/images/aboutus-activity-1.png' ?>" /></div>
            <h3 class="aboutus-activity-title">빅데이터 관측 경험 19년</h3>
            <div class="aboutus-activity-desc">2004년 VOC 분석 시스템 구축</div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="aboutus-activity-item" data-aos="fade-right" data-aos-delay="500">
            <div class="aboutus-activity-image"><img src="<?php echo get_template_directory_uri() . '/assets/images/aboutus-activity-2.png' ?>" /></div>
            <h3 class="aboutus-activity-title">빅데이터 커버리지 326억 건</h3>
            <div class="aboutus-activity-desc">블로그·인스타그램·트위터·커뮤니티· 유튜브 채널의 소셜 빅데이터 분석</div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="aboutus-activity-item" data-aos="fade-right" data-aos-delay="1000">
            <div class="aboutus-activity-image"><img src="<?php echo get_template_directory_uri() . '/assets/images/aboutus-activity-3.png' ?>" /></div>
            <h3 class="aboutus-activity-title">모니터링 키워드 1만 9000개</h3>
            <div class="aboutus-activity-desc">일상에서 사용하는 대화·브랜드·상황에 대한 모든 키워드 모니터링</div>
          </div>
        </div>
      </div>
    </div>


    <div class="aboutus-introduction text-center text-md-start">
      <h2 class="module-title main-color-blue" data-aos="fade-up">활동 소개</h2>

      <div class="row mt-5" data-aos="fade-up">
        <div class="col-md-3">
          <h3 class="module-sub-title main-color-black bg-border d-inline-block pb-1 mb-3">트렌드 관측</h3>
        </div>
        <div class="col-md-9">
          <p>
            다양한 산업 분야에 대해 전문성을 갖춘 빅데이터 연구원들이<br>
            매주 데이터를 관측하고, 그 안에서 찾아낸 새로운 인사이트를 소개합니다.
          </p>
          <p class="aboutus-introduction-link-more text-end text-md-start"><a href="#">더 알아보기 ></a></p>
        </div>
      </div>

      <div class="row mt-5" data-aos="fade-up">
        <div class="col-md-3">
          <h3 class="module-sub-title main-color-black bg-border d-inline-block pb-1 mb-3">세미나</h3>
        </div>
        <div class="col-md-9">
          <p>
            생활변화관측소에서는 매년 연구한 트렌드 바탕으로 트렌드 보고회를 개최합니다.<br>
            학술 콘퍼런스와 세미나를 통해 거시적인 트렌드를 확인하고 각 산업 군의 동향을 파악 할 수 있습니다.
          </p>
        </div>
      </div>

      <div class="row mt-5" data-aos="fade-up">
        <div class="col-md-3">
          <h3 class="module-sub-title main-color-black bg-border d-inline-block pb-1 mb-3">트렌드 관측</h3>
        </div>
        <div class="col-md-9">
          <p>
            <트렌드 노트>는 생활변화관측소에서 매년 발간하는 트렌드 서적입니다.<br>
              빅데이터 분석 결과를 바탕으로 우리가 살아가는 세상의 변화를 관측하고 완결된 이야기로 전달합니다.
          </p>
          <p class="aboutus-introduction-link-more text-end text-md-start"><a href="#">더 알아보기 ></a></p>
        </div>
      </div>
    </div>


  </div><!-- container -->

</main><!-- #main -->

<?php
get_footer();
