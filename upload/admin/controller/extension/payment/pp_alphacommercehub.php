<?php
class ControllerExtensionPaymentPPAlphacommercehub extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/pp_alphacommercehub');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pp_alphacommercehub', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_authorization'] = $this->language->get('text_authorization');
		$data['text_sale'] = $this->language->get('text_sale');

		$data['entry_email'] = $this->language->get('entry_email');
$data['entry_user'] = $this->language->get('entry_user');
		$data['entry_url'] = $this->language->get('entry_url');
		$data['entry_merchant'] = $this->language->get('entry_merchant');
		$data['entry_test'] = $this->language->get('entry_test');
		$data['entry_transaction'] = $this->language->get('entry_transaction');
		$data['entry_debug'] = $this->language->get('entry_debug');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_canceled_reversal_status'] = $this->language->get('entry_canceled_reversal_status');
		$data['entry_completed_status'] = $this->language->get('entry_completed_status');
		$data['entry_denied_status'] = $this->language->get('entry_denied_status');
		$data['entry_expired_status'] = $this->language->get('entry_expired_status');
		$data['entry_failed_status'] = $this->language->get('entry_failed_status');
		$data['entry_pending_status'] = $this->language->get('entry_pending_status');
		$data['entry_processed_status'] = $this->language->get('entry_processed_status');
		$data['entry_refunded_status'] = $this->language->get('entry_refunded_status');
		$data['entry_reversed_status'] = $this->language->get('entry_reversed_status');
		$data['entry_voided_status'] = $this->language->get('entry_voided_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_mode'] = $this->language->get('entry_mode');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_test'] = $this->language->get('help_test');
		$data['help_debug'] = $this->language->get('help_debug');
		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_order_status'] = $this->language->get('tab_order_status');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/pp_alphacommercehub', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/pp_alphacommercehub', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);

		if (isset($this->request->post['pp_alphacommercehub_email'])) {
			$data['pp_alphacommercehub_email'] = $this->request->post['pp_alphacommercehub_email'];
		} else {
			$data['pp_alphacommercehub_email'] = $this->config->get('pp_alphacommercehub_email');
		}

		if (isset($this->request->post['pp_alphacommercehub_test'])) {
			$data['pp_alphacommercehub_test'] = $this->request->post['pp_alphacommercehub_test'];
		} else {
			$data['pp_alphacommercehub_test'] = $this->config->get('pp_alphacommercehub_test');
		}

		if (isset($this->request->post['pp_alphacommercehub_transaction'])) {
			$data['pp_alphacommercehub_transaction'] = $this->request->post['pp_alphacommercehub_transaction'];
		} else {
			$data['pp_alphacommercehub_transaction'] = $this->config->get('pp_alphacommercehub_transaction');
		}
if (isset($this->request->post['pp_alphacommercehub_user'])) {
			$data['pp_alphacommercehub_user'] = $this->request->post['pp_alphacommercehub_user'];
		} else {
			$data['pp_alphacommercehub_user'] = $this->config->get('pp_alphacommercehub_user');
		}
		if (isset($this->request->post['pp_alphacommercehub_url'])) {
			$data['pp_alphacommercehub_url'] = $this->request->post['pp_alphacommercehub_url'];
		} else {
			$data['pp_alphacommercehub_url'] = $this->config->get('pp_alphacommercehub_url');
		}
		if (isset($this->request->post['pp_alphacommercehub_merchant'])) {
			$data['pp_alphacommercehub_merchant'] = $this->request->post['pp_alphacommercehub_merchant'];
		} else {
			$data['pp_alphacommercehub_merchant'] = $this->config->get('pp_alphacommercehub_merchant');
		}
		if (isset($this->request->post['pp_alphacommercehub_debug'])) {
			$data['pp_alphacommercehub_debug'] = $this->request->post['pp_alphacommercehub_debug'];
		} else {
			$data['pp_alphacommercehub_debug'] = $this->config->get('pp_alphacommercehub_debug');
		}

		if (isset($this->request->post['pp_alphacommercehub_total'])) {
			$data['pp_alphacommercehub_total'] = $this->request->post['pp_alphacommercehub_total'];
		} else {
			$data['pp_alphacommercehub_total'] = $this->config->get('pp_alphacommercehub_total');
		}

		if (isset($this->request->post['pp_alphacommercehub_canceled_reversal_status_id'])) {
			$data['pp_alphacommercehub_canceled_reversal_status_id'] = $this->request->post['pp_alphacommercehub_canceled_reversal_status_id'];
		} else {
			$data['pp_alphacommercehub_canceled_reversal_status_id'] = $this->config->get('pp_alphacommercehub_canceled_reversal_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_completed_status_id'])) {
			$data['pp_alphacommercehub_completed_status_id'] = $this->request->post['pp_alphacommercehub_completed_status_id'];
		} else {
			$data['pp_alphacommercehub_completed_status_id'] = $this->config->get('pp_alphacommercehub_completed_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_denied_status_id'])) {
			$data['pp_alphacommercehub_denied_status_id'] = $this->request->post['pp_alphacommercehub_denied_status_id'];
		} else {
			$data['pp_alphacommercehub_denied_status_id'] = $this->config->get('pp_alphacommercehub_denied_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_expired_status_id'])) {
			$data['pp_alphacommercehub_expired_status_id'] = $this->request->post['pp_alphacommercehub_expired_status_id'];
		} else {
			$data['pp_alphacommercehub_expired_status_id'] = $this->config->get('pp_alphacommercehub_expired_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_failed_status_id'])) {
			$data['pp_alphacommercehub_failed_status_id'] = $this->request->post['pp_alphacommercehub_failed_status_id'];
		} else {
			$data['pp_alphacommercehub_failed_status_id'] = $this->config->get('pp_alphacommercehub_failed_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_pending_status_id'])) {
			$data['pp_alphacommercehub_pending_status_id'] = $this->request->post['pp_alphacommercehub_pending_status_id'];
		} else {
			$data['pp_alphacommercehub_pending_status_id'] = $this->config->get('pp_alphacommercehub_pending_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_processed_status_id'])) {
			$data['pp_alphacommercehub_processed_status_id'] = $this->request->post['pp_alphacommercehub_processed_status_id'];
		} else {
			$data['pp_alphacommercehub_processed_status_id'] = $this->config->get('pp_alphacommercehub_processed_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_refunded_status_id'])) {
			$data['pp_alphacommercehub_refunded_status_id'] = $this->request->post['pp_alphacommercehub_refunded_status_id'];
		} else {
			$data['pp_alphacommercehub_refunded_status_id'] = $this->config->get('pp_alphacommercehub_refunded_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_reversed_status_id'])) {
			$data['pp_alphacommercehub_reversed_status_id'] = $this->request->post['pp_alphacommercehub_reversed_status_id'];
		} else {
			$data['pp_alphacommercehub_reversed_status_id'] = $this->config->get('pp_alphacommercehub_reversed_status_id');
		}

		if (isset($this->request->post['pp_alphacommercehub_voided_status_id'])) {
			$data['pp_alphacommercehub_voided_status_id'] = $this->request->post['pp_alphacommercehub_voided_status_id'];
		} else {
			$data['pp_alphacommercehub_voided_status_id'] = $this->config->get('pp_alphacommercehub_voided_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['pp_alphacommercehub_geo_zone_id'])) {
			$data['pp_alphacommercehub_geo_zone_id'] = $this->request->post['pp_alphacommercehub_geo_zone_id'];
		} else {
			$data['pp_alphacommercehub_geo_zone_id'] = $this->config->get('pp_alphacommercehub_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['pp_alphacommercehub_status'])) {
			$data['pp_alphacommercehub_status'] = $this->request->post['pp_alphacommercehub_status'];
		} else {
			$data['pp_alphacommercehub_status'] = $this->config->get('pp_alphacommercehub_status');
		}
if (isset($this->request->post['pp_alphacommercehub_mode'])) {
			$data['pp_alphacommercehub_mode'] = $this->request->post['pp_alphacommercehub_mode'];
		} else {
			$data['pp_alphacommercehub_mode'] = $this->config->get('pp_alphacommercehub_mode');
		}


		if (isset($this->request->post['pp_alphacommercehub_sort_order'])) {
			$data['pp_alphacommercehub_sort_order'] = $this->request->post['pp_alphacommercehub_sort_order'];
		} else {
			$data['pp_alphacommercehub_sort_order'] = $this->config->get('pp_alphacommercehub_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/pp_alphacommercehub', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/pp_alphacommercehub')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['pp_alphacommercehub_email']) {
			$this->error['email'] = $this->language->get('error_email');
		}

		return !$this->error;
	}
}
