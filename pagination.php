<?
  
$page = isset($_GET["page"]) ? $_GET['page'] : 1;
$page = $page-1;
$post_per_page   = 10;
$offset = $page * $post_per_page;

if (isset($_GET["searchsubmit"])) {
    $search = $_GET["search"];
    $searchQuery  = " SELECT SQL_CALC_FOUND_ROWS * from books  where bookName  Like '%$search%'   OR   author Like '%$search%' OR   isbn Like '%$search%' limit $offset,$post_per_page";
}else{
    $searchQuery = "SELECT SQL_CALC_FOUND_ROWS  * from books limit $offset,$post_per_page";
}
$sQuery = mysql_query($searchQuery);

$count_result = mysql_fetch_object(mysql_query("SELECT FOUND_ROWS() as total"));
$count = $count_result->total;
$required_pages  = ceil($count/$post_per_page);
echo "<div class='nav'><ul>";
for ($i=1; $i <= $required_pages; $i++) { 
    $isActive = ( isset($_GET["page"])  &&  $_GET['page'] == $i) || ($page == $i-1 )   ? 'current': '';
    echo "<li class='".$isActive."'><a href='?page=".$i."' >".$i."</a></li>";
}
echo "</ul></div>";