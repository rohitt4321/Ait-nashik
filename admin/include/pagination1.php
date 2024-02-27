<?php

/**
 * @author Jooria Refresh Your Website <www.jooria.com>
 * @copyright 2010
 */

function Pages($tbl_name,$limit,$path,$connection,$pyear)
{
	$query ="SELECT COUNT(*) as num FROM $tbl_name WHERE pyear=$pyear";
	$qresult=mysqli_query($connection,$query);
	$row = mysqli_fetch_array($qresult);
	$total_pages = $row['num'];

	$adjacents = "2";

	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$page = ($page == 0 ? 1 : $page);

	if($page)
	$start = ($page - 1) * $limit;
	else
	$start = 0;

	$sql ="SELECT * FROM $tbl_name WHERE pyear=$pyear LIMIT $start, $limit";
	$result = mysqli_query($connection,$sql);

	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;

	$pagination = "";
if($lastpage > 1)
{   
	$pagination .= "<ul class='pagination'>";
if ($page > 1)
	$pagination.= "<li><a href='".$path."page=$prev' aria-label='Previous'> <span aria-hidden='true'>&laquo;</span></a></li>";
else
	$pagination.= "<li><span aria-hidden='true' class='disabled'>&laquo;</span></li>";   

if ($lastpage < 7 + ($adjacents * 2))
{   
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
	$pagination.= "<li class='active'><span class='current'>$counter</span></li>";
else
	$pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
}
}
elseif($lastpage > 5 + ($adjacents * 2))
{
if($page < 1 + ($adjacents * 2))       
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
	$pagination.= "<li><span class='current'>$counter</span></li>";
else
	$pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
}
	$pagination.= "...";
	$pagination.= "<li><a href='".$path."page=$lpm1'>$lpm1</a></li>";
	$pagination.= "<li><a href='".$path."page=$lastpage'>$lastpage</a></li>";       
}
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
	$pagination.= "<li><a href='".$path."page=1'>1</a></li>";
	$pagination.= "<li><a href='".$path."page=2'>2</a></li>";
	$pagination.= "...";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
	$pagination.= "<li><span class='current'>$counter</span></li>";
else
	$pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
}
	$pagination.= "..";
	$pagination.= "<li><a href='".$path."page=$lpm1'>$lpm1</a></li>";
	$pagination.= "<li><a href='".$path."page=$lastpage'>$lastpage</a></li>";       
}
else
{
	$pagination.= "<li><a href='".$path."page=1'>1</a></li>";
	$pagination.= "<li><a href='".$path."page=2'>2</a></li>";
	$pagination.= "..";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page)
	$pagination.= "<li><span class='current'>$counter</span></li>";
else
	$pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
}
}
}

if ($page < $counter - 1)
	$pagination.= "<li><a href='".$path."page=$next' aria-label='Next'> <span aria-hidden='true'>&raquo;</span></a></li>";
else
	$pagination.= "<li><span aria-hidden='true' class='disabled'>&raquo;</span></li>";
	$pagination.= "</ul>\n";       
}


return $pagination;
}


?>