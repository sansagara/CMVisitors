<?php
	function createTimeComboJSArray($name='starttime')
	{
		$html="[";
		if ($name =='starttime')
		{
			$html .="['12:00 AM',''],";
		}
		
		for($i=1;$i<24;$i++){
			if($i>=12){
				$j= ($i==12)?12:($i-12);
				//$html.="<option value='$i'>$j:00 PM</option>";
				$html.="['$j:00 PM',$i]";
			}
			else
			{
				//$html.="<option value='$i'>$i:00 AM</option>";
				$html.="['$i:00 AM',$i]";
			}
			if($i!=23)
			{
				$html.=",";
			}
		}
		
		if ($name !='starttime')
		{
			$html .=",['11:59 PM','']";
		}
		$html.="]";
		return $html;
	}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="js/ext-2.0/resources/css/ext-all.css" />
<script type="text/javascript" src="js/ext-2.0/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="js/ext-2.0/ext-all.js"></script>
<script type="text/javascript" src="js/extutilities.js"></script>
<script type="text/javascript" src="js/source.js"></script>
<script type="text/javascript" src="js/extresponse.js"></script>

</head>
<body>
				
		<div id="reportFrame" style="width:100%;position:absolute;"; class="x-box-blue">
		    <div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>
		    <div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc">

			    <div id="report-title">
				    <table width="100%">
				    	<tr>
				    		<td width="50%">
				    		<h3 style="margin-bottom:5px;">Reporte de Visitas</h3>
				    		</td>
				    		<td>
				    			<div id="divHideRpt" style="margin-bottom:5px;"></div>
				    		</td>
				    		<td align="right">
				    		<div id="savefile" style="margin-bottom:5px;"></div>
				    		</td>
				    	</tr>
				    </table>
		    	</div>
				<div id='reportHolder'>
		        	<div id="report" style="border:1px solid #99bbe8;overflow: hidden; width: 100%; height: 400px;position:relative;left:0;top:0;"></div>
		        </div>
	    	</div></div></div>

	    	<div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>
		</div>

		

		<div id="reportFormFrame" style="width:100%;position:absolute;" class="x-box-blue">
		    <div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>
		    <div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc">

			    <div id="reportForm-title">
				    <table width="100%">
				    	<tr>
						    <td width="50%">
						    	<h3 style="margin-bottom:5px;">Reporte de Visitas</h3>
						    </td>
						    <td>
								<div id="divHideFrm" style="margin-bottom:5px;"></div>
							</td>
						</tr>
			    	</table>
				</div>

				<div id="report_form_div" style="border:1px solid #99bbe8;height:400px;"></div>

		    </div></div></div>
		    <div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>
		</div>


<script language="javascript">
	var htmlStartTime = "<?php echo createTimeComboJSArray('starttime')?>";
		var htmlEndTime = "<?php echo createTimeComboJSArray('endtime')?>";
			getForm(htmlStartTime,htmlEndTime,1);
		</script>

</body>
</html>

