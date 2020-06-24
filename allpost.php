<?php
include_once '../inc/dbconnected.php';

$sql = "SELECT * FROM `license` ORDER BY id_license DESC LIMIT 1";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
$star_license = $row['star_ license'];
$end_license = $row['end_ license'];

$dataTi = date("Y-m-d");
if($end_license < $dataTi) {

    $license->license = 'License expired';
    echo json_encode($license);


}else{

    $mysql = "SELECT movies.* , users.* FROM movies INNER JOIN users ON movies.userid = users.id ORDER BY `movies`.`mov_id` DESC  ";
    $result = $conn->query($mysql);

    if ($result->num_rows > 0) {

      $posts_array = [];

      return ['allpost' => $allpost];

      while($row = $result->fetch_array()) {

        $post_data = [
          'mov_id' => $row['mov_id'],
          'name_movies' => $row['name_movies'],
          'about' => html_entity_decode($row['about']),
          'category' => $row['category'],
          'year' => $row['year'],
          'img_name' => $row['img_name'],
          'imdb' => $row['imdb'],
          'data-time' => $row['data-time'],
          'full_name' => $row['full_name'],
          'id' => $row['id'],
          'vid_name' => $row['vid_name']

      ];

      array_push($posts_array, $post_data);

      }
    echo json_encode(['allpost' => $posts_array]);
    }
    else{
   
      echo json_encode(['message'=>'No post found']);
  }
}

?>
