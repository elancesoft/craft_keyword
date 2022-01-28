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
	<div class="container-fluid">
		<div class="row">
			<div class="col-2">
				<img class="footer-logo" src="<?php echo get_template_directory_uri() . '/assets/images/logo-vaiv.png'; ?>" alt="logo" />
			</div>
			<div class="col-6">
				<p class="site-info">
					(주)바이브컴퍼니ㅣ대표자: 이재용ㅣ사업자등록번호 : <a href="tel:120-86-08334">120-86-08334</a><br>
					생활변화관측소 서비스 문의 <a href="mailto:7outof1000@vaiv.kr">7outof1000@vaiv.kr</a>ㅣCopyrightⓒVAIV Company inc. All Ri ghts Reserved.
				</p>
			</div>
			<div class="col-4">
				<div class="row">
					<div class="col-6">
						<div class="footer-social-wrap">
							<ul class="social-list">
								<li class="social-item social-list__blog"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-b-icon.png'; ?>" /></a></li>
								<li class="social-item social-list__facebook"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-f-icon.png'; ?>" /></a></li>
								<li class="social-item social-list__instagram"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-i-icon.png'; ?>" /></a></li>
								<li class="social-item social-list__youtube"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-y-icon.png'; ?>" /></a></li>
							</ul>
						</div>
					</div>
					<div class="col-6">
						<div class="family-sites">
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