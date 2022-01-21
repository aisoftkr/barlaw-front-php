<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="chat-con">
	<div class="cont-t clearfix">
		<div class="question"></div>
		<div class="chat-left clearfix">
			<div class="chat-i"></div>
			<div class="chat chat-f">
				<div class="ch-time">
					<span class="chat-id">바로</span>,
					<span class="chat-time" id="time-ch"></span>
				</div>
				<div class="t-load1">안녕하세요. 저는 인공지능 바로예요!</div>
				<!--<div>저와 소통하는 방법이 궁금하시다면 우측 상단의 물음표 버튼 을 눌러주세요</div>
				<div>아래의 법률 분야 중 상담 받고 싶은 분야를 선택하신 후, 양식에 구애 받지 않고 자유롭게 상담 내용을 입력해주세요!</div>
				<div>예를 들어볼까요?
					“회사 일이 바쁘다고 육아휴직을 당장 쓰지 못하게
					하는 사장님, 위법인가요?” 라는 질문을 해보겠습니다!”</div> -->
			</div>
		</div>
	</div>

	<div class="input-box clearfix">
		<div class="q-box" id="q-box">
			<ul>
				<li>성범죄</li>
				<li>임대차</li>
				<li>계약일반</li>
				<li>손해배상</li>
				<li>노동/인사</li>
				<li>지식재산권</li>
				<li>회생파산</li>
				<li>IT/테크</li>
				<li>기업일반</li>
				<li>금융</li>
				<li>행정</li>
				<li>등기/등록</li>
				<li>기타</li>
			</ul>
		</div>
		<div class="q-con">
			<?php
			$attributes = array('class' => '', 'name' => 'defaultForm', 'id' => 'defaultForm');
			echo form_open(site_url(), $attributes);
			?>
				<input type="hidden" name="tag1" class="tag" value="">
				<input type="hidden" name="tag2" class="tag" value="">
				<input type="hidden" name="tag3" class="tag" value="">

				<textarea name="question" id="" cols="30" rows="1" placeholder="상담 내용을 입력해주세요." data-autoresize></textarea>
				<button id="q-btn" class="q-btn" type="button" ></button>
			<?php echo form_close(); ?>
		</div>
	</div>
	<?php
	$attributes = array('class' => '', 'name' => 'goSearchAll', 'id' => 'goSearchAll');
	echo form_open(site_url('/search/result'), $attributes);
	?>
		<input type="hidden" name="keyword">
		<input type="hidden" name="filename">
	<?php echo form_close(); ?>
</div>

<script>


	const  now = new Date();
	// var year = now.getFullYear();
	// var month = now.getMonth() + 1;    //1월이 0으로 되기때문에 +1을 함.
	// var date = now.getDate();
	// var getDate = now.getDate(); // 일
	const  getHours = now.getHours(); // 시
	const  getMinutes = now.getMinutes(); // 분
	// var getSeconds = now.getSeconds(); // 초
	const  defaultHtmlHeader = ''+
		'<div class="chat-left clearfix">'+
		'   <div class="chat-i"></div>'+
		'   <div class="chat">'+
		'     <div class="ch-time">'+
		'       <span class="chat-id">바로</span>,'+
		'       <span class="chat-time">'+getHours +':'+ getMinutes +'</span>'+
		'     </div>';
	const  defaultHtmlFooter = ''+
		'   </div>'+
		'</div>';
	$(document)
		.ajaxStart(function () {
			// $('.chat-right').html();

			const  htmlChatRight = '' +
				'<div class="chat-right question-on on">' +
				'  <div>“' +
				'    <span>' +  $('textarea[name=question]').val() +
				'    </span>”' +
				'  </div>' +
				'  <div class="ch-time">' +
				'    <span class="chat-id">보냄</span>,' +
				'    <span class="chat-time"> '+getHours +':'+ getMinutes +'</span>' +
				'    </div>' +
				'</div>';
			$('.input-box').prev().append(htmlChatRight);

			const  lodingHtml = ''+
				'<div class="chat-left clearfix">'+
				defaultHtmlHeader+
				'     <div class="loading-box">' +
				'       “<span>'+$('textarea[name=question]').val()+'</span> ”</br>'+
				'       <span>인공지능이 답변을 작성하고 있습니다</span>'+
				'       <div class="loading">'+
				'         <div class="one scale-blue1"></div>'+
				'         <div class="one scale-blue2"></div>'+
				'         <div class="one scale-blue3"></div>'+
				'       </div>'+
				'     </div>'
				+defaultHtmlFooter;

			$('.input-box').prev().append(lodingHtml);
			setTimeout(function() {
				$(".loading-box").after('<div class="loading-txt1">인공지능 LAWBERT가 열심히 답변을 작성하고 있습니다.</div>');
			  setTimeout(function() {
			    $(".loading-txt1").after('<div class="loading-txt2">조금만 더 기다려 주세요!</div>');
			    setTimeout(function() {
			      $(".loading-txt2").after('<div class="loading-txt3">LAWBERT는 한국AI소프트가 자체 개발한 알고리즘입니다.</div>');
			      setTimeout(function() {
			        $(".loading-txt3").after('<div class="loading-txt4">무려 120만건의 판례, 법률 데이터를 기억하고 있어요!</div>');
			        setTimeout(function() {
			          $(".loading-txt4").after('<div class="loading-txt5">이제 거의 다 됐습니다!</div>');
			        }, 3000);
			      }, 3000);
			    }, 3000);
			  }, 3000);
			}, 5000);
		})
		.ajaxStop(function () {
			$('.loading-box').parents('.chat-left').hide();
		});
	// $(function resize(obj){
	// 	obj.style.height = "1px";
	// 	obj.style.height = (obj.scrollHeight)-5+"px";
	// });
	$.each($('textarea[data-autoresize]'), function() {
		let offset = this.offsetHeight - this.clientHeight;
		let resizeTextarea = function(re) {
		$(re).css('height', 'auto').css('height', re.scrollHeight + offset);};
		$(this).on('keyup input', function() {
			resizeTextarea(this); }).removeAttr('data-autoresize');
	});
	// $(".q-con textarea").on('keydown keyup', function () {
	// 	$(this).height(0).height( $(this).prop('scrollHeight')-37+"px" );
	// });
	$('.q-con .q-btn').on('click',function(){
		var txt_co = $('.q-con textarea')
		var lion = $('.q-box ul li.on').length;
		var check = true;
		if(lion < 1) {
			$('.input-box').prev().append('' +
				defaultHtmlHeader +
				'<div class="text-e2">' +
				'상담 분야는 최소 1개 이상 선택해주세요.' +
				'</div>'+
				defaultHtmlFooter
			)
			check = false
		}
		if(txt_co.val().length < 10) {
			$('.input-box').prev().append('' +
				defaultHtmlHeader +
				'<div class="text-e3">' +
				'정확한 상담 결과를 위해 상담 내용은<br>최소 10자 이상 작성해주세요.' +
				'</div>'+
				defaultHtmlFooter
			)
			check = false
		}

		if(check){

			$.ajax({
				url: '/api/run',
				data: $('#defaultForm').serialize(),
				method: "POST",
				async:true,
				success: function (data) {

					// $.each(data,function (key,val){
					//   console.log(key,val)
					// })
				// }
			// });

					if(data.status){
						var html ='' +
						    defaultHtmlHeader+
						    '<div class="clearfix">“'+data.requestQuestion+'”<br>에 대한 수치 답변입니다.';

						if(data.percent != 'nan' && data.percent >= 0){
							html +='' +
							'<div class="bar-box clearfix">' +
							'	<div class="bar" id="bar-1">'+
							'		<div class="bar-p">' +
							'			<p><span>'+data.percent+'</span>%</p>' +
							'		</div>'+
							'	</div>' +
							'</div>';
						}
						html +='' +
						    '</div>' +
						    '<div class="a-chat">' +
						    '상담 내용에 대해서 더 자세히 알고 싶나요? Barlaw는<br>' +
						    '질문하신 상담 내용과 유사한 사례 및 판례를 제공해드립니다.<br>' +
						    '아래 결과를 확인해보세요.';
						if(data.panrye){
						  html +='' +
						      '<div><span class="bold">관련 판례</span>'+data.panrye+'</div>';
						}
						html +='' +
						    '<div class="a-cont"><span class="bold">관련 사례</span><p class="p-con">“<span class="span-con">'+data.answer+'</span>”</p></div>';
						// if(data.panrye){
						html +='<a href="#" class="bold mb20" onclick="$(\'#goSearchAll\').submit()">관련 판례ᆞ사례 자세히 보기 ></a>';
						$('input[name=keyword]').val(data.requestQuestion);
						$('input[name=filename]').val(data.resultFile);
						html +='' +
						    '</div>' + defaultHtmlFooter;
						$('.input-box').prev().append(html);
						$(".bar-p span").each(function(){
						  var percent = $(this).text()
						  var pcValue = $(this).parents(".bar");
						  pcValue.css("width", percent + '%');
						})
					}else{
						if(data.code===0){
							$('.input-box').prev().append(defaultHtmlHeader+'<div class="text-e3">관련 판례ᆞ사례가 없습니다.</div>'+ defaultHtmlFooter)
						}else{
// 							$('.input-box').prev().append(defaultHtmlHeader+'<div class="text-e3">요청한 데이터에 문제가 있습니다.</div>'+ defaultHtmlFooter)
							setTimeout(function() {
								$('.input-box').prev().append(defaultHtmlHeader+'<div class="non-txt1">이런, 질문에 맞는 답변을 드리지 못하겠어요. 그렇지만 저는 지속적으로 업데이트 되고 있으니 다음에는 꼭 답변을 드릴게요!</div>'+ defaultHtmlFooter)
									setTimeout(function() {
									$(".non-txt1").after('<div class="non-txt2">정확한 검색 결과를 위한 팁을 드리자면, 질문은 가급적 하나만, 핵심을 요약하여 간결하게 적어주세요!</div>');
								}, 1000);
							}, 0);
						}
					}

				},

			});
			// axios.post('/api/run').then(res => { console.log(res.data) })
		}
		$('textarea[name=question]').css('min-height', 'auto').val('');
	});
	$('.q-con textarea').on('keyup', function() {
		var lion = $('.q-box ul li.on').length;
		if($(this).val().length > 100 && lion >= 1 && lion <= 3) {
			$(this).val($(this).val().substring(0, 100));
			$('.input-box').prev().append('' +
				defaultHtmlHeader +
				'<div class="text-e4">' +
				'상담 내용은 최대 100자까지 작성 가능합니다! 내용이 길어지는 경우 상담 내용의 핵심 부분을 요약하여 작성해보세요.' +
				'</div>'+
				defaultHtmlFooter
			)
		}
		if($(this).val() != ''){
			$(".q-con .q-btn").addClass("on");
			$(".q-con .q-btn").prop('disabled', false);
		}
		else {
			$(".q-con .q-btn").removeClass("on");
			$(".q-con .q-btn").prop("disabled", true);
		}
	});
	$('.q-box ul li').click(function(){
		$(this).toggleClass('on');
		if($('.q-box ul li.on').length >= 4){
			// $('.text-e1').addClass('on');
			$('.input-box').prev().append('' +
				defaultHtmlHeader +
				'<div class="text-e1">' +
				'정확한 상담 결과를 위해 상담 분야는<br>최대 3개까지 선택하실 수 있습니다.' +
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
	$('.question').click(function(){
		$('.question-on').addClass('on');
		$(this).addClass('off');
	});
	//bar percent value
	$(document).ready(function(){
		$(".bar-p span").each(function(){
			var percent = $(this).text()
			var pcValue = $(this).parents(".bar");
			pcValue.css("width", percent + '%');
		})
	});

	$("#time-ch").text(getHours + ':' + getMinutes);
    	setTimeout(function() {
    		$(".t-load1").after('<div class="t-load2">저와 소통하는 방법이 궁금하시다면 우측 상단의 물음표 버튼을 눌러주세요</div>');
    	}, 1000);
	$('.question').click(function(){
		$(this).addClass('off');
		setTimeout(function() {
			$(".t-load2").after('<div class="t-load3">아래의 법률 분야 중 상담 받고 싶은 분야를 선택하신 후, 양식에 구애 받지 않고 자유롭게 상담 내용을 입력해주세요!</div>');
			setTimeout(function() {
				$(".t-load3").after('<div class="t-load4">예를 들어볼까요? “회사 일이 바쁘다고 육아휴직을 당장 쓰지 못하게 하는 사장님, 위법인가요?” 라는 질문을 해보겠습니다!”</div>');
					setTimeout(function() {
					$(".t-load4").parent().parent(".chat-left").after('<div class="chat-right question-on on qt-on"><div>“회사 일이 바쁘다고 육아휴직을 당장 쓰지 못하게 하는 사장님, 위법인가요?”</div><div class="ch-time"><span class="chat-id">보냄</span>,<span class="chat-time">'+getHours + ':' + getMinutes+'</span></div></div>');
						setTimeout(function(){
						$(".qt-on").after('<div class="chat-left clearfix"><div class="chat-i"></div><div class="chat"><div class="ch-time"><span class="chat-id">바로</span>,<span class="chat-time">'+getHours + ':' + getMinutes+'</span></div><div class="qt-t1 clearfix">“회사 일이 바쁘다고 육아휴직을 당장 쓰지 못하게...”<br>에 대한 수치 답변입니다.<div class="bar-box  clearfix"><div class="bar" id="bar-1"><div class="bar-p"><p><span>100</span>%</p></div></div></div></div>')
						setTimeout(function(){
							$(".qt-t1").after('<div class="a-chat qt-t2">상담 내용에 대해서 더 자세히 알고 싶나요? Barlaw는 질문하신 상담 내용과 유사한 사례 및 판례를 제공해드립니다. 아래 결과를 확인해보세요.<div><span class="bold">관련 판례</span> 2018두47264</div><div class="a-cont"><span class="bold">관련 사례</span><p class="p-con"> “<span class="span-con"> 육아휴직을 회사가 거부하여 육아휴직을 회사가 거부하여</span>”</p></div><a class="bold mb20">관련 판례ᆞ사례 자세히 보기 ></a></div>')
							setTimeout(function(){
								$(".qt-t2").after('<div>잘 보셨죠? 정확한 상담 결과를 위한 팁을 드리자면, 질문은 가급적 하나만, 핵심을요약하여 간결하게 적어주세요!</div>')
							}, 1000);
						}, 1000);
					}, 1000);
				}, 1000);
			}, 1000);
		}, 0);
	});
	$('.q-con textarea').keypress(function(event){
		if ( event.which == 13 ) {
			$('.q-con .q-btn').click();
			return false;
		}
	});
</script>
