<?php 
class RateController extends BaseController{
	public function getIndex($id){
		$rate = DB::table('rate_tour')->where('Tour_attr_id', $id)->get();
		if (sizeof($rate)==0) {
			$rate['Tour_attr_id'] = func_get_arg(0);
			$rate['number_votes'] = 0;
			$rate['total_point'] = 0;
			$rate['dec_avg'] = 0;
			$rate['whole_avg'] = 0;
			return json_encode($rate);
		}
		return json_encode($rate[0]);
		//http://code.tutsplus.com/tutorials/building-a-5-star-rating-system-with-jquery-ajax-and-php--net-11541
	}

	public function postSet($id){
		if(Auth::check()){
			$rateId = DB::table('rate')->where('Tour_attr_id', $id)->where('Customer_id', Auth::user()->id)->get();
			if (sizeof($rateId)==0){
					DB::table('rate')->insert(array(
						'Tour_attr_id' => func_get_arg(0),
						'Customer_id' => Auth::user()->id,
						'rate' => Input::get('clicked_on')));
					$rate = DB::table('rate_tour')->where('Tour_attr_id', $id)->get();
					if (sizeof($rate)==0) {
						$rate['Tour_attr_id'] = func_get_arg(0);
						$rate['number_votes'] = 1;
						$rate['total_point'] = Input::get('clicked_on');
						$rate['dec_avg'] = $rate['total_point']/$rate['number_votes'] ;
						$rate['whole_avg'] = floor($rate['dec_avg']);
						DB::table('rate_tour')->insert($rate);
						$rate['login'] = 1;
						return json_encode($rate);
					}else {
						$total_point = $rate[0]->total_point;
						$number_votes = $rate[0]->number_votes + 1;
						$rate_inject['tour_attr_id'] = func_get_arg(0);
						$rate_inject['total_point'] = $total_point + Input::get('clicked_on');				
						$rate_inject['dec_avg'] = $rate_inject['total_point']*1.0/$number_votes;
						$rate_inject['whole_avg'] = floor($rate_inject['dec_avg']);
						DB::table('rate_tour')->where('Tour_attr_id', $id)->update(array(
								'total_point' => $rate_inject['total_point'],
								'dec_avg' => $rate_inject['dec_avg'],
								'number_votes' => $number_votes,
								'whole_avg'=> $rate_inject['whole_avg']));
						$rate_inject['login'] = 2;
						return json_encode($rate_inject);
					}
			}else {
				$temp_rate = $rateId[0]->rate;
				$rateId = DB::table('rate')->where('Tour_attr_id', $id)->where('Customer_id', Auth::user()->id)->update(array("rate" => Input::get('clicked_on')));
				$rate = DB::table('rate_tour')->where('Tour_attr_id', $id)->get();
				$total_point = $rate[0]->total_point;
				$number_votes = $rate[0]->number_votes;
				$rate_inject['tour_attr_id'] = func_get_arg(0);
				$rate_inject['total_point'] = $total_point + Input::get('clicked_on') - $temp_rate;	
				var_dump($rate_inject['total_point']);			
				$rate_inject['dec_avg'] = $rate_inject['total_point']*1.0/$number_votes;
				$rate_inject['whole_avg'] = floor($rate_inject['dec_avg']);
				DB::table('rate_tour')->where('Tour_attr_id', $id)->update(array(
							'total_point' => $rate_inject['total_point'],
							'dec_avg' => $rate_inject['dec_avg'],
							'whole_avg'=> $rate_inject['whole_avg']));
				var_dump(DB::table('rate_tour')->where('Tour_attr_id', $id)->get());
				$rate_inject['login'] = 2;
				return json_encode($rate_inject);
			}
		}else{
			$rate['login'] = 0;
			return json_encode($rate);
		}
	}
}

 ?>