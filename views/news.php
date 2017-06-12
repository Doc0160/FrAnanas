<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?php echo fake::text('item'); ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="head">
            <div class="headerobjectswrapper">
                <header><?php echo fake::text('item'); ?></header>
            </div>

            <div class="subhead"><?php echo fake::text('city'); ?> - <?php echo fake::text('date'); ?> - <?php echo fake::text('word'); ?> <?php echo fake::text('word'); ?></div>
        </div>
        <div class="content">
            <div class="collumns">
                <div class="collumn">
                    <div class="head">
                        <span class="headline hl3"><?php echo fake::text('headline'); ?></span>
                        <?php if(fake::luck('50%')) { ?>
                            <p><span class="headline hl4">by <?php echo fake::text('author'); ?></span></p>
                        <?php } else { ?>
                            <p><span class="headline hl4"><?php echo fake::text('headline'); ?></span></p>
                        <?php } ?>
                    </div>
                    <?php while(fake::luck('1-5')) { ?>
                        <p><?php echo fake::text('paragraph'); ?></p>
                        <?php if(fake::luck('25%')) { ?>
                            <figure class="figure">
						        <img class="media" src="<?php echo fake::image('landscape'); ?>" alt="">
						        <figcaption class="figcaption"><?php echo fake::text('short-teaser'); ?></figcaption>
					        </figure>
                        <?php } ?>
                    <?php } ?>
                    
                    <div class="head">
                        <span class="headline hl3"><?php echo fake::text('headline'); ?></span>
                        <?php if(fake::luck('50%')) { ?>
                            <p><span class="headline hl4">by <?php echo fake::text('author'); ?></span></p>
                        <?php } else { ?>
                            <p><span class="headline hl4"><?php echo fake::text('headline'); ?></span></p>
                        <?php } ?>
                    </div>
                    <?php while(fake::luck('1-5')) { ?>
                        <p><?php echo fake::text('paragraph'); ?></p>
                        <?php if(fake::luck('25%')) { ?>
                            <figure class="figure">
						        <img class="media" src="<?php echo fake::image('landscape'); ?>" alt="">
						        <figcaption class="figcaption"><?php echo fake::text('short-teaser'); ?></figcaption>
					        </figure>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="collumn">
                    <div class="head">
                        <span class="headline hl5"><?php echo fake::text('headline'); ?></span>
                        <?php if(fake::luck('50%')) { ?>
                            <p><span class="headline hl4">by <?php echo fake::text('author'); ?></span></p>
                        <?php } else { ?>
                            <p><span class="headline hl4"><?php echo fake::text('headline'); ?></span></p>
                        <?php } ?>
                    </div>
                    <?php while(fake::luck('1-5')) { ?>
                        <p><?php echo fake::text('paragraph'); ?></p>
                        <?php if(fake::luck('25%')) { ?>
                            <figure class="figure">
						        <img class="media" src="<?php echo fake::image('landscape'); ?>" alt="">
						        <figcaption class="figcaption"><?php echo fake::text('short-teaser'); ?></figcaption>
					        </figure>
                        <?php } ?>
                    <?php } ?>
                    
                    <div class="head">
                        <span class="headline hl5"><?php echo fake::text('headline'); ?></span>
                        <?php if(fake::luck('50%')) { ?>
                            <p><span class="headline hl4">by <?php echo fake::text('author'); ?></span></p>
                        <?php } else { ?>
                            <p><span class="headline hl4"><?php echo fake::text('headline'); ?></span></p>
                        <?php } ?>
                    </div>
                    <?php while(fake::luck('1-5')) { ?>
                        <p><?php echo fake::text('paragraph'); ?></p>
                        <?php if(fake::luck('25%')) { ?>
                            <figure class="figure">
						        <img class="media" src="<?php echo fake::image('landscape'); ?>" alt="">
						        <figcaption class="figcaption"><?php echo fake::text('short-teaser'); ?></figcaption>
					        </figure>
                        <?php } ?>
                    <?php } ?>
                </div>
                
                <div class="collumn">
                    <div class="head">
                        <span class="headline hl5"><?php echo fake::text('headline'); ?></span>
                        <?php if(fake::luck('50%')) { ?>
                            <p><span class="headline hl4">by <?php echo fake::text('author'); ?></span></p>
                        <?php } else { ?>
                            <p><span class="headline hl4"><?php echo fake::text('headline'); ?></span></p>
                        <?php } ?>
                    </div>
                    <?php while(fake::luck('1-5')) { ?>
                        <p><?php echo fake::text('paragraph'); ?></p>
                        <?php if(fake::luck('25%')) { ?>
                            <figure class="figure">
						        <img class="media" src="<?php echo fake::image('landscape'); ?>" alt="">
						        <figcaption class="figcaption"><?php echo fake::text('short-teaser'); ?></figcaption>
					        </figure>
                        <?php } ?>
                    <?php } ?>

                    <div class="head">
                        <span class="headline hl5"><?php echo fake::text('headline'); ?></span>
                        <?php if(fake::luck('50%')) { ?>
                            <p><span class="headline hl4">by <?php echo fake::text('author'); ?></span></p>
                        <?php } else { ?>
                            <p><span class="headline hl4"><?php echo fake::text('headline'); ?></span></p>
                        <?php } ?>
                    </div>
                    <?php while(fake::luck('1-5')) { ?>
                        <p><?php echo fake::text('paragraph'); ?></p>
                        <?php if(fake::luck('25%')) { ?>
                            <figure class="figure">
						        <img class="media" src="<?php echo fake::image('landscape'); ?>" alt="">
						        <figcaption class="figcaption"><?php echo fake::text('short-teaser'); ?></figcaption>
					        </figure>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>
