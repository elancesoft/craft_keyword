<?php

/**
 * Template Name: Brand Ranking Page
 */

get_header();
?>

<?php
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
?>
<main id="primary" class="site-main">
  <div class="container">
    <?php
    if (!empty($id)) :
      /*********************************** SHOW THE BRAND RANKING DETAILS */
    ?>
      <div class="brandranking-detail">
        <div class="row">
          <div class="col-md-5 order-2 order-md-1 text-center text-md-start">
            <h2 class="widget-title mb-4">브랜드 랭킹</h2>
            <h2 class="widget-sub-title-light">2022년 01월 4주</h2>

            <div class="brandranking-detail-hastag">
              <div class="brandranking-detail-hastag-top12 mb-2">
                <span># 식음</span><span># 모빌리티</span>
              </div>
              <div class="brandranking-detail-hastag-top345">
                <span># 리빙</span><span># 패션</span><span># 뷰티</span>
              </div>
            </div>
            <div class="brandranking-detail-copyright">
              출처 표기 방식<br>
              바이브컴퍼니 생활변화관측소 브랜드 랭킹
            </div>
          </div>

          <div class="col-md-7 order-1 order-md-2">
            <div class="brandranking-detail-image">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/brand-ranking-list-bg.png' ?>" class="img-fluid" alt="brank ranking">
              <div class="brandranking-detail-top3">
                <ul class="brandranking-detail-top3-list">
                  <li class="brandranking-detail-top3-item active"><span>1. 카카오페이</span></li>
                  <li class="brandranking-detail-top3-item"><span>2. 리니지</span></li>
                  <li class="brandranking-detail-top3-item"><span>3. 키세스</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="brandranking-detail-top3-slider-wrap">
          <div class="row justify-content-center">
            <div class="col-10">
              <div class="brandranking-detail-top3-slider">
                <div class="brandranking-detail-top3-slider-item">
                  <h3 class="brandranking-detail-top3-slider-item-order">1<span>st</span></h3>
                  <div class="brandranking-detail-top3-slider-item-title">로스트아크</div>
                  <div class="brandranking-detail-top3-slider-item-logo">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/logo-1.png' ?>" alt="Logo" />
                  </div>
                  <div class="brandranking-detail-top3-slider-item-keyword">메이플난민</div>
                  <div class="brandranking-detail-top3-slider-item-social social-twitter">
                    <i class="bi-twitter"></i> <span>23.22</span>
                  </div>
                </div>
                <div class="brandranking-detail-top3-slider-item">
                  <h3 class="brandranking-detail-top3-slider-item-order">2<span>nd</span></h3>
                  <div class="brandranking-detail-top3-slider-item-title">구찌</div>
                  <div class="brandranking-detail-top3-slider-item-logo">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/logo-2.png' ?>" alt="Logo" />
                  </div>
                  <div class="brandranking-detail-top3-slider-item-keyword">슬기</div>
                  <div class="brandranking-detail-top3-slider-item-social social-twitter">
                    <i class="bi-twitter"></i> <span>23.22</span>
                  </div>
                </div>
                <div class="brandranking-detail-top3-slider-item">
                  <h3 class="brandranking-detail-top3-slider-item-order">3<span>rd</span></h3>
                  <div class="brandranking-detail-top3-slider-item-title">폭스바겐</div>
                  <div class="brandranking-detail-top3-slider-item-logo">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/logo-3.png' ?>" alt="Logo" />
                  </div>
                  <div class="brandranking-detail-top3-slider-item-keyword">카이</div>
                  <div class="brandranking-detail-top3-slider-item-social social-twitter">
                    <i class="bi-twitter"></i> <span>23.22</span>
                  </div>
                </div>
                <div class="brandranking-detail-top3-slider-item">
                  <h3 class="brandranking-detail-top3-slider-item-order">4<span>th</span></h3>
                  <div class="brandranking-detail-top3-slider-item-title">로스트아크</div>
                  <div class="brandranking-detail-top3-slider-item-logo">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/logo-1.png' ?>" alt="Logo" />
                  </div>
                  <div class="brandranking-detail-top3-slider-item-keyword">메이플난민</div>
                  <div class="brandranking-detail-top3-slider-item-social social-twitter">
                    <i class="bi-twitter"></i> <span>23.22</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="brandranking-detail-top10">
          <div class="row">
            <div class="col-md-2 text-center text-md-start mb-3">
              <h2 class="widget-sub-title"><span class="main-color-blue">TOP 10</span> 랭킹</h2>
            </div>
            <div class="col-6 col-md-5 mb-3">
              <a href="#" class="brandranking-detail-download">이미지로 저장 <i class="bi-download"></i></a>
            </div>
            <div class="col-6 col-md-5 mb-3 text-end">
              <span class="brandranking-detail-viewcount"><i class="bi-eye"></i> 200</span>
              <span class="brandranking-detail-share"><i class="bi-share"></i></span>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-brandranking-detail">
              <thead>
                <tr>
                  <th scope="col">순위</th>
                  <th scope="col" colspan="2">브랜드명</th>
                  <th scope="col" style="min-width: 180px;">
                    관련이슈 키워드
                    <button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="분석 기간 직전 8일에<br>없었던 새롭게 등장한 연관어">
                      <i class="bi-question"></i>
                    </button>
                  </th>
                  <th scope="col" style="min-width: 130px;">
                    HOT 채널
                    <button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="언급량 증가를<br>이끈 소셜 채널">
                      <i class="bi-question"></i>
                    </button>
                  </th>
                  <th scope="col" style="min-width: 110px;">
                    SCORE
                    <button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="최근 8일 간의 언급량과 직전 8일 대비<br>언급량 변동성을 합산한 점수">
                      <i class="bi-question"></i>
                    </button>
                  </th>
                  <th scope="col"><i class="bi-dash"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($i = 1; $i <= 10; $i++) :
                ?>
                  <tr>
                    <td class="text-center"><?php echo $i; ?></td>
                    <td>Lostank</td>
                    <td>로스트아크</td>
                    <td class="text-center">메이플난민</td>
                    <td class="text-center social-twitter"><i class="bi-twitter"></i></td>
                    <td class="main-color-blue text-center">52.65</td>
                    <td class="text-center">
                      <span class="table-brandranking-detail-collapse" data-bs-toggle="collapse" data-bs-target="#brandranking-detail-item-<?php echo $i; ?>" aria-expanded="false">
                        <i class="arrow-direction bi-chevron-down"></i>
                      </span>
                    </td>
                  </tr>
                  <tr id="brandranking-detail-item-<?php echo $i; ?>" class="brandranking-detail-item-collapse collapse">
                    <td colspan="7" class="text-center py-4 table-brandranking-detail-desc">
                      메이플스토리 사태 이후 1주일 만에 40만 가까운 유저가 로스트아크로 이주하며 '메이플 난민'이라는 호칭을 얻게 되었다.<br>
                      또한 비슷한 이슈로 문제를 겪고 있던 게임들의 유저들도 이주하며 3개월 만에 등록된 캐릭터 수가 2배가량 증가하게 되었다
                    </td>
                  </tr>
                <?php
                endfor;
                ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    <?php
    else :
      /*********************************** SHOW THE BRAND RANKING LIST */
    ?>
      <div class="brandrakinglist-description">
        <div class="row">
          <div class="col-md-6 order-2 order-md-1" data-aos="fade-right">
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

          <div class="col-md-6 order-1 order-md-2">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/brand-ranking-list-bg.png' ?>" class="img-fluid" alt="brank ranking">
          </div>
        </div>
      </div>

      <div class="brandranking-top10">
        <div class="brandranking-top10-header" data-aos="fade-up">
          <h2 class="widget-title-light">매주 목요일</h2>
          <h2 class="widget-title">이 주의 <span class="main-color-blue">관심 브랜드</span>와</h2>
          <h2 class="widget-title"><span class="main-color-blue">이슈 키워드</span> TOP 10</h2>

          <p class="mt-5">브랜드 랭킹은 최근 8일간의 언급량과 직전 8일 대비 언급 증가율을 합산하여 도출</p>
        </div>

        <div class="brandranking-top10-list">
          <div class="row">
            <?php
            for ($i = 1; $i <= 12; $i++) {
            ?>
              <div class="col-md-4">
                <div class="brandranking-top10-item aos-init aos-animate" data-aos="fade-up">
                  <h3 class="brandranking-top10-item-month">10</h3>
                  <p class="brandranking-top10-item-week"><a href="./?id=<?php echo $i; ?>">2021년 10월 4주</a></p>
                  <p class="brandranking-top10-item-period">10.25 - 10.31</p>
                  <div class="brandranking-top10-item-hastag">
                    <span>#카카오페이</span><span>#페이스북</span><span>#스타벅스</span>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php
    endif;
    ?>

  </div><!-- container -->

</main><!-- #main -->

<?php
get_footer();
