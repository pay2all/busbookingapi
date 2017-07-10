///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// The Below snippet of code in front end for busLayout  


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetBusLayout extends CI_Controller {
	
	
	private $msg='';	
	public function index() 
	{

		if ($this->session->userdata('logged_in') != TRUE) 
		{ 
			redirect(base_url().'login'); 
		}
						
		else if($this->input->post("btnSubmit"))
		{}
		else 
		{ 		
		
				$bustype = "";
				$rowarray = array();
				$array_zindez0_tr1 = array();
				$array_zindez0_tr2 = array();
				$array_zindez0_tr3 = array();
				$array_zindez0_tr4 = array();
				$array_zindez0_tr5 = array();
				
				$array_zindez1_tr1 = array();
				$array_zindez1_tr2 = array();
				$array_zindez1_tr3 = array();
				$array_zindez1_tr4 = array();
				$array_zindez1_tr5 = array();
				
				
				$array_row_values0 = array();
				$array_col_values0 = array();
				
				$array_row_values1 = array();
				$array_col_values1 = array();
						
				$zindex0 = false;
				$zindex1 = false;				
				
				
				
				$user=$this->session->userdata('user_type');
				if(trim($user) == 'Distributor' or trim($user) == 'MasterDealer' or trim($user) == 'Agent')
				{	
					$dataarray = json_decode(base64_decode($this->input->post("hidrows")));		
					$hidfrom = base64_decode($this->input->post("hidfrom"));		
					$hidto = base64_decode($this->input->post("hidto"));		
					$hiddate = base64_decode($this->input->post("hiddate"));									
					//echo "From : ".$hidfrom;
					//echo "<br>";
					//echo "to : ".$hidto;
					//echo "<br>";
					//echo "date : ".$hiddate;
					//echo "<br>";
			
				//	print_r($dataarray);
				//print_r($dataarray->boardingPoints);
					//echo "<hr>";
					//exit;
					if(isset($dataarray->inventoryType) and isset($dataarray->routeScheduleId))
					{
						$url = 'https://www.pay2all.in/api/bus/v1/getBusLayout;	
					
						$response = curl_exec($ch);
					   $tablestr = '';
					   $tr1 = '';
					   $tr2 = '';
					   $tr3 = '';
					   $tr4 = '';
					   $tr5 = '';
						curl_close($ch);	
						$seatarray = json_decode($response);	
						//print_r($seatarray );exit;
						$zindex0str = '';
						$zindex1str = '';
					//	echo '<hr><hr><hr><hr>';
							foreach($seatarray->seats as $sr)	
							{
							//print_r($sr);
								$width = (string)$sr->width;
								$ladiesSeat = (string)$sr->ladiesSeat;
								$fare = (string)$sr->fare;
								$zIndex = (string)$sr->zIndex;
								
								$serviceTaxAmount = (string)$sr->serviceTaxAmount;
								$commission = (string)$sr->commission;
								$operatorServiceChargeAbsolute = (string)$sr->operatorServiceChargeAbsolute;
								$operatorServiceChargePercent = (string)$sr->operatorServiceChargePercent;
								$totalFareWithTaxes = (string)$sr->totalFareWithTaxes;
								
								$bookedBy = (string)$sr->bookedBy;
								$ac = (string)$sr->ac;
								$sleeper = (string)$sr->sleeper;
								$serviceTaxPer = (string)$sr->serviceTaxPer;
								$available = (string)$sr->available;
								$column = (string)$sr->column;
								$row = (string)$sr->row;
								$length = (string)$sr->length;
								$id = (string)$sr->id;						
								//echo "Width :".$width."   zIndex : ".$zIndex."   Column : ".$column."   Row : ".$row;
								if($zIndex == "0")
								{
									
									array_push($array_row_values0, $row);
									array_push($array_col_values0, $column);
									$zindex0 = true;
									
									$rowarray[0][$row][$column] = $sr;
									
									
								}
								if($zIndex == "1")
								{
									array_push($array_row_values1, $row);
									array_push($array_col_values1, $column);
									$zindex1 = true;
									$rowarray[1][$row][$column] = $sr;
								}
								
								
								
								//echo "<hr>";
								
							}
							
							
							
							
						
						
							
							
							
							
							
						
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// lower part seat layout drawing table start here
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

							//row column settings 
				$tablestr0 = '';			
				if($zindex0 == true)			
				{			


							$tablestr0 .= '<table style="width:500px;height:120px;" border=0>';
							for($r0 = 0;$r0 <= max($array_row_values0);$r0++)
							{
								$tablestr0.='<tr>';
								if($r0 == 0)
								{
									$tablestr0.= '<td style="width:1.5%"><div class="seat-sprite driver-seat"></div></td>';
									$tablestr0.= '<td rowspan="8"><div class="upper-lower-sprite lower-sprite"></div></td>';
								}
								else
								{
									$tablestr0.=  '<td style="width:8%"><div></div></td>';
								}
								for($c0 = 0;$c0 <= max($array_col_values0);$c0++)
								{
										$class3 = '';
										
										
										if(isset($rowarray[0][$r0][$c0]))
										{
											//$tablestr0.= $rowarray[0][$r0][$c0]->row.' '.$rowarray[0][$r0][$c0]->column;
											if((string)$rowarray[0][$r0][$c0]->length == 1)
											{
												if((string)$rowarray[0][$r0][$c0]->available == 1)
												{
													$class3.='seat-sprite seat-avail';
												}
												else
												{
													$class3.='seat-sprite male-seat-booked';
												}
												
											}
											if((string)$rowarray[0][$r0][$c0]->length == 2)
											{
												if((string)$rowarray[0][$r0][$c0]->available == 1)
												{
													$class3.='hori-sleep-sprite hori-sleep-avail';
												}
												else
												{
													$class3.='hori-sleep-sprite hori-sleep-booked';
												}
												
											}
											
											$tablestr0.='<td colspan='.$rowarray[0][$r0][$c0]->length.'>
											
											<input type="hidden" id="'.(string)$rowarray[0][$r0][$c0]->row.'-'.(string)$rowarray[0][$r0][$c0]->column.'-'.(string)$rowarray[0][$r0][$c0]->id.'-'.$dataarray->routeScheduleId.'" value="'.base64_encode(json_encode($rowarray[0][$r0][$c0])).'">';
											$tablestr0 .= '<div id="c'.(string)$rowarray[0][$r0][$c0]->row.'-'.(string)$rowarray[0][$r0][$c0]->column.'-0~'.(string)$dataarray->routeScheduleId.'" 
											onclick="selectedSeat(\''.(string)$rowarray[0][$r0][$c0]->row.'\',\''.(string)$rowarray[0][$r0][$c0]->column.'\',\''.(string)$dataarray->routeScheduleId.'\',\''.(string)$rowarray[0][$r0][$c0]->id.'\',\''.(string)$rowarray[0][$r0][$c0]->fare.'\')" 
											
											title="Seat No. '.(string)$rowarray[0][$r0][$c0]->id.' row '.(string)$rowarray[0][$r0][$c0]->row.' col = '.(string)$rowarray[0][$r0][$c0]->column.'" class="'.$class3.'"></div>';
											$tablestr0.='</td>';
										}
										else
										{
											$tablestr0.='<td><div title="'.$r0.' '.$c0.'" class="'.$class3.'"></div>';
											$tablestr0.='</td>';
										}
										
									
								}
								$tablestr0.='</tr>';
							}
							$tablestr0.='</table>';
				}
///*******************************************************************************************************************************//


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Upper part seat layout drawing table start here
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					$tablestr1 = '';
					if($zindex1 == true)
					{
							$tablestr1 .= '<table style="width:500px;height:120px;border-bottom:1px solid #999999" border=0>';
							for($r1 = 0;$r1 <= max($array_row_values1);$r1++)
							{
								$tablestr1.='<tr>';
								if($r1 == 0)
								{
									$tablestr1.= '<td style="width:1.5%"><div></div></td>';
									$tablestr1.= '<td rowspan="8"><div class="upper-lower-sprite upper-sprite"></div></td>';
								}
								else
								{
									$tablestr1.=  '<td style="width:8%"><div></div></td>';
								}
								for($c1 = 0;$c1 <= max($array_col_values1);$c1++)
								{
										$class3 = '';
										
										
										if(isset($rowarray[1][$r1][$c1]))
										{
											//$tablestr0.= $rowarray[0][$r0][$c0]->row.' '.$rowarray[0][$r0][$c0]->column;
											if((string)$rowarray[1][$r1][$c1]->length == 1)
											{
												if((string)$rowarray[1][$r1][$c1]->available == 1)
												{
													$class3.='seat-sprite seat-avail';
												}
												else
												{
													$class3.='seat-sprite male-seat-booked';
												}
												
											}
											if((string)$rowarray[1][$r1][$c1]->length == 2)
											{
												if((string)$rowarray[1][$r1][$c1]->available == 1)
												{
													$class3.='hori-sleep-sprite hori-sleep-avail';
												}
												else
												{
													$class3.='hori-sleep-sprite hori-sleep-booked';
												}
												
											}
											$tablestr1.='<td colspan='.(string)$rowarray[1][$r1][$c1]->length.'>';
											$tablestr1 .= '<div title="Seat No. '.(string)$rowarray[1][$r1][$c1]->id.' row '.(string)$rowarray[1][$r1][$c1]->row.' col = '.(string)$rowarray[1][$r1][$c1]->column.'" class="'.$class3.'"></div>';
											$tablestr1.='</td>';
										}
										else
										{
											$tablestr1.='<td>';
											$tablestr1.='</td>';
										}
										
									
								}
								$tablestr1.='</tr>';
							}
							$tablestr1.='</table>';
							
					}
///*******************************************************************************************************************************//
							echo '<div style="background-color:#e0ebeb;margin-right:36px;margin-top:30px;padding:20px;">';
							echo '<div id="cancelimageleftcorner">
								<img src="../cancel.ico" class="ribbon" onClick="closedivseatlayout('.(string)$dataarray->routeScheduleId.')"/>
								<div></div>
							</div>';
							echo '<table>';
								echo '<tr>';
									echo '<td>';
										echo '<div class="ssb-header">
											<div class="ssb-legend" >
												<ul style="height:160px;">
													<li style="height:30px;"><div class="border-radius-all-5px lg-common lg-seat-avail"></div><label for="">Available&nbsp;&nbsp;&nbsp;&nbsp;</label></li>
													<li style="height:30px;"><div class="border-radius-all-5px lg-common lg-lady-seat-avail"></div><label for="">Available for  female&nbsp;&nbsp;&nbsp;&nbsp;</label></li>
													<li style="height:30px;"><div class="border-radius-all-5px lg-common lg-seat-booked"></div><label for="">Booked&nbsp;&nbsp;&nbsp;&nbsp;</label></li>
													<li style="height:30px;"><div class="border-radius-all-5px lg-common lg-seat-selected"></div><label for="">Selected&nbsp;&nbsp;&nbsp;&nbsp;</label></li>
													<li style="height:30px;"><div class="border-radius-all-5px lg-common lg-seat-not-avail"></div><label for="">Not available&nbsp;&nbsp;&nbsp;&nbsp;</label></li>
												</ul>
											</div>
										</div>';
									echo '</td>';
									echo '<td>';
										echo '<table class="ssb-layout-box">';
											echo '<tr>';
												echo '<td>'.$tablestr1.'</td>';
											echo '</tr>';
											echo '<tr>';
												echo '<td>'.$tablestr0.'</td>';
											echo '</tr>';
											echo '</table>';
									echo '</td>';
								echo '</tr>';
							echo '</table>';
							echo $this->getCustomerForm($dataarray->boardingPoints,(string)$dataarray->routeScheduleId);
						echo '</div>';


							
							exit;


					}
					
				}
				else
				{redirect(base_url().'login');}																								
		} 
	}	
	private function getCustomerForm($boardingpoints,$routeid)
	{

		$str =  '<div>
				<table>
					<tr>
					<td valign="top">
						<table id="tblseats'.$routeid.'" class="table table-bordered" style="width:250px;">
							<tr>
								<th>Seat No</th>
								<th>Fare</th>
							</tr>
						</table>
					</td>
					<td valign="top">
						<table class="psngr_list" style="border:1px solid green;width:600px;padding:15px;">
						<tr>
							<td style="padding:15px;">Select Boarding Point:  </td>
							<td style="padding:15px;">';
							$str .='<select id="ddlbdps'.$routeid.'" name="ddlbdps" class="dropdown" style="width:260px;" onchange="setboardingpoint('.$routeid.')">';
							$str .='<option>Boarding Points</option>';
							foreach($boardingpoints as $bdps)
							{
								$str .='<option value='.$bdps->id.'>'.($bdps->time).' '.$bdps->location.'</option>';
							}
							
							$str.='</select>';
							
							
							$str.= '</td>
							<td style="padding:15px;">
							<input type="button" name="btnbook" id="btnbook" class="btn btn-primary" value="Book Now" onclick="validateseatselectionform('.$routeid.')">
							</td>
						</tr>
						</table>
					</td>
					</tr>
				</table>
				
				
		</div>';
		return $str;
	}
	
	
}?>