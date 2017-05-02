<?php

$db = new PDO('mysql:host=localhost;dbname=formulaires;charset=utf8','liorchamla','');

$reponses = $db->query('SELECT * FROM answers WHERE formulaire_id = 1')->fetchAll(PDO::FETCH_OBJ);

$questions = [];

foreach($reponses as &$reponse){
    $reponse->content = json_decode($reponse->content);
    foreach($reponse->content as $id => &$temp){
        $question = $db->query('SELECT id, phrase, color FROM questions WHERE id = ' . $id)->fetch(PDO::FETCH_OBJ);
        $final = [
            "question" => $question->phrase,
            "answer" => $temp
        ];
        
        if(array_key_exists($question->phrase, $questions)){
            $questions[$question->phrase]['answers'][$temp] += 1;
        } else {
            $questions[$question->phrase]['answers'] = [$temp => 1];
            $questions[$question->phrase]['color'] = $question->color;
        }
        
        $temp = $final;
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration des formulaires</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css" />
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <nav class="level">
            <!-- Left side -->
            <div class="level-left">
                <div class="level-item">
                  <p class="subtitle is-5">
                    <strong>Administration</strong> des formulaires
                  </p>
                </div>
            </div>

            <!-- Right side -->
            <div class="level-right">
                <p class="level-item"><a>Formulaires</a></p>
                <p class="level-item"><a class="button is-success">Nouveau</a></p>
            </div>
        </nav>
    </div>
    
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Administration des formulaires
                </h1>
                <h2 class="subtitle">
                    Formulaire : EPE 2017
                </h2>
            </div>
        </div>  
    </section>
    <div>&nbsp;</div>
    <div class="container">
        <?php $i = 0; foreach($questions as $phrase => $question) : ?>
            <?php if(($i % 2) === 0) : ?>
            <div class="columns">
            <?php endif; ?>
                <article class="message is-<?= $question['color'] ?> column is-half">
                    <div class="message-header">
                        <?= $phrase ?>
                    </div>
                    <div class="message-body">
                        <div id="question-<?= $i ?>" class="chart"></div>
                        
                        <script>
                            var chart<?= $i ?> = AmCharts.makeChart( "question-<?= $i ?>", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": [ 
                                    <?php foreach($question['answers'] as $answer => $count) : ?>
                                    {
                                        "title": "<?= $answer ?>",
                                        "value": <?= $count ?>
                                    },
                                    <?php endforeach; ?>
                                ],
                                "titleField": "title",
                                "valueField": "value",
                                "labelRadius": 5,
                                
                                "radius": "42%",
                                "innerRadius": "60%",
                                "labelText": "[[title]]"
                            });
                        </script>
                    </div>
                </article>
            <?php if($i % 2 != 0) : ?>
            </div>
            <?php endif; ?>
        <?php $i++; endforeach; ?>
    </div>
    <div>&nbsp;</div>
    </div>
    
    <footer class="footer">
      <div class="container">
        <div class="content has-text-centered">
          <p>
            Développé par <a href="http://web-develop.me">Lior Chamla</a> pour <strong>Hédi Ghanem</strong>
          </p>
        </div>
      </div>
    </footer>
</body>
</html>