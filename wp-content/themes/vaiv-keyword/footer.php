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

<footer id="colophon" class="bg-black-59 mt-[72px] md:mt-[124px]  xl:mt-[200px] 2xl:mt-[208px]">
	<div class="container mx-auto pt-[32px] pb-60 md:max-w-[845px] md:pt-[47px] md:pb-[85px] xl:max-w-[1280px] xl:pt-[74px] xl:pb-[118px] 2xl:max-w-[1800px]">
		<div class="grid text-center md:grid-rows-none md:grid-cols-12">
			<div class="order-2 flex justify-center mt-[52px] md:mt-0 md:order-1">
				<a href="http://vaiv.kr/" class="inline-block"><img src="<?php echo get_template_directory_uri() . '/assets/images/logo-vaiv.png'; ?>" class="h-auto w-[84px] md:mt-1 md:w-[75px] 2xl:w-[139px] " alt="logo" /></a>
			</div>

			<div class="order-3 text-11 font-light mt-20 md:text-left md:col-start-2 md:col-span-8 md:order-2 md:mt-0 md:text-10 md:pl-4 xl:text-18 text-white 2xl:col-start-3 2xl:col-span-6 2xl:pl-0">
				(주)바이브컴퍼니ㅣ대표자: 이재용ㅣ<br class="md:hidden" />사업자등록번호 : <a href="tel:120-86-08334">120-86-08334</a><br />
				생활변화관측소 서비스 문의 <a href="mailto:7outof1000@vaiv.kr">7outof1000@vaiv.kr</a>ㅣ<br class="md:hidden" />CopyrightⓒVAIV Company inc. All Rights Reserved.
			</div>

			<div class="order-1 md:flex md:items-center md:justify-end md:order-3 md:col-span-3 md:col-end-13">
				<ul class="flex gap-6 justify-center items-center md:justify-between md:w-full  md:gap-0 ">
					<li><a href="https://blog.naver.com/PostList.nhn?blogId=daumsoft_korea" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-b-icon.png'; ?>" class="h-auto w-[23px] md:w-[14px] xl:w-[23px]" alt="" /></a></li>
					<li><a href="https://www.facebook.com/VAIVcompany" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-f-icon.png'; ?>" class="h-auto w-[16px] md:w-[10px] md: xl:w-[16px]" alt="" /></a></li>
					<li><a href="https://www.instagram.com/vaiv_official" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-i-icon.png'; ?>" class="h-auto w-[31px] md:w-[19px] xl:w-[31px]" alt="" /></a></li>
					<li><a href="https://www.youtube.com/channel/UCe-PKPEl2nkwrC__8Qy1HUg" target="_blank"><img src="<?php echo get_template_directory_uri() . '/assets/images/social-y-icon.png'; ?>" class="h-auto w-[30px] md:w-[22px] xl:w-[35px]" alt="" /></a></li>
					<li class="hidden md:inline-flex">
						<select class="select-family" onchange="if(this.value) window.open(this.value);">
							<option value="" selected="">패밀리사이트</option>
							<option value="http://vaiv.kr/">바이브컴퍼니</option>
							<option value="https://some.co.kr/">Sometrend</option>
							<option value="https://biz.some.co.kr/login/">Sometrend Biz</option>
						</select>
					</li>
				</ul>

				<div class="flex mt-20 justify-center md:hidden">
					<select class="select-family" onchange="if(this.value) window.open(this.value);">
						<option value="" selected="">패밀리사이트</option>
						<option value="http://vaiv.kr/">바이브컴퍼니</option>
						<option value="https://some.co.kr/">Sometrend</option>
						<option value="https://biz.some.co.kr/login/">Sometrend Biz</option>
					</select>
				</div>


			</div>

		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>