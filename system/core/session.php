<?php
/**
* 
*/
class session
{
	
	function __construct()
	{
		session_start();
	}

	public function userdata($name = NULL)
	{	
		return $_SESSION[$name];
	}

	public function set_userdata($data,$value = NULL)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;			
			}
			return;
		}
		$_SESSION[$data] = $value;

	}

	public function unset_usedata($name)
	{
		unset($_SESSION[$name]);
	}

	public function destroy()
	{
		session_destroy();
	}

		public function flashdata($name) //flashdata session
	{
		if (!empty($_SESSION[$name])) {
			echo $_SESSION[$name]; 
        	unset($_SESSION[$name]);
		}
	}
	public function set_flashdata($name, $msg) //flashdata create
	{
        if(!empty($_SESSION[$name]))
        {
            unset($_SESSION[$name]);
        }
        $_SESSION[$name] = $msg;
	}
}