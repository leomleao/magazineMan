<?php

use Phalcon\Mvc\User\Component;
use Phalcon\Http\Response;

/**
 * JsonResponse
 *
 * Json formatter and creator
 */
class JsonResponse extends Component
{		
		/**
	     * @var array
	     * The document’s “primary data”,
	     */
	    protected $data;

	    /**
	     * @var array
	     * An array of error objects.
	     */
	    protected $errors;

	    /**
	     * @var array
	     * A meta object that contains non-standard meta-information.
	     */
	    protected $meta;


	    /**
	     * @var array
	     * An object describing the server’s implementation.
	     */
	    protected $jsonapi;

	    /**
	     * @var array
	     * A links object related to the primary data.
	     */
	    protected $links;

	    /**
	     * @var array
	     * An array of resource objects that are related to the primary data and/or each other (“included resources”)
	     */
	    protected $included;

	    public function __construct () {
	    	$this->data     = [];
	    	$this->errors 	= [];
		    $this->meta 	= ['copyright' => $this->config->meta['copyright'], 'authors' => explode(',', $this->config->meta['authors'])];
		    $this->jsonapi  = ['version' => '1.0'];
		    $this->links 	= [];
		    $this->included = [];

		}


		/**
	     *
	     *	@var $code refers to Hypertext Transfer Protocol -- HTTP/1.1
	     *
	     */
		public function send ($code) {
			$response = new Response();
        	$this->response->setContentType('application/vnd.api+json');

			if ($this->errors) {
				$json = ['errors' => $this->errors, 'meta' => $this->meta];
			} else {
				$json = ['data' => $this->data, 'meta' => $this->meta];
			}

			$response->setContent(json_encode($json, JSON_UNESCAPED_SLASHES));
			$response->setStatusCode($code);			

			return $response->send();
		}


		/**
	     *
	     *	@var $data is an array of data to be added to the response
	     *
	     */
		public function addData ($data){
			array_push($this->data, $data);
			return $this;
		}	


		/**
	     *
	     *	@var $error is an array of error data to be added to the response following the standard.
	     *  @link http://jsonapi.org/format/#errors
	     *
	     */
		public function addError ($error) {
			array_push($this->errors, $error);

			return $this;
		}

				
}



		