<?php


/**
 * JsonException
 *
 * Json Error formatter and creator
 *
 *
 * @link http://jsonapi.org/format/#errors
 *
 */
class JsonException {

		/**
	     * @var string
	     * A unique identifier for this particular occurrence of the problem.	     
	     */
	    protected $id;

	    /**
	     * @var array
	     * array ('about' => 'Link regarding the problem.').
	     */
	    protected $links;

	    /**
	     * @var string
	     * The Hypertext Transfer Protocol -- HTTP/1.1 status code applicable to this problem, expressed as a string value.
	     */
	    protected $status;

	    /**
	     * @var string
	     * An application-specific error code, expressed as a string value.
	     */
	    protected $code;

	    /**
	     * @var string
	     * A short, human-readable summary of the problem that SHOULD NOT change from occurrence to occurrence of the problem, except for purposes of localization.
	     */
	    protected $title;

	    /**
	     * @var string
	     * A human-readable explanation specific to this occurrence of the problem. Like title, this field’s value can be localized.
	     */
	    protected $detail;

	    /**
	     * @var array
	     * array (
	     		'pointer' => 'A JSON Pointer [RFC6901] to the associated entity in the request document [e.g. /data for a primary data object, or /data/attributes/title for a specific attribute].',
           		'parameter' => 'URI that caused the problem.'
            )
	     */
	    protected $source;

	    /**
	     * @var array
	     * A meta object containing non-standard meta-information about the error.
	     * @link http://jsonapi.org/format/#document-meta
	     */
	    protected $meta;
	   

	    public function __construct () {
	    	$this->id 		= uniqid();
	    	$this->links 	= ['about' => ''];
	    	$this->status 	= '';
	    	$this->code 	= '';
	    	$this->title 	= '';
	    	$this->detail 	= '';
	    	$this->source 	= ['pointer' => '', 'parameter' => ''];
	    	$this->meta 	= [];	 
		}

		public function addLink($link){
			
			$this->links['about'] = $link;
			return $this;
		}

		public function addStatus ($status){
			
			$this->status = $status;
			return $this;
		}

		public function addCode ($code){
			
			$this->code = $code;
			return $this;
		}

		public function addTitle ($title){
			
			$this->title = $title;
			return $this;
		}

		public function addDetail ($detail){
			
			$this->detail = $detail;
			return $this;
		}

		public function addSource($pointer, $parameter){
			
			$this->source['pointer']   = $pointer;
			$this->source['parameter'] = $parameter;

			return $this;
		}	

		public function addMeta ($meta) {

			array_push($this->meta, $meta);
			return $this;
		}

		public function commit (){

			$error = array (
					'id'     => $this->id,
                    'links'  => $this->links,
                    'status' => $this->status,
                    'code'   => $this->code,
                    'title'  => $this->title,
                    'detail' => $this->detail,
                    'source' => $this->source,
                    'meta'   => $this->meta
				);

			return $error;
		}

}

        