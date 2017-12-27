<?php
class ControllerPaymentPayu extends Controller {

	public function index() {	
    	$data['button_confirm'] = $this->language->get('button_confirm');
		$this->load->model('checkout/order');
		$this->language->load('payment/payu');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$data['merchant'] = $this->config->get('payu_merchant');

		$currency_code = $order_info['currency_code']; 
		$calculatedAmount_INR = $order_info['total']; 
		
		 /////////////////////////////////////Start Payu Vital  Information /////////////////////////////////
		
		if($this->config->get('payu_test')=='demo')
			$data['action'] = 'https://test.payu.in/_payment.php';
		else
		    $data['action'] = 'https://secure.payu.in/_payment.php';
			
		$txnid        = 	$this->session->data['order_id'];
		                
		$data['key'] = $this->config->get('payu_merchant');
		$data['salt'] = $this->config->get('payu_salt');
		$data['txnid'] = $txnid;
		$data['amount'] = $calculatedAmount_INR;		
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

        $data['surl'] = $this->url->link('payment/payu/callback');
		$data['Furl'] = $this->url->link('payment/payu/callback');
		$data['curl'] = $this->url->link('payment/payu/callback');

		// For https SSL, please update below value for the response.
		//$this->url->link('payment/payu/callback', '', 'SSL')
		
		$key          = $this->config->get('payu_merchant');
		$amount       = $order_info['total'];
		$productInfo  = $data['productinfo'];
	    $firstname    = $order_info['payment_firstname'];
		$email        = $order_info['email'];
		$salt         = $this->config->get('payu_salt');
		
		$hash_string = $key.'|'.$txnid.'|'.$calculatedAmount_INR.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;		
		$Hash = strtolower(hash('sha512', $hash_string));
		
		$data['user_credentials'] = $this->data['key'].':'.$this->data['email'];
		$data['Hash'] = $Hash;
			/////////////////////////////////////End Payu Vital  Information /////////////////////////////////
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/payu.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/payu.tpl', $data);
		}		
	}
	
	public function callback() {
		
		if (isset($this->request->post['key']) && ($this->request->post['key'] == $this->config->get('payu_merchant'))) {
			$this->language->load('payment/payu');
			
			$data['title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));

			if (!isset($this->request->server['HTTPS']) || ($this->request->server['HTTPS'] != 'on')) {
				$data['base'] = HTTP_SERVER;
			} else {
				$data['base'] = HTTPS_SERVER;
			}
			$data['custom_field'] = 'hhhh';
			$data['charset'] = $this->language->get('charset');
			$data['language'] = $this->language->get('code');
			$data['direction'] = $this->language->get('direction');
			$data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
			$data['text_response'] = $this->language->get('text_response');
			$data['text_success'] = $this->language->get('text_success');
			$data['text_success_wait'] = sprintf($this->language->get('text_success_wait'), $this->url->link('checkout/success'));
			$data['text_failure'] = $this->language->get('text_failure');
			$data['text_cancelled'] = $this->language->get('text_cancelled');
			$data['text_cancelled_wait'] = sprintf($this->language->get('text_cancelled_wait'), $this->url->link('checkout/cart'));
			$data['text_pending'] = $this->language->get('text_pending');
			$data['text_failure_wait'] = sprintf($this->language->get('text_failure_wait'), $this->url->link('checkout/cart'));
			
			 $this->load->model('checkout/order');

			 $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
			 $orderid=$order_info['order_id'];
			 $calculatedAmount_INR = $order_info['total'];
			 
				$key          		=  	$this->request->post['key'];
				$amount      		= 	number_format((float)$calculatedAmount_INR, 2,'.','');
				$productInfo  		= 	$this->request->post['productinfo'];
				$firstname    		= 	$this->request->post['firstname'];
				$email        		=	$this->request->post['email'];
				$salt        		= 	$this->config->get('payu_salt');
				$txnid		 		=   $orderid ; 
				$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'||||||||||';
				$keyArray 	  		= 	explode("|",$keyString);
				$reverseKeyArray 	= 	array_reverse($keyArray);
				$reverseKeyString	=	implode("|",$reverseKeyArray);	
			 
			 if ((isset($this->request->post['status']) && $this->request->post['status'] == 'success') && ($txnid == $this->request->post['txnid'])) {
			 	
				if(!empty($this->request->post['additionalCharges'])){
					$additionalCharges 	= 	$this->request->post['additionalCharges'];
					$saltString     = $additionalCharges.'|'.$salt.'|'.$this->request->post['status'].'|'.$reverseKeyString;
				} else{
					$saltString     = $salt.'|'.$this->request->post['status'].'|'.$reverseKeyString;
				}
				
				$sentHashString = strtolower(hash('sha512', $saltString));
			 	$responseHashString=$this->request->post['hash'];
				
				$order_id = $this->request->post['txnid'];
				$message = '';
				$message .= 'orderId: ' . $this->request->post['txnid'] . "\n";
				$message .= 'Transaction Id: ' . $this->request->post['mihpayid'] . "\n";
				foreach($this->request->post as $k => $val){
					$message .= $k.': ' . $val . "\n";
				}
				if($sentHashString==$this->request->post['hash'] && ($amount == $this->request->post['amount'])){

					if($this->request->post['unmappedstatus'] == 'captured')
					{
						$payu_captured_order_status_id = $this->config->get('payu_captured_order_status_id');
						$this->model_checkout_order->addOrderHistory($orderid, $payu_captured_order_status_id);
					} elseif ($this->request->post['unmappedstatus'] == 'auth')
					{
						$payu_auth_order_status_id = $this->config->get('payu_auth_order_status_id');
						$this->model_checkout_order->addOrderHistory($orderid, $payu_auth_order_status_id);
					}
						$this->model_checkout_order->addOrderHistory($this->request->post['txnid'], $this->config->get('payu_captured_order_status_id'), $message, false);
						$data['continue'] = $this->url->link('checkout/success');
						$data['column_left'] = $this->load->controller('common/column_left');
						$data['column_right'] = $this->load->controller('common/column_right');
						$data['content_top'] = $this->load->controller('common/content_top');
						$data['content_bottom'] = $this->load->controller('common/content_bottom');
						$data['footer'] = $this->load->controller('common/footer');
						$data['header'] = $this->load->controller('common/header');
						if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu_success.tpl')) {
							$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/payment/payu_success.tpl', $data));
						} else {
							$this->response->setOutput($this->load->view('default/template/payment/payu_success.tpl', $data));
						}	
					}else{
						echo "Transaction has been tampered. Please try again";
						exit();
					}
			 }else {
    			$data['continue'] = $this->url->link('checkout/cart');
				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');

		        if(isset($this->request->post['status']) && $this->request->post['unmappedstatus'] == 'userCancelled')
				{
					$payu_user_cancelled_order_status_id = $this->config->get('payu_user_cancelled_order_status_id');
							$this->model_checkout_order->addOrderHistory($orderid, $payu_user_cancelled_order_status_id);

				 if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu_cancelled.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/payment/payu_cancelled.tpl', $data));
				} else {
					
					 $payu_cancelled_order_status_id = $this->config->get('payu_cancelled_order_status_id');
					$this->model_checkout_order->addOrderHistory($orderid, $payu_cancelled_order_status_id);

				    $this->response->setOutput($this->load->view('default/template/payment/payu_cancelled.tpl', $data));
				}
				}
				else {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu_failure.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/payment/payu_failure.tpl', $data));
				} else {
					
					$this->response->setOutput($this->load->view('default/template/payment/payu_failure.tpl', $data));
				}	
				
				}					
			}
		}

			if($this->request->post['unmappedstatus'] == 'initiated')
						{
							
							$payu_initiated_order_status_id = $this->config->get('payu_initiated_order_status_id');
							$this->model_checkout_order->addOrderHistory($orderid, $payu_initiated_order_status_id);

						} elseif ($this->request->post['unmappedstatus'] == 'in progress')
						{
							$payu_inprogress_order_status_id = $this->config->get('payu_inprogress_order_status_id');
							$this->model_checkout_order->addOrderHistory($orderid, $payu_inprogress_order_status_id);
						} elseif ($this->request->post['unmappedstatus'] == 'dropped')
						{
							$payu_dropped_order_status_id = $this->config->get('payu_dropped_order_status_id');
							$this->model_checkout_order->addOrderHistory($orderid, $payu_dropped_order_status_id);
						} elseif ($this->request->post['unmappedstatus'] == 'bounced')
						{
							$payu_bounced_order_status_id = $this->config->get('payu_bounced_order_status_id');
							$this->model_checkout_order->addOrderHistory($orderid, $payu_bounced_order_status_id);
						} elseif ($this->request->post['unmappedstatus'] == 'failed')
						{
							$payu_failed_order_status_id = $this->config->get('payu_failed_order_status_id');
							$this->model_checkout_order->addOrderHistory($orderid, $payu_failed_order_status_id);
						} elseif ($this->request->post['unmappedstatus'] == 'pending')
						{
							$payu_pending_order_status_id = $this->config->get('payu_pending_order_status_id');
							$this->model_checkout_order->addOrderHistory($orderid, $payu_pending_order_status_id);
						} 

						$sql2 = "UPDATE " . DB_PREFIX . "order SET custom_field = 'mihpayid :-" .$this->request->post['mihpayid'] ."' WHERE order_id= '" .$orderid . "'";
						 $query2 = $this->db->query($sql2);
							
	}
}
?>
