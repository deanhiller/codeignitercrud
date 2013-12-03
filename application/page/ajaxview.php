<?php
include('ajxConfig.php');
	$data = '';
	$rec_start = $_POST['rec_start'];
		
		$sql1 = "SELECT * FROM userprofile where EmpSeqKey!=0";
		if($_POST['division']!='')
			$sql1.=" AND `Div` = '".$_POST['division']."'";
		if($_POST['department']!='')
			$sql1.=" AND `Dept` = '".$_POST['department']."'";
		if($_POST['facility']!='')
			$sql1.=" AND `Loc` = '".$_POST['facility']."'";
		if($_POST['adId']!='')
			$sql1.=" AND `ADName` = '".$_POST['adId']."'";
		if($_POST['hManager']!='')
			$sql1.=" AND `Sup` = '".$_POST['hManager']."'";
		
		if($_POST['stat']!='')
		{
			$status=explode(",",$_POST["stat"]);
			$sql1.=" AND (";
			for($s=0; $s<count($status)-1; $s++)
			{
				if($s==0)
					$sql1.=" `Estatus` = '".$status[$s]."' ";
				else
					$sql1.=" OR `Estatus` = '".$status[$s]."' ";
			}
			$sql1.=")";
		}
		if($_POST['type']!='')
		{
			$type=explode(",",$_POST["type"]);
			$sql1.=" AND (";
			for($t=0; $t<count($type)-1; $t++)
			{
				if($t==0)
					$sql1.=" `Jtype` = '".$type[$t]."' ";
				else
					$sql1.=" OR `Jtype` = '".$type[$t]."' ";
			}
			$sql1.=")";
		}
		if($_POST['sDate']!='' && $_POST['eDate']!='')
			$sql1.=" AND (`Hdate` BETWEEN '" . $_POST['sDate'] . "' and '" . $_POST['eDate'] . "')";
		if($_POST['fName']!='')
			$sql1.=" AND `Fname` LIKE '%".$_POST['fName']."%'";
		if($_POST['lName']!='')
			$sql1.=" AND `Lname` LIKE '%".$_POST['lName']."%'";
	
		$q1 = mysql_query($sql1,$link);
		$row_count = mysql_num_rows($q1);
	
	if($_POST['rec_per_page']!='All')
		$t_rec_per_page= $_POST['rec_per_page'];
    else
	    $t_rec_per_page= $row_count;
		
		$lstrec = $row_count % $t_rec_per_page;
		if ($lstrec == 0)
		{
			$lstrec = $row_count - 1;
		}
		else
		{
			$lstrec = $row_count;
		}
		if($rec_start >= $row_count)
		{
			$rec_start=$rec_start - $t_rec_per_page;
			if($rec_start < 0)
				$rec_start = 0;	
		}
		$rstart = $rec_start + 1;
		$rend = $rec_start + $t_rec_per_page;
		if ($rend > $row_count)
		{
			$rend = $row_count;
		}
		$rtot = $row_count;	   
	  
	   $sql2="SELECT * FROM userprofile where EmpSeqKey!=0";
		if($_POST['division']!='')
			$sql2.=" AND `Div` = '".$_POST['division']."'";
		if($_POST['department']!='')
			$sql2.=" AND `Dept` = '".$_POST['department']."'";
		if($_POST['facility']!='')
			$sql2.=" AND `Loc` = '".$_POST['facility']."'";
		if($_POST['adId']!='')
			$sql2.=" AND `ADName` = '".$_POST['adId']."'";
		if($_POST['hManager']!='')
			$sql2.=" AND `Sup` = '".$_POST['hManager']."'";
			
		if($_POST['stat']!='')
		{
			$status=explode(",",$_POST["stat"]);
			$sql2.=" AND (";
			for($s=0; $s<count($status)-1; $s++)
			{
				if($s==0)
					$sql2.=" `Estatus` = '".$status[$s]."' ";
				else
					$sql2.=" OR `Estatus` = '".$status[$s]."' ";
			}
			$sql2.=")";
		}	
		if($_POST['type']!='')
		{
			$type=explode(",",$_POST["type"]);
			$sql2.=" AND (";
			for($t=0; $t<count($type)-1; $t++)
			{
				if($t==0)
					$sql2.=" `Jtype` = '".$type[$t]."' ";
				else
					$sql2.=" OR `Jtype` = '".$type[$t]."' ";
			}
			$sql2.=")";
		}	
		if($_POST['sDate']!='' && $_POST['eDate']!='')
			$sql2.=" AND (`Hdate` BETWEEN '" . $_POST['sDate'] . "' and '" . $_POST['eDate'] . "')";
		if($_POST['fName']!='')
			$sql2.=" AND `Fname` LIKE '%".$_POST['fName']."%'";
		if($_POST['lName']!='')
			$sql2.=" AND `Lname` LIKE '%".$_POST['lName']."%'";
	   
	   if($_POST['rec_per_page']!='All')
	    $sql2.=" ORDER BY Lname ASC LIMIT " . $rec_start . " , " . $t_rec_per_page;
	   else
	   	$sql2.=" ORDER BY Lname ASC";
	   
	   
			$q2 = mysql_query($sql2,$link);

        // data result
		if($rtot > 0)
		{
			$data='<div class="Sarbox">';
				$data.='<div class="Searhover" id="userGrid">';
					$data.='<div style="width:1300px;">';
						$data.='<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ListTable">';
							$data.='<tr>'.
										'<th width="150px">Last Name</th>'.
										'<th width="150px">First Name</th>'.
										'<th width="100px">A/D Id</th>'.
										'<th width="90px">Request Date</th>'.
										'<th width="90px">Division</th>'.
										'<th width="90px">Department</th>'.
										'<th width="90px">Facility</th>'.
										'<th width="100px">Manager</th>'.
										'<th width="80px">Status</th>'.
										'<th width="80px">Type</th>'.
										'<th width="280px">Title</th>'.
								  '</tr>';
							$k=1;
						  while($row = mysql_fetch_array($q2))
						  {
						  $r=$k%2;
						  $c='';
						  if($r!=0)
						  	$c='class="oddRow"';
							
						  if($_POST['empId']==$row["EmpSeqKey"])
						  	$c='class="list_selected"';
							
							$data.='<tr '.$c.' onclick="onSelRow('.$row["EmpSeqKey"].','.$k.');" id="tr_'.$k.'" >'.
										'<td  id="td_'.$k.'"  class="col_selected">'.$row["Lname"].'</td>'.
										'<td>'.$row["Fname"].'</td>'.
										'<td>';
										if($row["ADName"]!="") 
										{ 
										$data.=$row["ADName"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Hdate"]!="") 
										{ 
										$data.=$row["Hdate"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Div"]!="") 
										{ 
										$data.=$row["Div"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Dept"]!="") 
										{ 
										$data.=$row["Dept"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Loc"]!="") 
										{ 
										$data.=$row["Loc"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Sup"]!="") 
										{ 
										$data.=$row["Sup"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Estatus"]!="") 
										{ 
										$data.=$row["Estatus"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Jtype"]!="") 
										{ 
										$data.=$row["Jtype"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
										'<td>';
										if($row["Title"]!="") 
										{ 
										$data.=$row["Title"]; 
										} 
										else 
										{
										$data.='-';
										}
								$data.='</td>'.
								   '</tr>';
							$k++;
						  }
							  
						$data.='<input type="hidden" id="rec" name="rec" value="'.$k.'"/></table>';
					$data.='</div>';
				$data.='</div>';
			$data.='</div>';
		
		$data.='<div class="Nextbut">';
			$data.='<div class="zoom_but padt5">Record Per Page</div>';
			$data.='<div class="left padr10">'.
						'<Select class="Selectinpu" style="height:24px;" id="rec_per" name="rec_per" onchange="ajxNoPage();" >'.
							'<option value="25" ';
							if($_POST['rec_per_page']=='25') 
							{ 
							$data.='selected="selected" '; 
							} 
							$data.='>25</option>'.
							'<option value="50" ';
							if($_POST['rec_per_page']=='50') 
							{ 
							$data.='selected="selected" '; 
							} 
							$data.='>50</option>'.
							'<option value="100" ';
							if($_POST['rec_per_page']=='100') 
							{ 
							$data.='selected="selected" '; 
							} 
							$data.='>100</option>'.
							'<option value="All" ';
							if($_POST['rec_per_page']=='All') 
							{ 
							$data.='selected="selected" '; 
							} 
							$data.='>All</option>'.
						'</Select>'.
					'</div>';
			$data.='<div class="left padr5">';
					if($rec_start != 0) 
					{ 
						$start=0;
						$data.='<a href="javascript:void(0);" onclick="ajxSearch('.$start.');"><img src="images/prev-1.jpg" alt="" /></a>';
					}
					else
					{
						$data.='<img src="images/prev-1.jpg" alt="" />';
					}
			$data.='</div>';
			$data.='<div class="left padr5">';
					if($rec_start != 0) 
					{ 
						$start=$rec_start - $t_rec_per_page;
						$data.='<a href="javascript:void(0);" onclick="ajxSearch('.$start.');"><img src="images/prev.jpg" alt="" /></a>';
					}
					else
					{
						$data.='<img src="images/prev.jpg" alt="" />';
					}
			$data.='<input type="hidden" id="rec_start" name="rec_start" value="'.$rec_start.'"/></div>';
			$data.='<div class="left padr5 padt5">Page</div>';
            
			$listpages = 8;
            $listhalf = $listpages/2;
            
            $rmndr = $row_count % $t_rec_per_page;
            
            $totpage = (int)($row_count/$t_rec_per_page);
            if($rmndr > 0)
            {
                $totpage = $totpage + 1;
            }
            
            $stpage = 1;
            
            $cpage = ($rec_start + $t_rec_per_page) / $t_rec_per_page;
            if ($cpage - $listhalf <= 1)
            {
                $stpage = 1;
            }
            else
            {
                if ($cpage + $listhalf > $totpage)
                {
                    $balpage = $totpage - $cpage;
                    if ($cpage - ($listpages - $balpage) <= 1)
                    {
                        $stpage = 1;
                    }
                    else
                    {
                        $stpage = $cpage - ($listpages - $balpage);
                    }
                }
                else
                {
                    $stpage = $cpage - $listhalf;
                }
            }
            
            $endpage = $stpage + $listpages;
            if ($totpage < $endpage)
            {
                $endpage = $totpage;
            }
            $page_now = 0;
			for($i=$stpage;$i<=$endpage;$i++)
            {
				if ($rstart == ($i * $t_rec_per_page) - $t_rec_per_page + 1)
				{
					$page_now = $i;
				}
			}
			
			
			$data.='<div class="left padr5"><input type="text" id="pno" name="pno" class="Selectinpu" readonly="true" value="'.$page_now.'"/></div>';
			$data.='<div class="left padr5 padt5">off-'.$totpage.'</div>';
			$data.='<div class="left padr5">';
					if($row_count > $rec_start + $t_rec_per_page) 
					{ 
						$start=$rec_start + $t_rec_per_page;
						$data.='<a href="javascript:void(0);" onclick="ajxSearch('.$start.');"><img src="images/next.jpg" alt="" /></a>';
					}
					else
					{
						$data.='<img src="images/next.jpg" alt="" />';
					}
			$data.='</div>';
			$data.='<div class="left padr10">';
					if($row_count > $rec_start + $t_rec_per_page) 
					{ 
						$start=(((int)($lstrec/$t_rec_per_page))*$t_rec_per_page);
						$data.='<a href="javascript:void(0);" onclick="ajxSearch('.$start.');"><img src="images/next-1.jpg" alt="" /></a>';
					}
					else
					{
						$data.='<img src="images/next-1.jpg" alt="" />';
					}
			$data.='</div>';
			$data.='<div class="left padr10"><a href="index.php"><img src="images/referace.jpg" alt="" /></a></div>';
			$data.='<div class="left padt5">Displaying '.$rstart.' to '.$rend.' of '.$rtot.' users</div>';
		$data.='</div>';
		}
		else
		{
		$data='<div style="width:880px; font-size:12px; color:#999999; padding:10px; float:left;" align="center">No Record Found<input type="hidden" id="rec_per" name="rec_per" value="'.$_POST['rec_per_page'].'"/></div>';
		}
	   echo $data;
?>