<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //모델로드
//        $this->load->model('admin_plan');
//        $this->load->model('admin_member');
//        $this->load->model('common');
        //CSRF 방지
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('array');
    }

    public function index()
    {

		$this->load->view('layout/header');
		$this->load->view('search/index');
		$this->load->view('layout/footer');
//        redirect('product/estimate_form');
    }
	public function result()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://125.128.127.11:8080/api/searchall',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array('filename'=>$this->input->post('filename')),
//			CURLOPT_POSTFIELDS => array('filename'=>'202201281430007303.json'),
			//202201281430007303.json
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$JsonParser= json_decode($response,true);
		$no = 0;
		$lastCnt = 0;
		$list = array();
		$listMore = array();
		$data['pageListCnt']=3;

		if($JsonParser!=null){
			if(element('result_answer', $JsonParser)){
				foreach ( element('result_answer', $JsonParser) as $key=>$value){

						$no++;
						if($no <= $data['pageListCnt']) {
							$lastCnt++;
							$list[$key]['question'] = $value['question'];
							$list[$key]['content'] = $value['content'];
							$list[$key]['answer'] = $value['answer'];
							$list[$key]['panrye'] = $value['panrye'];
							$list[$key]['percent'] = $value['percent'];
						}else{
							$listMore[$key]['question'] = $value['question'];
							$listMore[$key]['content'] = $value['content'];
							$listMore[$key]['answer'] = $value['answer'];
							$listMore[$key]['panrye'] = $value['panrye'];
							$listMore[$key]['percent'] =isset($value['percent']) ? $value['percent'] : 0;
						}

				}
			}
		}


		$data['listCnt']=$no;
		$data['lastCnt']=$lastCnt;
		$data['list']=$list;
		$data['listMore']=$listMore;
		$no = 0;
		$lastCnt = 0;
		$listPanrye= array();
		$listPanryeMore=array();
		if($JsonParser != null) {
			if (element('result_answer', $JsonParser)) {
				foreach (element('result_answer', $JsonParser) as $key => $value) {
					if ((float)$value['panrye'] != 'nan') {
						$no++;
						if ($no <= $data['pageListCnt']) {
							$lastCnt++;
							$listPanrye[$key]['question'] = $value['question'];
							$listPanrye[$key]['content'] = $value['content'];
							$listPanrye[$key]['answer'] = $value['answer'];
							$listPanrye[$key]['panrye'] = $value['panrye'];
							$listPanrye[$key]['percent'] = $value['percent'];
						} else {
							$listPanryeMore[$key]['question'] = $value['question'];
							$listPanryeMore[$key]['content'] = $value['content'];
							$listPanryeMore[$key]['answer'] = $value['answer'];
							$listPanryeMore[$key]['panrye'] = $value['panrye'];
							$listPanryeMore[$key]['percent'] = $value['percent'];
						}
					}
				}
			}
		}
		$data['panryeListCnt']=$no;
		$data['panryeLastCnt']=$lastCnt;
		$data['panryeList']=$list;
		$data['listPanrye']=$listPanrye;
		$data['listPanryeMore']=$listPanryeMore;
//		if($JsonParser['data']){
//			foreach ($JsonParser['data'] as $key=>$value){
		$this->load->view('layout/header');
		$this->load->view('search/result',$data);
		$this->load->view('layout/footer');
//        redirect('product/estimate_form');
	}
	public function panrye()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://125.128.127.11:8080/api/panrye',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array('filename'=>$this->input->post('filename')),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$JsonParser= json_decode($response,true);


		$this->load->view('layout/header');
		$this->load->view('search/panrye',$JsonParser);
		$this->load->view('layout/footer');
//        redirect('product/estimate_form');
	}
}
