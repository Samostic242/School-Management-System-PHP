
<script type="text/javascript">
$(document).ready(function(){  
	
	
	$("#generated_voucher").click(function(){
		var class_id  = $("#class_id").val();
		var monthid   = $('#month_id').val();
		var yearid    = $('#year_id').val();			
		var yearmonth = monthid+"-"+yearid;
		var branchid  = $("#branchid").val();			
		var dataString = "yearmonth="+yearmonth+"&class_id="+class_id+"&branchid="+branchid;
		if(class_id=="")
		{
		  alert("Select Class");		  
		  return false;
		}else{
		  //alert(dataString);
			$("#generated_voucher_list").load("includes/generated_voucher_list_table.php" ,   
			{	'class_id' : class_id ,
				'yearmonth': yearmonth ,
				'branchid' : branchid
			},function(){  });
		}
    });	
	
});
</script>
<?php  require_once("../db.php"); session_start();

$branchid = $_SESSION['LOGIN_BRANCH']
 ?>
<input type="hidden" id="branchid" name="branchid" value="<?php echo $branchid;?>"/>
<div id="content" class="box">
       <fieldset>
		   <legend>Generate Vouchers </legend>
			  <table  border="0" cellpadding="0" cellspacing="0">
			    <tr>
                   <th valign="top">Pyament for :</th>
                     <td>
                 	 <select id="month_id" name="month_name" class="styledselect-year">
				 	 <option value="<?php  echo date('M'); ?>"><?php  echo date('M') ?> </option>
				 	 <option value="Jan">Jan</option>
				 	 <option value="Feb">Feb</option>
				 	 <option value="Mar">Mar</option>
				 	 <option value="Apr">Apr</option>
				 	 <option value="May">May</option>
				  	 <option value="Jun">Jun</option>
                 	 <option value="Jul">Jul</option>
				 	 <option value="Aug">Aug</option>
				  	 <option value="Sep">Sep</option>
				  	 <option value="Oct">Oct</option>
				  	 <option value="Nov">Nov</option>
				  	 <option value="Dec">Dec</option>
		    	  	 </select>
                     <?php
			   			 $year = date("Y");
						 $pre = $year - 10;
						 $next = $year + 10;
					 ?>
                     <select id="year_id" name="year_name" class="styledselect-year">
				     <option><?php  echo $year;  ?></option>
				     <?php
						for($i=$pre;$i<=$next;$i++)
					    {
						 echo "<option value=\"$i\">$i</option>";
						}
				 	 ?>
		   			 </select>
               		 </td>
            		 <td>
                     <div class="bubble-left"></div>
					 <div class="bubble-inner">Select class </div>
					 <div class="bubble-right"></div>
                     </td>	
               </tr>        
                <tr>	
                     <th>
                     Class Name:
                     </th> 
	                 <td>   
    		         <select id="class_id" name="class_id"  class="styledselect-normal" >
                   	 <option value="">select</option>
					 <?php 
					    $query = "select id,class_name from std_class_config where branch_id=$branchid";
						$qry = mysql_query($query); 
					    while ($row=mysql_fetch_array($qry)){
							echo "<option value=\"$row[0]\">$row[1] </option>";
                        }
					 ?>
					 </select>*
                     </td> 
					 <td>
					 <div class="error-left"></div>
					 <div class="error-inner"><p id="err_rep">This field is required.</p></div>
					 </td>	
                </tr>
				
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>				
				
				<tr>	
					<td></td>
                     <td>
					<input type="button" id="generated_voucher" class="form-submit"  value="Submit">
					</td>
				</tr>
				
				
		</table>	
	</fieldset>	
	
	
     <div id="generated_voucher_list"> </div>
    </div>
    <!-- /content -->