<?php 
class RateController extends BaseController{
	public function getIndex($id){
		$rate = DB::table('rate_tour')->where('Tour_attr_id', $id)->get();
		if (sizeof($rate)==0) {
			$rate['Tour_attr_id'] = func_get_arg(0);
			$rate['number_votes'] = 0;
			$rate['total_point'] = 0;
			$rate['deg_avg'] = 0;
			$rate['whole_avg'] = 0;
			return json_encode($rate);
		}
		return json_encode($rate[0]);
		//http://code.tutsplus.com/tutorials/building-a-5-star-rating-system-with-jquery-ajax-and-php--net-11541
	}
}

 ?>