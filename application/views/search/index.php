<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-wrap srch">
	<div class="main-wrap-inner">
		<div class="content">

			<p class="main-tit">바로 보는 AI 법률 상담, 바로</p>
			<div class="m-logo"></div>
			<div class="srch-inner">
				<div class="srch-boxwrap">

					<?php
					$attributes = array('class' => '', 'name' => 'defaultForm', 'id' => 'defaultForm');
					echo form_open(site_url(), $attributes);
					?>
					<input type="hidden" name="tag1" class="tag" value="">
					<input type="hidden" name="tag2" class="tag" value="">
					<input type="hidden" name="tag3" class="tag" value="">

					<input type="text" name="question" class="srch-input" placeholder="상담사례, 판례 AI 맞춤 검색">
					<button id="q-btn" class="srch-btn" type="button" ></button>
					<?php echo form_close(); ?>
				</div>
				<div class="srch-catewrap">
					<button type="button" class="cate-li">성범죄</button>
					<button type="button" class="cate-li">임대차</button>
					<button type="button" class="cate-li">계약일반</button>
					<button type="button" class="cate-li">행정</button>
					<button type="button" class="cate-li">금융</button>
					<button type="button" class="cate-li">노동/인사</button>
					<button type="button" class="cate-li">IT/테크</button>
					<button type="button" class="cate-li">기업일반</button>
					<button type="button" class="cate-li">등기/등록</button>
					<button type="button" class="cate-li">지식재산권</button>
					<button type="button" class="cate-li">회생파산</button>
					<button type="button" class="cate-li">손해배상</button>
					<button type="button" class="cate-li">기타</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="loading2 displaynone">
	<div class="loading-inner">
		<div class="circle one"></div>
		<div class="circle two"></div>
		<div class="circle three"></div>
	</div>
	<p>결과를 불러오고 있습니다.</p>
</div>
<?php
$attributes = array('class' => '', 'name' => 'goSearchAll', 'id' => 'goSearchAll');
echo form_open(site_url('/search/result'), $attributes);
?>
	<input type="hidden" name="keyword">
	<input type="hidden" name="filename">
<?php echo form_close(); ?>
<script>
	$(document)
		.ajaxStart(function () {
			$('.loading2').removeClass('displaynone');
		})
		.ajaxStop(function () {
			$('.loading2').addClass('displaynone');
		});
	$(".main-wrap").on("focusin", function(){
		$(".srch-catewrap").addClass('active', 300);
	})
		.on("focusout", function(){
			$(".srch-catewrap").removeClass('active',300);
		});
	$(".cate-li").on("click", function(){
		$(this).toggleClass("on")
		if($('.cate-li.on').length >= 4){
			alert('정확한 상담 결과를 위해 상담 분야는 최대 3개 까지 선택하실 수 있습니다.' );
			$(this).removeClass('on');
		}else{
			$('.tag').remove();
			$(document).ready(function(){
				$('.cate-li.on').each(function(index){
					$('#defaultForm').append('<input type="hidden" name="tag'+(index+1)+'" class="tag"  value="'+$(this).html()+'" />')
				});
			})
		}
	});

	$('#q-btn').on('click',function(){
		var txt_co = $('input[name=question]')
		var lion = $('.cate-li.on').length;
		var check = true;
		if(lion < 1) {
			alert('상담 분야는 최소 1개 이상 선택해주세요.')
			check = false
		}
		if(txt_co.val().length < 10) {
			alert('정확한 상담 결과를 위해 상담 내용은 최소 10자 이상 작성해주세요.')
			check = false
		}

		if(check){

			$.ajax({
				url: '/api/run',
				data: $('#defaultForm').serialize(),
				method: "POST",
				async:true,
				success: function (data) {
					console.log(data)
					if(data.status){
						$('input[name=keyword]').val(txt_co.val());
						$('input[name=filename]').val(data.resultFile);
						$('#goSearchAll').submit()
					}else{
						alert('관련 판례ᆞ사례 가 없거나. 요청한 데이터에 문제가 있습니다.')
					}
				},
			});
		}
	});
	$('.q-box ul li').click(function(){
		$(this).toggleClass('on');
		if($('.q-box ul li.on').length >= 4){
			// $('.text-e1').addClass('on');
			$('.input-box').prev().append('' +
				defaultHtmlHeader +
				'<div class="text-e1">' +
				'정확한 상담 결과를 위해 상담 분야는<br>최대 3개 까지 선택하실 수 있습니다.' +
				'</div>'+
				defaultHtmlFooter
			);
			$(this).removeClass('on');
		}else{
			$('.tag').remove();
			$(document).ready(function(){
				$('.q-box ul li[class=on]').each(function(index){
					$('#defaultForm').append('<input type="hidden" name="tag'+(index+1)+'" class="tag"  value="'+$(this).html()+'" />')
				});
			})
		}

	});
</script>
