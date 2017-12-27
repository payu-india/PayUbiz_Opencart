<?php
class ControllerPaymentPayu extends Controller {
	protected function index() {
    	$this->data['button_confirm'] = $this->language->get('button_confirm');

		$this->load->model('checkout/order');
		$this->language->load('payment/payu');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$this->data['merchant'] = $this->config->get('payu_merchant');
		
		 /////////////////////////////////////Start Payu Vital  Information /////////////////////////////////
		
		if($this->config->get('payu_test')=='demo')
			$this->data['action'] = 'https://test.payu.in/_payment.php';
		else
		    $this->data['action'] = 'https://secure.payu.in/_payment.php';
			
		$txnid = $this->session->data['order_id'];
                
		$this->data['key'] = $this->config->get('payu_merchant');
		$this->data['salt'] = $this->config->get('payu_salt');
		$this->data['txnid'] = $txnid;
		$this->data['amount'] = $order_info['total'];
		$this->data['productinfo'] = 'opencart products information';
		$this->data['firstname'] = $order_info['payment_firstname'];
		$this->data['Lastname'] = $order_info['payment_lastname'];
		$this->data['Zipcode'] = $order_info['payment_postcode'];
		$this->data['email'] = $order_info['email'];
		$this->data['phone'] = $order_info['telephone'];
		$this->data['address1'] = $order_info['payment_address_1'];
        $this->data['address2'] = $order_info['payment_address_2'];
        $this->data['state'] = $order_info['payment_zone'];
        $this->data['city']=$order_info['payment_city'];
        $this->data['country']=$order_info['payment_country'];
		
		$this->data['surl'] = $this->url->link('payment/payu/callback');
		$this->data['Furl'] = $this->url->link('payment/payu/callback');
		$this->data['curl'] = $this->url->link('payment/payu/callback');
		
		// For https SSL, please update below value for the response.
		//$this->url->link('payment/payu/callback', '', 'SSL')
		
		
		$key          =  $this->config->get('payu_merchant');
		$amount       = $order_info['total'];
		$productInfo  = $this->data['productinfo'];
		$firstname    = $order_info['payment_firstname'];
		$email        = $order_info['email'];
		$salt         = $this->config->get('payu_salt');
		
		$hash_string = $key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
		$Hash=strtolower(hash('sha512', $hash_string));
		
		$this->data['user_credentials'] = $this->data['key'].':'.$this->data['email'];
		$this->data['Hash'] = $Hash;
		
			/////////////////////////////////////End Payu Vital  Information /////////////////////////////////
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/payu.tpl';
		} else {
			$this->template = 'default/template/payment/payu.tpl';
		}

		$this->render();
	}
	
	public function callback() {
		if (isset($this->request->post['key']) && ($this->request->post['key'] == $this->config->get('payu_merchant'))) {
			$this->language->load('payment/payu');
			
			$this->data['title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));

			if (!isset($this->request->server['HTTPS']) || ($this->request->server['HTTPS'] != 'on')) {
				$this->data['base'] = HTTP_SERVER;
			} else {
				$this->data['base'] = HTTPS_SERVER;
			}
		
			$this->data['charset'] = $this->language->get('charset');
			$this->data['language'] = $this->language->get('code');
			$this->data['direction'] = $this->language->get('direction');
			$this->data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
			$this->data['text_response'] = $this->language->get('text_response');
			$this->data['text_success'] = $this->language->get('text_success');
			$this->data['text_success_wait'] = sprintf($this->language->get('text_success_wait'), $this->url->link('checkout/success'));
			$this->data['text_failure'] = $this->language->get('text_failure');
			$this->data['text_cancelled'] = $this->language->get('text_cancelled');
			$this->data['text_cancelled_wait'] = sprintf($this->language->get('text_cancelled_wait'), $this->url->link('checkout/cart'));
			$this->data['text_pending'] = $this->language->get('text_pending');
			$this->data['text_failure_wait'] = sprintf($this->language->get('text_failure_wait'), $this->url->link('checkout/cart'));
			
			 $this->load->model('checkout/order');
			 
			 $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
			 $orderid=$order_info['order_id'];
			 $calculatedAmount_INR = $order_info['total'];

			 //$order_info = $this->model_checkout_order->getOrder($orderid);
			 
				$key          		=  	$this->request->post['key'];
				$amount      		= 	number_format((float)$calculatedAmount_INR, 2,'.','');
				$productInfo  		= 	$this->request->post['productinfo'];
				$firstname    		= 	$this->request->post['firstname'];
				$email        		=	$this->request->post['email'];
				$salt        		= 	$this->config->get('payu_salt');
				$txnid		 		=   $orderid;
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
				$this->model_checkout_order->confirm($this->request->post['txnid'], $this->config->get('payu_order_status_id'));
				$this->model_checkout_order->update($this->request->post['txnid'], $this->config->get('payu_order_status_id'), $message,false);
				$this->data['continue'] = $this->url->link('checkout/success');
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu_success.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/payment/payu_success.tpl';
				} else {
					$this->template = 'default/template/payment/payu_success.tpl';
				}
				
				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
					
				$this->response->setOutput($this->render());
			  } else {
				//Transaction will be pending
				$this->model_checkout_order->confirm($this->request->post['txnid'],1);
				$this->model_checkout_order->update($this->session->data['order_id'], 1, $message, false);
				$this->data['continue'] = $this->url->link('checkout/checkout', '', 'SSL');
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu_pending.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/payment/payu_pending.tpl';
				} else {
					$this->template = 'default/template/payment/payu_pending.tpl';
				}	
				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
				$this->response->setOutput($this->render());		
			  } 
			 }else {
    			$this->data['continue'] = $this->url->link('checkout/cart');
		
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payu_failure.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/payment/payu_failure.tpl';
				} else {
					$this->template = 'default/template/payment/payu_failure.tpl';
				}	
				
				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
				$this->response->setOutput($this->render());						
			}
		}
	}
}
?>