<?php 
class ServiceController extends BaseController{
	public function getProvince(){
		if(func_num_args() == 0) $province = DB::table('province')->select('Province_id', 'Province_name', 'Region')->get();
		else  $province = DB::table('province')->select('Province_id', 'Province_name', 'Region')->where('Region', func_get_arg(0))->get();
		return json_encode($province);
	}

	public function getDistrict(){
		if(func_num_args() == 0) $district = DB::table('district')->select('District_id', 'District_name', 'Province_id')->get();
		else  $district = DB::table('district')->select('District_id', 'District_name', 'Province_id')->where('Province_id', func_get_arg(0))->get();
		return json_encode($district);
	}
}




 ?>