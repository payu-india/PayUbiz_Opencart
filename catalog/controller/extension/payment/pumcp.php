<?php
class ControllerExtensionPaymentPumcp extends Controller {
	
	public function index()
	{
		$this->load->model('checkout/order');	
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('config_order_status_id'), "Default order status before payment.", false);
		
		if($order_info['payment_method'] == 'PayUbiz') {
			$data=$this->process_payu();
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . 'extension/payment/pumcp_payu')) {
				return $this->load->view($this->config->get('config_template') . 'extension/payment/pumcp_payu', $data);	
			} else {
				return $this->load->view('extension/payment/pumcp_payu', $data);
			}		
		}
	}

	private function process_payu() {
    	$data['button_confirm'] = $this->language->get('button_confirm');
		$this->load->model('checkout/order');
		$this->language->load('extension/payment/pumcp');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$data['merchant'] = $this->config->get('payment_pumcp_payu_merchant');
		
		 /////////////////////////////////////Start Payu Vital  Information /////////////////////////////////
		
		if($this->config->get('payment_pumcp_module')=='Sandbox')
			$data['action'] = 'https://test.payu.in/_payment.php';
		else
		    $data['action'] = 'https://secure.payu.in/_payment.php';
			
		$txnid        = 	$this->session->data['order_id'];
		             
		$data['key'] = $this->config->get('payment_pumcp_payu_merchant');
		$data['salt'] = $this->config->get('payment_pumcp_payu_salt');
		$data['txnid'] = $txnid;
		$data['amount'] = (int)$order_info['total'];
		$data['productinfo'] = 'opencart products information';
		$data['firstname'] = $order_info['payment_firstname'];
		$data['Lastname'] = $order_info['payment_lastname'];
		$data['Zipcode'] = $order_info['payment_postcode'];
		$data['email'] = $order_info['email'];
		$data['phone'] = $order_info['telephone'];
		$data['address1'] = $order_info['payment_address_1'];
        $data['address2'] = $order_info['payment_address_2'];
        $data['state'] = $order_info['payment_zone'];
        $data['city']=$order_info['payment_city'];
        $data['country']=$order_info['payment_country'];
		$data['Pg'] = 'CC';
		$data['surl'] = $this->url->link('extension/payment/pumcp/callback_payu');
		$data['Furl'] = $this->url->link('extension/payment/pumcp/callback_payu');
		$data['curl'] = $this->url->link('extension/payment/pumcp/callback_payu');
		$key          =  $this->config->get('payment_pumcp_payu_merchant');
		$amount       = (int)$order_info['total'];
		$productInfo  = $data['productinfo'];
	    $firstname    = $order_info['payment_firstname'];
		$email        = $order_info['email'];
		$salt         = $this->config->get('payment_pumcp_payu_salt');
		$Hash=hash('sha512', $key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt); 
		$data['user_credentials'] = $this->data['key'].':'.$this->data['email'];
		$data['Hash'] = $Hash;
		
		/////////////////////////////////////End Payu Vital  Information /////////////////////////////////
		return $data;		
	}
	
	public function callback_payu() {
		if (isset($this->request->post['key']) && ($this->request->post['key'] == $this->config->get('payment_pumcp_payu_merchant'))) {
			$this->language->load('extension/payment/pumcp');
			
			$this->load->model('checkout/order');
			
			$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
			$orderid=$order_info['order_id'];
			$calculatedAmount_INR = $order_info['total'];
			
			$order_info = $this->model_checkout_order->getOrder($orderid);
			
			$data['title'] = sprintf($this->language->get('heading_title'), $order_info['payment_method']);

			if (!isset($this->request->server['HTTPS']) || ($this->request->server['HTTPS'] != 'on')) {
				$data['base'] = HTTP_SERVER;
			} else {
				$data['base'] = HTTPS_SERVER;
			}
			$data['charset'] = $this->language->get('charset');
			$data['language'] = $this->language->get('code');
			$data['direction'] = $this->language->get('direction');
			$data['heading_title'] = sprintf($this->language->get('heading_title'), $order_info['payment_method']);
			$data['text_response'] = $this->language->get('text_response');
			$data['text_success'] = $this->language->get('text_success');
			$data['text_success_wait'] = sprintf($this->language->get('text_success_wait'), $this->url->link('checkout/success'));
			$data['text_failure'] = $this->language->get('text_failure');
			$data['text_cancelled'] = $this->language->get('text_cancelled');
			$data['text_cancelled_wait'] = sprintf($this->language->get('text_cancelled_wait'), $this->url->link('checkout/cart'));
			$data['text_pending'] = $this->language->get('text_pending');
			$data['text_failure_wait'] = sprintf($this->language->get('text_failure_wait'), $this->url->link('checkout/cart'));
				$key          		=  	$this->request->post['key'];
				$amount      		= 	number_format((float)$calculatedAmount_INR, 2,'.','');
				$productInfo  		= 	$this->request->post['productinfo'];
				$firstname    		= 	$this->request->post['firstname'];
				$email        		=	$this->request->post['email'];
				$salt        		= 	$this->config->get('payment_pumcp_payu_salt');
				$txnid        		= 	$orderid;
				$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'||||||||||';
				$keyArray 	  		= 	explode("|",$keyString);
				$reverseKeyArray 	= 	array_reverse($keyArray);
				$reverseKeyString	=	implode("|",$reverseKeyArray);
			 
			 $order_id = $this->request->post['txnid'];
			 
			 if ((isset($this->request->post['status']) && $this->request->post['status'] == 'success') && ($txnid==$this->request->post['txnid'])) {
				 
				 if(!empty($this->request->post['additionalCharges'])){
					$additionalCharges 	= 	$this->request->post['additionalCharges'];
					$saltString     = $additionalCharges.'|'.$salt.'|'.$this->request->post['status'].'|'.$reverseKeyString;
				} else{
					$saltString     = $salt.'|'.$this->request->post['status'].'|'.$reverseKeyString;					
				}
				
				$sentHashString = strtolower(hash('sha512', $saltString));
			 	$responseHashString=$this->request->post['hash'];
				
				$message = '';
				$message .= 'orderId: ' . $this->request->post['txnid'] . "\n";
				$message .= 'Transaction Id: ' . $this->request->post['mihpayid'] . "\n";
				foreach($this->request->post as $k => $val){
					$message .= $k.': ' . $val . "\n";
				}
					if(($sentHashString==$this->request->post['hash']) && ($amount == $this->request->post['amount'])){
							$this->model_checkout_order->addOrderHistory($this->request->post['txnid'], $this->config->get('payment_pumcp_order_status_id'), $message, true);
							$data['continue'] = $this->url->link('checkout/success');
							$data['column_left'] = $this->load->controller('common/column_left');
				            $data['column_right'] = $this->load->controller('common/column_right');
				            $data['content_top'] = $this->load->controller('common/content_top');
				            $data['content_bottom'] = $this->load->controller('common/content_bottom');
				            $data['footer'] = $this->load->controller('common/footer');
				            $data['header'] = $this->load->controller('common/header');
						if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . 'extension/payment/pumcp_success')) 									   						{			
								$this->response->setOutput($this->load->view($this->config->get('config_template') . 'extension/payment/pumcp_success', $data));
							} else {
								$this->response->setOutput($this->load->view('extension/payment/pumcp_success', $data));
							}									
					}
			 }else {
				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');
				
		        if(isset($this->request->post['status']) && $this->request->post['unmappedstatus'] == 'userCancelled')
				{
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_pumcp_order_fail_status_id'),'Payment cacelled by customer...',true);	
					
				 	if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . 'extension/payment/pumcp_cancelled')) {
						$this->response->setOutput($this->load->view($this->config->get('config_template') . 'extension/payment/pumcp_cancelled', $data));
					} else {
				    	$this->response->setOutput($this->load->view('extension/payment/pumcp_cancelled', $data));
					}
				}
				else {
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_pumcp_order_fail_status_id'),'Payment failed...',true);	
					
					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . 'extension/payment/pumcp_failure')) {
						$this->response->setOutput($this->load->view($this->config->get('config_template') . 'extension/payment/pumcp_failure', $data));
					} else {
						$this->response->setOutput($this->load->view('extension/payment/pumcp_failure', $data));
					}
				}					
			}
		}
	}
	function generateHmacKey($data, $apiKey=null){
		$hmackey = hash_hmac('sha1',$data,$apiKey);
		return $hmackey;
	}	
}
?>