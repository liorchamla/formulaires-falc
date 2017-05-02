<?php

require_once 'database.php';

try {
    $query = $db->prepare('INSERT INTO answers SET created_at = NOW(), content = :content, formulaire_id = :form_id, lastName = :nom, firstName = :prenom');
    
    $resultat = $query->execute([
        ':content' => json_encode($_POST['answers']),
        ':form_id' => 1,
        ':prenom' => $_REQUEST['prenom'],
        ':nom' => $_REQUEST['nom']
    ]);
    if($resultat) echo json_encode(['status' => 'success']);
} catch(Exception $e){
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>
