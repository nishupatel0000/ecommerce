<?php
include_once '../common/config.php';
$request = $_REQUEST;
$columms = ['id','name','email','mobile'];
 
 
 
$searchValue = $request['search']['value'];
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " AND (name LIKE '%".$searchValue."%' OR username LIKE '%".$searchValue."%' OR email LIKE '%".$searchValue."%' OR password LIKE '%".$searchValue."%' OR mobileno LIKE '%".$searchValue."%' OR vehicle_no LIKE '%".$searchValue."%' OR vehicle_type LIKE '%".$searchValue."%') ";
}   
$sql = "SELECT COUNT(*) AS total FROM user WHERE 1 $searchQuery";
$result = mysqli_query($con_query,$sql);
$totalRecord = mysqli_fetch_array($result);
$totalRecord = $totalRecord['total'];
$start = $request['start'];
$length = $request['length'];
$orderColumn = $columms[$request['order'][0]['column']];
$orderDir = $request['order'][0]['dir'];

$sql = "SELECT * FROM user WHERE 1 $searchQuery ORDER BY $orderColumn $orderDir LIMIT $start, $length";
$data = mysqli_query($con_query,$sql);
$rows = [];
while ($row = $data->fetch_assoc()) {
    $rows[] = $row;
   
}
?>
 
<?php
$response = [
    "draw" => intval($request['draw']),
    "recordsTotal" => intval($totalRecord),
    "recordsFiltered" => intval($totalRecord),
    "data" => $rows,
    
];

echo json_encode($response);
 
?>