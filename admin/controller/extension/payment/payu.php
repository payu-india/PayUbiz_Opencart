<?php 

/**
 *
 *
 * Copyright (c) 2011-2016 PayU India
 * @author     Ayush Mittal
 * @copyright  2011-2016 PayU India
 * @license    http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @version    3.0
 */

class ControllerExtensionPaymentPayu extends Controller {
	private $error = array(); 

	public function index() {

		$this->load->language('extension/payment/payu');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payu', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_live'] = $this->language->get('text_live');
		$data['text_successful'] = $this->language->get('text_successful');
		$data['text_fail'] = $this->language->get('text_fail');
		$data['demo'] = $this->language->get('demo');		
		$data['entry_merchantid1'] = $this->language->get('entry_merchantid1');
		$data['entry_salt1'] = $this->language->get('entry_salt1');
		$data['entry_test'] = $this->language->get('entry_test');
		$data['entry_total'] = $this->language->get('entry_total');	
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['help_password'] = $this->language->get('help_password');
		$data['help_total'] = $this->language->get('help_total');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
        $data['help_salt1'] = $this->language->get('help_salt1');

        $data['help_currency1'] = $this->language->get('help_currency1');
        $data['entry_currency1'] = $this->language->get('entry_currency1');

        $data['help_salt2'] = $this->language->get('help_salt2');
        $data['entry_salt2'] = $this->language->get('entry_salt2');
        $data['help_merchantid2'] = $this->language->get('help_merchantid2');
        $data['entry_merchantid2'] = $this->language->get('entry_merchantid2');
        $data['help_currency2'] = $this->language->get('help_currency2');
        $data['entry_currency2'] = $this->language->get('entry_currency2');

        $data['help_salt3'] = $this->language->get('help_salt3');
        $data['entry_salt3'] = $this->language->get('entry_salt3');
        $data['help_merchantid3'] = $this->language->get('help_merchantid3');
        $data['entry_merchantid3'] = $this->language->get('entry_merchantid3');
        $data['help_currency3'] = $this->language->get('help_currency3');
        $data['entry_currency3'] = $this->language->get('entry_currency3');

        $data['help_salt4'] = $this->language->get('help_salt4');
        $data['entry_salt4'] = $this->language->get('entry_salt4');
        $data['help_merchantid4'] = $this->language->get('help_merchantid4');
        $data['entry_merchantid4'] = $this->language->get('entry_merchantid4');
        $data['help_currency4'] = $this->language->get('help_currency4');
        $data['entry_currency4'] = $this->language->get('entry_currency4');

        $data['help_salt5'] = $this->language->get('help_salt5');
        $data['entry_salt5'] = $this->language->get('entry_salt5');
        $data['help_merchantid5'] = $this->language->get('help_merchantid5');
        $data['entry_merchantid5'] = $this->language->get('entry_merchantid5');
        $data['help_currency5'] = $this->language->get('help_currency5');
        $data['entry_currency5'] = $this->language->get('entry_currency5');

        $data['help_salt6'] = $this->language->get('help_salt6');
        $data['entry_salt6'] = $this->language->get('entry_salt6');
        $data['help_merchantid6'] = $this->language->get('help_merchantid6');
        $data['entry_merchantid6'] = $this->language->get('entry_merchantid6');
        $data['help_currency6'] = $this->language->get('help_currency6');
        $data['entry_currency6'] = $this->language->get('entry_currency6');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_order_status_payubiz'] = $this->language->get('tab_order_status_payubiz');
		$data['entry_captured_order_status'] = $this->language->get('entry_captured_order_status');
		$data['entry_bounced_order_status'] = $this->language->get('entry_bounced_order_status');
		$data['entry_dropped_order_status'] = $this->language->get('entry_dropped_order_status');
		$data['entry_failed_order_status'] = $this->language->get('entry_failed_order_status');		
		$data['entry_user_cancelled_order_status'] = $this->language->get('entry_user_cancelled_order_status');
		$data['entry_inprogress_order_status'] = $this->language->get('entry_inprogress_order_status');
		$data['entry_initiated_order_status'] = $this->language->get('entry_initiated_order_status');
		$data['entry_auto_refund_order_status'] = $this->language->get('entry_auto_refund_order_status');
		$data['entry_pending_order_status'] = $this->language->get('entry_pending_order_status');
		$data['entry_auth_order_status'] = $this->language->get('entry_auth_order_status');
		$data['entry_cancelled_order_status'] = $this->language->get('entry_cancelled_order_status');
		
		$data['CreditCard'] = $this->language->get('CreditCard');
		$data['DebitCard'] = $this->language->get('DebitCard');
		$data['NetBanking'] = $this->language->get('NetBanking');
		$data['PayUMoney'] = $this->language->get('PayUMoney');
		$data['PayUbiz'] = $this->language->get('PayUbiz');

	  if (isset($this->request->post['payu_captured_order_status_id'])) {
					$data['payu_captured_order_status_id'] = $this->request->post['payu_captured_order_status_id'];
				} else {
					$data['payu_captured_order_status_id'] = $this->config->get('payu_captured_order_status_id');
				}
		 if (isset($this->request->post['payu_bounced_order_status_id'])) {
					$data['payu_bounced_order_status_id'] = $this->request->post['payu_bounced_order_status_id'];
				} else {
					$data['payu_bounced_order_status_id'] = $this->config->get('payu_bounced_order_status_id');
				}

		 if (isset($this->request->post['payu_auth_order_status_id'])) {
					$data['payu_auth_order_status_id'] = $this->request->post['payu_auth_order_status_id'];
				} else {
					$data['payu_auth_order_status_id'] = $this->config->get('payu_auth_order_status_id');
				}

		 if (isset($this->request->post['payu_dropped_order_status_id'])) {
					$data['payu_dropped_order_status_id'] = $this->request->post['payu_dropped_order_status_id'];
				} else {
					$data['payu_dropped_order_status_id'] = $this->config->get('payu_dropped_order_status_id');
				}


		 if (isset($this->request->post['payu_failed_order_status_id'])) {
					$data['payu_failed_order_status_id'] = $this->request->post['payu_failed_order_status_id'];
				} else {
					$data['payu_failed_order_status_id'] = $this->config->get('payu_failed_order_status_id');
				}

		 if (isset($this->request->post['payu_user_cancelled_order_status_id'])) {
					$data['payu_user_cancelled_order_status_id'] = $this->request->post['payu_user_cancelled_order_status_id'];
				} else {
					$data['payu_user_cancelled_order_status_id'] = $this->config->get('payu_user_cancelled_order_status_id');
				}
				
		 if (isset($this->request->post['payu_inprogress_order_status_id'])) {
					$data['payu_inprogress_order_status_id'] = $this->request->post['payu_inprogress_order_status_id'];
				} else {
					$data['payu_inprogress_order_status_id'] = $this->config->get('payu_inprogress_order_status_id');
				}
				
		 if (isset($this->request->post['payu_initiated_order_status_id'])) {
					$data['payu_initiated_order_status_id'] = $this->request->post['payu_initiated_order_status_id'];
				} else {
					$data['payu_initiated_order_status_id'] = $this->config->get('payu_initiated_order_status_id');
				}	
				
	     if (isset($this->request->post['payu_auto_refund_order_status_id'])) {
					$data['payu_auto_refund_order_status_id'] = $this->request->post['payu_auto_refund_order_status_id'];
				} else {
					$data['payu_auto_refund_order_status_id'] = $this->config->get('payu_auto_refund_order_status_id');
				}
				
	     if (isset($this->request->post['payu_pending_order_status_id'])) {
					$data['payu_pending_order_status_id'] = $this->request->post['payu_pending_order_status_id'];
				} else {
					$data['payu_pending_order_status_id'] = $this->config->get('payu_pending_order_status_id');
				}																								

		if (isset($this->request->post['payu_bankcode_val'])) {
					$data['payu_bankcode_val'] = $this->request->post['payu_bankcode_val'];
				} else {
					$data['payu_bankcode_val'] = $this->config->get('payu_bankcode_val');
				}

       if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['merchant'])) {
			$data['error_merchant'] = $this->error['merchant'];
		} else {
			$data['error_merchant'] = '';
		}

        if (isset($this->error['salt'])) {
			$data['error_salt'] = $this->error['salt'];
		} else {
			$data['error_salt'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/payment/payu', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('extension/payment/payu', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['payu_merchantid1'])) {
			$data['payu_merchantid1'] = $this->request->post['payu_merchantid1'];
		} else {
			$data['payu_merchantid1'] = $this->config->get('payu_merchantid1');
		}

		if (isset($this->request->post['payu_currency1'])) {
			$data['payu_currency1'] = $this->request->post['payu_currency1'];
		} else {
			$data['payu_currency1'] = $this->config->get('payu_currency1');
		}

		if (isset($this->request->post['payu_merchantid2'])) {
			$data['payu_merchantid2'] = $this->request->post['payu_merchantid2'];
		} else {
			$data['payu_merchantid2'] = $this->config->get('payu_merchantid2');
		}

		if (isset($this->request->post['payu_currency2'])) {
			$data['payu_currency2'] = $this->request->post['payu_currency2'];
		} else {
			$data['payu_currency2'] = $this->config->get('payu_currency2');
		}

		if (isset($this->request->post['payu_merchantid3'])) {
			$data['payu_merchantid3'] = $this->request->post['payu_merchantid3'];
		} else {
			$data['payu_merchantid3'] = $this->config->get('payu_merchantid3');
		}

		if (isset($this->request->post['payu_currency3'])) {
			$data['payu_currency3'] = $this->request->post['payu_currency3'];
		} else {
			$data['payu_currency3'] = $this->config->get('payu_currency3');
		}

		if (isset($this->request->post['payu_merchantid4'])) {
			$data['payu_merchantid4'] = $this->request->post['payu_merchantid4'];
		} else {
			$data['payu_merchantid4'] = $this->config->get('payu_merchantid4');
		}

		if (isset($this->request->post['payu_currency4'])) {
			$data['payu_currency4'] = $this->request->post['payu_currency4'];
		} else {
			$data['payu_currency4'] = $this->config->get('payu_currency4');
		}

		if (isset($this->request->post['payu_merchantid5'])) {
			$data['payu_merchantid5'] = $this->request->post['payu_merchantid5'];
		} else {
			$data['payu_merchantid5'] = $this->config->get('payu_merchantid5');
		}

		if (isset($this->request->post['payu_currency5'])) {
			$data['payu_currency5'] = $this->request->post['payu_currency5'];
		} else {
			$data['payu_currency5'] = $this->config->get('payu_currency5');
		}

		if (isset($this->request->post['payu_merchantid6'])) {
			$data['payu_merchantid6'] = $this->request->post['payu_merchantid6'];
		} else {
			$data['payu_merchantid6'] = $this->config->get('payu_merchantid6');
		}

		if (isset($this->request->post['payu_currency6'])) {
			$data['payu_currency6'] = $this->request->post['payu_currency6'];
		} else {
			$data['payu_currency6'] = $this->config->get('payu_currency6');
		}

		if (isset($this->request->post['payu_salt1'])) {
			$data['payu_salt1'] = $this->request->post['payu_salt1'];
		} else {
			$data['payu_salt1'] = $this->config->get('payu_salt1');
		}

		if (isset($this->request->post['payu_salt2'])) {
			$data['payu_salt2'] = $this->request->post['payu_salt2'];
		} else {
			$data['payu_salt2'] = $this->config->get('payu_salt2');
		}

		if (isset($this->request->post['payu_salt3'])) {
			$data['payu_salt3'] = $this->request->post['payu_salt3'];
		} else {
			$data['payu_salt3'] = $this->config->get('payu_salt3');
		}

		if (isset($this->request->post['payu_salt4'])) {
			$data['payu_salt4'] = $this->request->post['payu_salt4'];
		} else {
			$data['payu_salt4'] = $this->config->get('payu_salt4');
		}

		if (isset($this->request->post['payu_salt5'])) {
			$data['payu_salt5'] = $this->request->post['payu_salt5'];
		} else {
			$data['payu_salt5'] = $this->config->get('payu_salt5');
		}
		if (isset($this->request->post['payu_salt6'])) {
			$data['payu_salt6'] = $this->request->post['payu_salt6'];
		} else {
			$data['payu_salt6'] = $this->config->get('payu_salt6');
		}
		
		
		if (isset($this->request->post['payu_test'])) {
			$data['payu_test'] = $this->request->post['payu_test'];
		} else {
			$data['payu_test'] = $this->config->get('payu_test');
		}
		
		if (isset($this->request->post['payu_total'])) {
			$data['payu_total'] = $this->request->post['payu_total'];
		} else {
			$data['payu_total'] = $this->config->get('payu_total'); 
		} 
				
		if (isset($this->request->post['payu_order_status_id'])) {
			$data['payu_order_status_id'] = $this->request->post['payu_order_status_id'];
		} else {
			$data['payu_order_status_id'] = $this->config->get('payu_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['payu_geo_zone_id'])) {
			$data['payu_geo_zone_id'] = $this->request->post['payu_geo_zone_id'];
		} else {
			$data['payu_geo_zone_id'] = $this->config->get('payu_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['payu_status'])) {
			$data['payu_status'] = $this->request->post['payu_status'];
		} else {
			$data['payu_status'] = $this->config->get('payu_status');
		}


		if (isset($this->request->post['payu_payment_gateway'])) {
			$data['payu_payment_gateway'] = $this->request->post['payu_payment_gateway'];
		} else {
			$data['payu_payment_gateway'] = $this->config->get('payu_payment_gateway');
		}
		
		if (isset($this->request->post['payu_sort_order'])) {
			$data['payu_sort_order'] = $this->request->post['payu_sort_order'];
		} else {
			$data['payu_sort_order'] = $this->config->get('payu_sort_order');
		}
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		

				
		$this->response->setOutput($this->load->view('extension/payment/payu.tpl', $data));

	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/payu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['payu_merchantid1']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}
			
		if (!$this->request->post['payu_salt1']) {
			$this->error['salt'] = $this->language->get('error_salt');
		}
		
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>