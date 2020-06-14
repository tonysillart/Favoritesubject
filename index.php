<?php
require 'connection.php';

$k=$_GET['k'];

if($k == null) {
    $query = "SELECT * FROM BMW";
} else {
    $query = "SELECT * FROM BMW LIMIT $k";
}

$BMW =
    [
        'info' => [
            'name' => 'Tony Sillart',
            'description' => 'BMW'
        ],
    ];

if ($result = $mysqli->query($query)) {
    while ($data = $result->fetch_array()) {
        $BMW['data'][] =
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $data['image'],
                'topic1'=> $data['Max_speed'],
                'topic2' => $data['Accelerate']
            ];
    }
    $result->close();
}

echo json_encode($BMW);