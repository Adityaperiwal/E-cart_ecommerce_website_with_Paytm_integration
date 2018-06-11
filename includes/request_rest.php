<?php
	class RestRequest {
		private $curl_handle;
		private $request_url;
		private $method;
		private $request_body;
		private $content_type;
		private $api_key;
		private $response_body;
		private $response_status;

		public function __construct() {
			$this->method = "GET";
			$this->request_body = "";
			$this->content_type = "application/json";
		}

		public function setRequestURL($request_url) {
			$this->request_url = $request_url;
		}

		public function setAPIKey($api_key) {
			$this->api_key = $api_key;
		}

		public function setRequestBody($request_body) {
			$this->request_body = $request_body;
		}

		public function setContentType($content_type) {
			$this->content_type = $content_type;
		}

		public function setMethod($method) {
			$this->method = $method;
		}

		private function setCurlOption() {
			curl_setopt($this->curl_handle, CURLOPT_TIMEOUT, 10);
			curl_setopt($this->curl_handle, CURLOPT_URL, $this->request_url);
			curl_setopt($this->curl_handle, CURLOPT_HTTPHEADER, array("Content-Type: " . $this->content_type, "X-Apikey: " . $this->api_key));
			curl_setopt($this->curl_handle, CURLOPT_RETURNTRANSFER, true);
		}

		private function invoke() {
			$this->response_body = curl_exec($this->curl_handle);
			$this->response_status = curl_getinfo($this->curl_handle, CURLINFO_HTTP_CODE);
		}

		public function execute() {
			$this->curl_handle = curl_init();
			$this->setCurlOption();

			switch (strtoupper($this->method)) {

				case "GET":
					$this->setGet();
					break;

				case "POST":
					$this->setPost();
					break;

				case "PUT":
					$this->setPut();
					break;

				case "DELETE":
					$this->setDelete();
					break;

				default:
					$this->setGet();
					break;
			}

			$this->invoke();
			curl_close($this->curl_handle);

			$result = array($this->response_status, $this->response_body);

			return $result;
		}

		private function setGet() {
			curl_setopt($this->curl_handle, CURLOPT_POST, false);
		}

		private function setPost() {
			curl_setopt($this->curl_handle, CURLOPT_POST, true);
			curl_setopt($this->curl_handle, CURLOPT_POSTFIELDS, $this->request_body);
		}

		private function setDelete() {
			curl_setopt($this->curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
		}

		private function setPut() {
			curl_setopt($this->curl_handle, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($this->curl_handle, CURLOPT_POSTFIELDS, $this->request_body);
		}
	}
?>


