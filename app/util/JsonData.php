<?php


/**
 * JsonData
 *
 * Json Data formatter and creator
 *
 *
 * @link http://jsonapi.org/format/
 *
 */
class JsonData {

		/**
	     * @var string
	     * The type member is used to describe resource objects that share common attributes and relationships.
	     */
	    protected $type;

		/**
	     * @var string
	     * A unique identifier of the resource Object required.     
	     */
	    protected $id;	        

	    /**
	     * @var array OPTIONAL
	     * An attributes object representing some of the resource’s data.
	     * @link http://jsonapi.org/format/#document-resource-object-attributes
	     */
	    protected $attributes;

	    /**
	     * @var array  OPTIONAL
	     * A relationships object describing relationships between the resource and other JSON API resources.
	     * @link http://jsonapi.org/format/#document-resource-object-relationships
	     */
	    protected $relationships;

	    /**
	     * @var array  OPTIONAL
	     * An attributes object representing some of the resource’s data.
	     * @link http://jsonapi.org/format/#document-links
	     */
	    protected $links;

	    /**
	     * @var array  OPTIONAL
	     * A meta object containing non-standard meta-information.
	     * @link http://jsonapi.org/format/#document-meta
	     */
	    protected $meta;	    
	   

	    public function __construct () {
	    	$this->isEmpty		 = TRUE;
	    	$this->attributes 	 = array();
	    	$this->relationships = array();
	    	$this->links 		 = array();
	    	$this->meta 		 = array();	 
		}

		public function setType($type){

			$this->isEmpty = FALSE;
			$this->type = $type;
			return $this;
		}

		public function setId ($id){

			$this->isEmpty = FALSE;			
			$this->id = $id;
			return $this;
		}

		public function addAttributes ($attributes) {

			array_push($this->attributes, $attributes);
			return $this;
		}

		public function addRelationships ($relationships) {

			array_push($this->relationships, $relationships);
			return $this;
		}

		public function addLinks ($links) {

			array_push($this->links, $links);
			return $this;
		}		

		public function addMeta ($meta) {

			array_push($this->meta, $meta);
			return $this;
		}
		

		public function commit (){

			if ($this->isEmpty) {
				return [];
			}

			$data = array (
					'type'     		=> $this->type,
                    'id'  			=> $this->id,
                    'attributes' 	=> $this->attributes,
                    'relationships' => $this->relationships,
                    'links'  		=> $this->links,
                    'meta' 			=> $this->meta
				);

			return $data;
		}

}

        