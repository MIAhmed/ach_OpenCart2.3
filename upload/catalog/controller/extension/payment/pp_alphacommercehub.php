<?php
class ControllerExtensionPaymentPPAlphacommercehub extends Controller {
	public function index() {
		$this->load->language('extension/payment/pp_alphacommercehub');

		$data['text_testmode'] = $this->language->get('text_testmode');
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['testmode'] = $this->config->get('pp_alphacommercehub_test');

		/*if (!$this->config->get('pp_alphacommercehub_test')) {
			$data['action'] = 'https://www.paypal.com/cgi-bin/webscr';
		} else {
			$data['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}*/
$data['action'] = 'https://hubuat.alphacommercehub.com.au/pp/'.$this->config->get('pp_alphacommercehub_url');
$data['user'] = $this->config->get('pp_alphacommercehub_user');

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		if ($order_info) {
			$data['business'] = $this->config->get('pp_alphacommercehub_email');
$data['merchant'] = $this->config->get('pp_alphacommercehub_merchant');
			$data['item_name'] = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

			$data['products'] = array();

			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();

				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					} else {
						$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
						
						if ($upload_info) {
							$value = $upload_info['name'];
						} else {
							$value = '';
						}
					}

					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
					);
				}

				$data['products'][] = array(
					'name'     => htmlspecialchars($product['name']),
					'model'    => htmlspecialchars($product['model']),
					'price'    => $this->currency->format($product['price'], $order_info['currency_code'], false, false),
					'quantity' => $product['quantity'],
					'option'   => $option_data,
					'weight'   => $product['weight']
				);
			}

			$data['discount_amount_cart'] = 0;

			$total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);
$amount = $order_info['total'] * 1000;
$data['Amount'] = round($amount);

			if ($total > 0) {
				$data['products'][] = array(
					'name'     => $this->language->get('text_total'),
					'model'    => '',
					'price'    => $total,
					'quantity' => 1,
					'option'   => array(),
					'weight'   => 0
				);
			} else {
				$data['discount_amount_cart'] -= $total;
			}

			$data['currency_code'] = $order_info['currency_code'];
			$data['first_name'] = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
			$data['last_name'] = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
			$data['address1'] = html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');
			$data['address2'] = html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8');
			$data['city'] = html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
			$data['zip'] = html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
			$data['country'] = $order_info['payment_iso_code_2'];
			$data['email'] = $order_info['email'];
			$data['invoice'] = $this->session->data['order_id'] . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
$data['merchanttxnid'] = $this->session->data['order_id'].'001';
			$data['lc'] = $this->session->data['language'];
			$data['return'] = $this->url->link('checkout/success');
			$data['notify_url'] = $this->url->link('extension/payment/pp_alphacommercehub/callback', '', true);
			$data['cancel_return'] = $this->url->link('checkout/checkout', '', true);

			if (!$this->config->get('pp_alphacommercehub_transaction')) {
				$data['paymentaction'] = 'authorization';
			} else {
				$data['paymentaction'] = 'sale';
			}

			$data['custom'] = $this->session->data['order_id'];

			return $this->load->view('extension/payment/pp_alphacommercehub', $data);
		}
	}

	public function callback() {
		$posteddata=json_decode($_POST['data']);
		$order_id=$posteddata->Result->MerchantTxnID;
		$order_id=$posteddata->Result->MerchantTxnID;
		$order_id=str_replace('001','',$order_id);
		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($order_id);
		if($order_info){
		if($posteddata->MethodResult->Status == 0){
$status='5';
}
else{
$status='7';
}
$this->model_checkout_order->addOrderHistory($order_id,$status);
?>
<script>
window.location.href = "<?php echo $this->url->link('checkout/success', '', true); ?>";
</script>
<?php
		}
	}
}
