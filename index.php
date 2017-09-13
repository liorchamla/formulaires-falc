<?php


require_once('database.php');



$questions = $db->query('SELECT * FROM questions WHERE form_id = 1 ORDER BY ordre ASC')->fetchAll(PDO::FETCH_ASSOC);

foreach($questions as &$question){
    $question['image'] = json_decode($question['image'], true);
    if($question['type'] == "custom"){
        $question['answers'] = json_decode($question['custom'], true);
    }
}


// $questions = [
//     ["id" => 12,"phrase" => "Je suis bien dans mon atelier", "type" => "duo", "color" => "primary"],
//     ["id" => 13,"phrase" => "Je veux faire des soutiens", "type" => "custom", "color" => "success", "answers" => [
//         ["value" => "Pour le travail", "heading" => "Pour le travail", "title" => ["type" => "img", "src" => ["img/travail-2.jpg"]]],
//         ["value" => "Pour ma santé", "heading" => "Pour ma santé", "title" => ["type" => "img", "src" => ["img/sante-2.png"]]],
//         ["value" => "Pour mon quotidien", "heading" => "Pour mon quotidien", "title" => ["type" => "img", "src" => ["img/quotidien.png"]]]
//     ]],
//     ["id" => 14,"phrase" => "J'aimerais être dans cet atelier", "type" => "custom", "color" => "primary", "images" => ["img/choix.png"], "answers" => [
//         ["value" => "Préparation de commande", "heading" => "Logistique <br> préparation de commande", "title" => ["type" => "img", "src" => ["img/logistique-preparation.png", "img/quotidien.png"]]],
//         ["value" => "Montage", "heading" => "Logistique <br> montage", "title" => ["type" => "img", "src" => ["img/logistique-montage.png"]]]
//     ]],
//     ["id" => 15,"phrase" => "C'était bien cette année dans l'atelier ?", "type" => "duo", "color" => "success"],
//     ["id" => 16,"phrase" => "Quand je ne sais pas faire, je demande de l'aide", "type" => "duo", "color" => "primary", "image" => ["img/aide.png", "img/quotidien.png"]],
//     ["id" => 17,"phrase" => "Je suis content de l'aide du moniteur ?", "type" => "duo", "color" => "info", "image" => ["img/aide.png"]],
//     ["id" => 18,"phrase" => "Je comprend mon travail", "type" => "duo", "color" => "primary", "image" => ["img/travail-2.jpg"]],
// ];

// foreach($questions as $question){
//     var_dump(json_encode($question));
// }
// die();
    
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Formulaire FALC</title>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollify/1.0.14/jquery.scrollify.min.js"></script>
        <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css" />
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div id="progress-bar">
            <div id="progress-bar-state"></div>
        </div>
        <section data-section-name="welcome" class="section page hero is-success is-bold is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        Bienvenue dans ce formulaire d'entretien ! <i class="em em-smile"></i>
                    </h1>
                    <a href="#!" id="btn-voice" class="button is-primary is-large is-inverted"><span>Activer la voix</span>&nbsp;<i class="fa fa-volume-up"></i></a>
                    <a href="#!" class="button is-success next is-large is-inverted">Commencer &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            
        </section>
        <form action="register.php" method="post" id="form">
            <?php foreach($questions as $index => &$question) : ?>
                <section data-section-name="question-<?= $index ?>" id="section-<?= $index ?>" class="section page hero is-<?= $question['color'] ?> is-bold is-fullheight">
                    <input type="hidden" class="answer" name="answers[<?= $question['id'] ?>]" value="" id="question-<?= $index ?>">
                    <div class="text-to-speach">
                        <?= $question['phrase'] ?>, Répondez par :
                        <?php if($question['type'] == 'gradiant'): ?>
                            Beaucoup ..., Assez ..., Pas trop ..., ou ..., Pas du tout
                        <?php elseif($question['type'] == 'duo'): ?>
                            Oui ..., Non ..., ou ..., Je ne sais pas
                        <?php elseif($question['type'] == 'custom'): ?>
                            <?php
                                $phrase = array_map(function($element){
                                    return strtoupper($element['heading']);
                                }, $question['answers']);
                                $dernierChoix = array_pop($phrase);
                                $premiersChoix = join(' ..., ', $phrase);
                                $phraseComplete = $premiersChoix . "... ou ..., " . $dernierChoix;
                            ?>
                            <?= $phraseComplete ?>
                        <?php endif; ?>
                    </div>
                    <div class="hero-body">
                        <div class="container has-text-centered">
                            <h1 class="title">
                                <?= $question['phrase'] ?> <a class="read button is-info is-small" onclick="readWithVoice('section-' + <?= $index ?>);">Lire</a>
                            </h1>
                            <?php if(!empty($question['image'])) : ?>
                                <?php foreach($question['image'] as $src): ?>
                                    <img src="<?= $src ?>">
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div>&nbsp;</div>
                            <div class="columns">
                                <?php if($question['type'] == 'gradiant') : $i = 0; ?>
                                    <div class="column" data-key-code="49">
                                        <div>
                                            <p class="heading">Beaucoup</p>
                                            <p class="title"><i class="em em-smile"></i><br><span class="key"><?= ++$i ?></span> </p>
                                        </div>
                                        <input type="hidden" value="Beaucoup">
                                    </div>
                                    <div class="column" data-key-code="50">
                                        <div>
                                            <p class="heading">Assez</p>
                                            <p class="title"><i class="em em-relieved"></i><br><span class="key"><?= ++$i ?></span> </p>
                                        </div>
                                        <input type="hidden" value="Assez">
                                    </div>
                                    <div class="column" data-key-code="51">
                                        <div>
                                            <p class="heading">Pas trop</p>
                                            <p class="title"><i class="em em-worried"></i><br><span class="key"><?= ++$i ?></span> </p>
                                        </div>
                                        <input type="hidden" value="Pas trop">
                                    </div>
                                    <div class="column" data-key-code="52">
                                        <div>
                                            <p class="heading">Pas du tout</p>
                                            <p class="title"><i class="em em-cry"></i><br><span class="key"><?= ++$i ?></span> </p>
                                        </div> 
                                        <input type="hidden" value="Pas du tout">
                                    </div>
                                <?php elseif($question['type'] == "custom") : ?>
                                    <?php $code = 48; $i = 0; foreach($question['answers'] as $answer) : ?>
                                        <div class="column has-text-centered"  data-key-code="<?= ++$code ?>">
                                            <div>
                                                <p class="heading"><?= $answer['heading'] ?></p>
                                                <p class="title">
                                                    <?php if($answer['title']['type'] == "img") : ?>
                                                        <?php foreach($answer['title']['src'] as $src): ?>
                                                            <img src="<?= $src ?>" />
                                                        <?php endforeach; ?>
                                                        <br><span class="key"><?= ++$i ?></span> 
                                                    <?php else: ?>
                                                        <?= $answer['title']['text'] ?><br><span class="key"><?= ++$i ?></span> 
                                                    <?php endif; ?>
                                                </p>
                                                <input type="hidden" value="<?= $answer['heading'] ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : $i = 0; ?>
                                    <div class="column" data-key-code="49">
                                        <div>
                                            <p class="heading">Oui</p>
                                            <p class="title"><i class="em em-smile"></i><br><span class="key"><?= ++$i ?></span> </p>
                                        </div>
                                        <input type="hidden" value="Oui">
                                    </div>
                                    <div class="column" data-key-code="50">
                                        <div>
                                            <p class="heading">Non</p>
                                            <p class="title"><i class="em em-worried"></i><br><span class="key"><?= ++$i ?></span> </p>
                                        </div>
                                        <input type="hidden" value="Non">
                                    </div>
                                    <div class="column" data-key-code="51">
                                        <div>
                                            <p class="heading">Je ne sais pas</p>
                                            <p class="title">
                                                <!--<i class="em em-confused"></i>-->
                                                <i class="em em-question"></i><br><span class="key"><?= ++$i ?></span> 
                                            </p>
                                        </div>
                                        <input type="hidden" value="Je ne sais pas">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endforeach; ?>
            <section data-section-name="form-end" class="end section page hero is-success is-bold is-fullheight">
                <div class="hero-body">
                    <div class="container has-text-centered">
                        <h1 class="title">
                            Merci ! Vous pouvez maintenant enregistrer vos réponses !
                        </h1>
                        <div class="columns">
                            <div class="column is-half is-offset-one-quarter">
                                <div class="field">
                                    <input type="text" name="prenom" required class="input is-large" placeholder="Prenom">
                                </div>
                                <div class="field">
                                    <input type="text" name="nom" required class="input is-large" placeholder="Nom">
                                </div>
                                <button type="submit" id="btn-submit" class="button is-info is-large"><i class="fa fa-send"></i>&nbsp;Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <script src="js/app.js"></script>
    </body>
</html>