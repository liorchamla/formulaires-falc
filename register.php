<?php

var_dump($_REQUEST);

try {
    $db = new PDO('mysql:host=localhost;dbname=formulaires;charset=utf8', 'liorchamla', '');
    
    $query = $db->prepare('INSERT INTO answers SET created_at = NOW(), content = :content, formulaire_id = :form_id');
    
    $resultat = $query->execute([
        ':content' => json_encode($_POST['answers']),
        ':form_id' => 1
    ]);
    if($resultat) echo json_encode(['status' => 'success']);
} catch(Exception $e){
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>
