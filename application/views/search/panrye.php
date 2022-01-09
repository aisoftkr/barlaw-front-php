<div class="main-wrap">
	<div class="subheader">
		<div class="srch-keyword" onclick="popupshow();">
			<p data-filetype="에 대한 검색 결과입니다."><span class="keyword"><?=$this->input->post('keyword')?></span></p>
		</div>
		<ul class="srch-tabUl" >
			<li class="on"><a href="#" data-id="1">전체보기</a></li>
			<li><a href="#" data-id="2">상담사례</a></li>
			<li><a href="#" data-id="3">판례</a></li>
		</ul>
	</div>
	<div class="srch-resultwrap">
		<div class="srch-result-sub history">
			<h4 class="result-sub-ttl">상담사례</h4>
		<?php
		if($listCnt > 0){
			foreach ( $list as $key=>$value){

		?>
			<div class="srch-result-box">
				<h5 class="result-box-ttl"><?=$value['question']?></h5>
				<div class="answer-box">
					<p class="answer"><span>답변</span><?=$value['answer']?></p>
					<div class="bar-box">
						<div class="bar" style="width:<?=$value['percent']?>%">
							<div class="bar-p">
								<p><span><?=$value['percent']?></span>%</p>
							</div>
						</div>
					</div>
				</div>
				<p class="answer-more-p"><a href="#" class="answer-more down">상세답변 보기 &gt;</a></p>
				<p class="answer-more-p2"><button type="button">닫기</button></p>
			</div>

		<?php
			}
		}else{
			?>
			<div class="no-result">
				<p>검색 결과가 없습니다.</p>
			</div>
			<?php
		}
		if($listCnt > $lastCnt){
			?>
			<button class="tab-more" type="button" onclick="$(this).addClass('hidden');$('#listMore').removeClass('hidden')">더보기 &gt;</button>
			<div id="listMore" class="hidden">
		<?php
			foreach ( $listMore as $key=>$value){
		?>
				<div class="srch-result-box">
					<h5 class="result-box-ttl"><?=$value['question']?></h5>
					<div class="answer-box">
						<p class="answer"><span>답변</span><?=$value['answer']?></p>
						<div class="bar-box">
							<div class="bar" style="width:<?=$value['percent']?>%">
								<div class="bar-p">
									<p><span><?=$value['percent']?></span>%</p>
								</div>
							</div>
						</div>
					</div>
					<p class="answer-more-p"><a href="#" class="answer-more down">상세답변 보기 &gt;</a></p>
					<p class="answer-more-p2"><button type="button">닫기</button></p>
				</div>
		<?php
			}
		?>
			</div>
		<?php
		}
		?>
		</div>
		<div class="srch-result-sub panrye">
			<h4 class="result-sub-ttl">판례</h4>
		<?php
			if($panryeListCnt > 0){
				foreach ( $listPanrye as $key=>$value){

					?>
					<div class="srch-result-box">
						<h5 class="precedent-num"><?=$value['panrye']?></h5>
						<!--<h4 class="precedent-ttl">전세금 반환 청구사건</h4>-->
						<p class="answer-more-p"><a href="#" class="answer-more">자세히 보기 &gt;</a></p>
					</div>
		<?php
				}
			}else{
		?>
				<div class="no-result">
					<p>검색 결과가 없습니다.</p>
				</div>
		<?php
			}
			if($panryeListCnt > $panryeLastCnt){
		?>
				<button class="tab-more" type="button" onclick="$(this).addClass('hidden');$('#listPanryeMore').removeClass('hidden')">더보기 &gt;</button>
				<div id="listPanryeMore" class="hidden">
		<?php
				foreach ( $listPanryeMore as $key=>$value){
		?>
				<div class="srch-result-box">
					<h5 class="precedent-num"><?=$value['panrye']?></h5>
					<!--<h4 class="precedent-ttl">전세금 반환 청구사건</h4>-->
					<p class="answer-more-p"><a href="#" class="answer-more">자세히 보기 &gt;</a></p>
				</div>
		<?php
				}
		echo '</div>';
			}
		?>


		</div>
	</div>
		</div>
<div class="popup">
	<div class="popup-background"></div>
	<div class="popup-main clearfix">
		<div class="popup-body">
			<p>새로운 검색을 하시겠어요?</p>
		</div>
		<div class="popup-buttonwrap clearfix">
			<button type="button" class="btn-popup gray" onclick="location.href='<?=site_url('search')?>'">예</button>
			<button type="button" class="btn-popup blue" onclick="popupclose();">아니오</button>
		</div>
	</div>
</div>
<form id="defaultForm">
	<input name="keyword" type="hidden" value="<?=$this->input->post('keyword')?>">
	<input name="filename" type="hidden" value="<?=$this->input->post('filename')?>">
</form>
<script>
	//bar percent value
	$(document).ready(function(){
		$(".bar-p span").each(function(){
			var percent = $(this).text()
			var pcValue = $(this).parents(".bar");
			pcValue.css("width", percent + '%');
		})
		$(".answer-more.down").on("click", function(e){
			e.preventDefault();
			$(this).parents(".srch-result-box").addClass("more");
		});
		$(".answer-more-p2 button").on("click", function(){
			$(this).parents(".srch-result-box").removeClass("more");
		});
		// 버튼
		$(".main-wrap").on("focusin", function(){
			$(".srch-catewrap").addClass('active');
		}).on("focusout", function(){
			$(".srch-catewrap").removeClass('active');
		});
		$(".cate-li").on("click", function(){
			$(this).toggleClass("on")
		});
		$('.srch-tabUl li a').on('click',function (e){
			e.preventDefault();
			$('.srch-tabUl li').removeClass('on')
			$(this).parents().addClass('on')
			$('.history').removeClass('hidden')
			$('.panrye').removeClass('hidden')
			if($(this).attr('data-id')==1){
				$('.history').removeClass('hidden')
				$('.panrye').removeClass('hidden')
			}
			if($(this).attr('data-id')==2){
				$('.panrye').addClass('hidden')
			}
			if($(this).attr('data-id')==3){
				$('.history').addClass('hidden')
			}
		});
	});


</script>
