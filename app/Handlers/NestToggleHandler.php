<?php namespace NestedPages\Handlers;
/**
* Syncs User's Visible/Toggled Pages
*/
class NestToggleHandler extends BaseHandler {


	public function __construct()
	{
		parent::__construct();
		$this->updateUserMeta();
	}


	/**
	* Make sure this is an array of integers
	*/
	private function validateIDs()
	{
		if ( !is_array($this->data['ids']) ) $this->sendErrorResponse();
		foreach ($this->data['ids'] as $id){
			if ( !is_numeric($id) ) $this->sendErrorResponse();
		}
	}


	/**
	* Update the user meta with the array of IDs
	*/
	private function updateUserMeta()
	{
		update_user_meta(
			get_current_user_id(),
			'np_visible_pages',
			serialize($this->data['ids'])
		);
		$this->response = array('status'=>'success', 'data'=>$this->data);
		$this->sendResponse();
	}

}