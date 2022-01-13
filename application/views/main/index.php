<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-wrap">
	<form action="">
		<div class="content">
			<p class="main-tit">바로 보는 AI 법률 상담, 바로</p>
			<div class="m-logo"></div>
			<div class="a-btn">
				<a href="/chat" class="btn blue1 mb20">AI 법률 상담</a>
				<a href="/search" class="btn">유사 사례ᆞ판례 검색</a>

			</div>
			<a href="https://aisoftkorea.com/" class="add" target="_blank">Barlaw를 만든 사람들</a>
		</div>
	</form>
</div>
<!-- 모달 -->
<div class="modal">
	<div class="modalBg"></div>
	<div class="modalContent mo-cont90">
		<button type="button" class="modalClose"></button>
		<div class="modalBody mo-center">
			<div class="mo-bodyContent">
				<div class="mo-cont">
					<h2 class="mo-tit">이용 전 동의해 주세요</h2>
					<p class="mo-sub-tit">상담 결과는 참고자료로만 활용부탁드립니다.</p>
					<p class="mo-con mb35">Barlaw 인공지능 상담 서비스는  공공기관의 변호사 상담사례,  공개된 판례 빅데이터를 기반으로 개발되었습니다. <br>
						정확한 상담 결과를 위해 100만건이 넘는 법률 데이터를 학습시켰지만,  정확하지 않은 상담 결과가 나올 수도 있습니다. <br>
						Barlaw는 상담 결과에 대한 정확성을 보증하지 않습니다.</p>
					<p class="mo-sub-tit">법적 의사결정은 변호사와 상담 후 진행하시길 바랍니다.</p>
					<p class="mo-con">Barlaw는 이용자가 상담 결과를 신뢰하여  진행한 어떠한 행위나 결과에 대해책임지지 않습니다. <br>
						상담 결과는 참고자료로만 이용 부탁드리며,  법적 의사결정은 법률전문가인 변호사와 상의 부탁드 립니다.</p>
				</div>
			</div>
			<div class="hr mo-hr"></div>
			<p class="mo-gray">상담 결과의 모든 콘텐츠에 대한 상업적 목적의 게재, 무단 전제 및 재배포를 금합니다.</p>
			<div class="mo-check">
				<input type="checkbox" id="ck1"><label for="ck1">모든 내용을 확인하였으며 이에 동의합니다.</label>
			</div>
			<div class="modalBtn">
				<button type="button" class="btn btn-ok">확인</button>
			</div>
		</div>
	</div>
</div>
<script>

	$(function popupshow(){
		$(".modal").addClass('on');
	});
	$(".mo-open").click(function(){
		$(".modal").addClass('on');
		$('body').css('overflow', 'hidden');
	});
	$(".modalClose").on('click', function(){
		$(".modal").removeClass('on');
		$('body').css('overflow', 'auto');
	});
	// 버튼
	$(".modalBtn button").attr("disabled");
	$("#ck1").on('click',function(){
		var chk = $('input:checkbox[id="ck1"]').is(":checked");
		if(chk==true){
			$(".modalBtn .btn").attr('disabled');
			$(".modalBtn .btn").addClass("on");
		}else{
			$(".modalBtn .btn").removeAttr("disabled");
			$(".modalBtn .btn").removeClass("on");
		}
	});
	$(".modalBtn .btn").on('click',function(){
		var chk = $('input:checkbox[id="ck1"]').is(":checked");
		if(chk==true){
			$(".modal").removeClass('on');
			$('body').css('overflow', 'auto');
		}
	});


</script>
