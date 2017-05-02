<nav class="level">
                            <?php if($question['type'] == 'gradiant') : $i = 0; ?>
                                <div class="level-item has-text-centered" data-key-code="49">
                                    <div>
                                        <p class="heading">Beaucoup</p>
                                        <p class="title"><i class="em em-smile"></i><br><span class="key"><?= ++$i ?></span> </p>
                                    </div>
                                </div>
                                <div class="level-item has-text-centered" data-key-code="50">
                                    <div>
                                        <p class="heading">Assez</p>
                                        <p class="title"><i class="em em-relieved"></i><br><span class="key"><?= ++$i ?></span> </p>
                                    </div>
                                </div>
                                <div class="level-item has-text-centered" data-key-code="51">
                                    <div>
                                        <p class="heading">Pas trop</p>
                                        <p class="title"><i class="em em-worried"></i><br><span class="key"><?= ++$i ?></span> </p>
                                    </div>
                                </div>
                                <div class="level-item has-text-centered" data-key-code="52">
                                    <div>
                                        <p class="heading">Pas du tout</p>
                                        <p class="title"><i class="em em-cry"></i><br><span class="key"><?= ++$i ?></span> </p>
                                    </div> 
                                </div>
                            <?php elseif($question['type'] == "custom") : ?>
                                <?php $code = 48; $i = 0; foreach($question['answers'] as $answer) : ?>
                                    <div class="level-item has-text-centered"  data-key-code="<?= ++$code ?>">
                                        <div>
                                            <p class="heading"><?= $answer['heading'] ?></p>
                                            <p class="title">
                                                <?php if($answer['title']['type'] == "img") : ?>
                                                    <img src="<?= $answer['title']['src'] ?>" /><br><span class="key"><?= ++$i ?></span> 
                                                <?php else: ?>
                                                    <?= $answer['title']['text'] ?><br><span class="key"><?= ++$i ?></span> 
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : $i = 0; ?>
                                <div class="level-item has-text-centered" data-key-code="49">
                                    <div>
                                        <p class="heading">Oui</p>
                                        <p class="title"><i class="em em-smile"></i><br><span class="key"><?= ++$i ?></span> </p>
                                    </div>
                                </div>
                                <div class="level-item has-text-centered" data-key-code="50">
                                    <div>
                                        <p class="heading">Non</p>
                                        <p class="title"><i class="em em-worried"></i><br><span class="key"><?= ++$i ?></span> </p>
                                    </div>
                                </div>
                                <div class="level-item has-text-centered" data-key-code="51">
                                    <div>
                                        <p class="heading">Je ne sais pas</p>
                                        <p class="title">
                                            <!--<i class="em em-confused"></i>-->
                                            <i class="em em-question"><br><span class="key"><?= ++$i ?></span> </i>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </nav>