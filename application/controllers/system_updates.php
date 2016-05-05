<?php 
/**
 * @author Karsan
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class System_updates extends MY_Controller {

	function __construct() {
		parent::__construct();
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
	}
public function system_updates_home($update_status=NULL,$update_presence = NULL){
		// echo "<pre>";print_r($update_presence);exit;
		$permissions='super_permissions';
		$data['user_types']=Access_level::get_access_levels($permissions);
		$identifier = $this -> session -> userdata('user_indicator');

		$status = (isset($update_presence) && $update_presence = 1)? 1:NULL;

		if (isset($status) && $status == 1) {
			$status_ = "TRUE";
			$available_update = 1;
		}else{
			$status_ = "FALSE";
			$available_update = 0;
		}

		$latest_update_time = $this->latest_server_update_time();
		
		// echo "<pre>";print_r($latest_update_time);echo "</pre>";exit;	
		// echo $available_update;exit;
		$update_records = update_model::get_prior_records();
		// echo "<pre>";print_r($update_records);exit;

		$data['available_update'] = $available_update;
		$data['latest_update_time'] = $latest_update_time;
		$data['update_status'] = $status_;
		$data['update_records'] = $update_records;

		$data['title'] = "System Updates";
		$data['banner_text'] = "System Management";
		$data['banner_text'] = "System Management";
        $template = 'shared_files/template/template';            
        $data['latest_hash'] = $hash;
        $data['content_view'] = "offline/offline_admin_home";

		$this -> load -> view($template, $data);
	}

	public function update_system()
	{
		$ts = $this->generate_filestamp();
		echo $ts;exit;
		
		// $hash = $this->get_hash();			
		// $get_zip = $this->get_latest_zip();
		// $update_files = $this->extract_and_copy_files($hash);
		// $update_git_log = $this->update_log($hash);
		
		// $extracted_path = $this->get_extracted_path();
		// $delete_residual_repo = $this->delete_residual_files($hash.'.zip');
		// $delete_residual_dir = $this->delete_residual_files($extracted_path);
		// $update_logs = $this->update_log($hash);

		
		// echo "<pre>";print_r($update_files);exit;
		// echo $set_current_commit;exit;
		// echo "I worked";
		redirect('/git_updater/admin_updates_home/1');
	}

	public function extract_and_copy_files(){
		$success_status = array();
		$hash = $this -> get_hash();

		$unzip_status = $this->unzip->extract($hash.'.zip');

		// echo "<pre>"; print_r($unzip_status);echo "</pre>";exit;
		$sanitized_directory = array();
		foreach ($unzip_status as $unzip) {
			$unzip = substr($unzip, 2);
			// echo "<pre>".$unzip;
			$del = "/";
			$trimmed=strpos($unzip, $del);
			$important=substr($unzip, $trimmed+strlen($del)-1, strlen($unzip)-1);
			$important = substr($important, 1);

			$sanitized_directory[] = $important;
		}
		// echo "<pre>";print_r($sanitized_directory);
		$ignored = $this->ignored_files();
		$squeaky = $this->array_cleaner($sanitized_directory,$ignored);
		$extracted_path = $this->get_extracted_path();
		// echo "<pre>";print_r($squeaky);
		// echo "<pre>";print_r($extracted_path);
		$status = $this->copy_and_replace($squeaky,$extracted_path);
		// echo "<pre>";print_r($status);
		// $set_hash = $this->github_updater->_set_config_hash($hash);
		$success_status['extracted_path'] = $extracted_path;
		$success_status['status'] = $status;

		return $success_status;
	}


}

?>