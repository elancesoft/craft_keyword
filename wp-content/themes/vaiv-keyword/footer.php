<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VAIV_Keyword
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container-footer">
		<div class="row g-0">
			<div class="col-md-9 order-2 order-md-1">
				<div class="d-block d-md-flex">
					<div class="footer-logo">
						<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/images/logo-vaiv.png'; ?>" alt="logo" /></a>
					</div>
					<p class="site-info">
						(주)바이브컴퍼니ㅣ대표자: 이재용ㅣ사업자등록번호 : <a href="tel:120-86-08334">120-86-08334</a><br>
						생활변화관측소 서비스 문의 <a href="mailto:7outof1000@vaiv.kr">7outof1000@vaiv.kr</a>ㅣCopyrightⓒVAIV Company inc. All Rights Reserved.
					</p>
				</div>
			</div>
			<div class="col-md-3 order-1 order-md-2">
				<div class="row g-0">
					<div class="col-md-6">
						<div class="footer-social-wrap text-center text-md-end">
							<ul class="social-list">
								<li class="social-item social-list__blog"><a href="https://blog.naver.com/PostList.nhn?blogId=daumsoft_korea" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-b-icon.png'; ?>" /></a></li>
								<li class="social-item social-list__facebook"><a href="https://www.facebook.com/VAIVcompany" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-f-icon.png'; ?>" /></a></li>
								<li class="social-item social-list__instagram"><a href="https://www.instagram.com/vaiv_official" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-i-icon.png'; ?>" /></a></li>
								<li class="social-item social-list__youtube"><a href="https://www.youtube.com/channel/UCe-PKPEl2nkwrC__8Qy1HUg" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-y-icon.png'; ?>" /></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="family-sites text-center text-md-end">
							<select class="familysite_option" title="패밀리사이트 바로가기" onchange="if(this.value) window.open(this.value);">
								<option value="" selected="">패밀리사이트</option>
								<option value="https://some.co.kr/">Sometrend</option>
								<option value="http://new-biz.some.co.kr/">Sometrend Biz</option>
								<option value="https://money.some.co.kr/">Somemoney</option>
								<option value="https://reviewplus.co.kr/">Review+ Beauty</option>
								<option value="http://www.smartcityinstitute.kr/">스마트시티 연구소</option>
								<option value="http://www.7outof1000.com/">생활변화관측소</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>