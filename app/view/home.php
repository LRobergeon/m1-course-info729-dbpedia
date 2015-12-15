<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">
        
        <title>INFO729 - TP DBpedia</title>
        
        <!--Stylesheets-->
        <link rel="stylesheet" href="/stylesheet/style.css" type="text/css" />
    </head>
    
    <body class="info729_dbpedia">
        <header>
            <nav>
                <a href="/">
                    <img src="/asset/image/DBpediaLogo.svg" alt="Logo DBpedia"/>
                </a>
            </nav>
        </header>
        <main>
            <section class="column-left selection">
                <div class="selection-item_type">
                    <div class="category-title">
                        <h2>Types d'objets</h2>
                    </div>
                    <div class="category-content">
                    </div>
                </div>
                <div class="selection-facet">
                    <div class="category-title">
                        <h2>Facettes</h2>
                    </div>
                    <div class="category-content">
                        <form action="/query" method="GET">
                            <div class="departements">
                                <label for="input_departments">Départements</label>
                                <select id="input_departments" name="dpt">
                                    <?php foreach( $liste_villes as $ville ): ?>
                                        <option value="<?= current( array_keys( $ville ) ) ?>">
                                            <?= $ville[ current( array_keys( $ville ) ) ] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="nb_inhabitant">
                                <label for="input_nb_inhabitant">Nombre d'habitants</label>
                                <input type="number" id="input_nb_inhabitant" min="<?= $default_form_value['pop_min'] ?>" name="pop" placeholder="Nombre d'habitants" value="<?= $default_form_value['pop_min'] ?>" />
                            </div>
                            <div class="languages">
                                <label for="input_languages">Langue d'affichage</label>
                                <select id="input_languages" name="lang">
                                    <?php if( !empty( $default_form_value['default_lang'] ) && in_array( $default_form_value['default_lang'], $langues ) ): ?>
                                        <option value="<?= $default_form_value['default_lang'] ?>">
                                            <?= $default_form_value['default_lang'] ?>
                                        </option>
                                    <?php foreach (array_keys($langues, $default_form_value['default_lang']) as $key): ?>
                                        <?php unset($langues[$key]); ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php foreach( $langues as $langue ): ?>
                                        <option value="<?= $langue ?>">
                                            <?= $langue ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <input type="submit" value="Rechercher" />
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section class="column-main query">
                <div class="query-selected_facets">
                    <div class="category-title">
                        <h2>Vos filtres</h2>
                        <?php if( isset( $selected_filters ) ): ?>
                        <div class="query-redo">
                            <form action="/query" method="GET">
                            <?php foreach( $selected_filters as $filter => $value ): ?>
                                <input type="hidden" name="<?= $filter ?>" value="<?= $value ?>"/>
                            <?php endforeach; ?>
                                <input type="submit" value="Refaire la recherche" />
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="category-content">
                        <?php if( isset( $selected_filters ) ): ?>
                        <div class="filters">
                            <ul class="selected_filters">
                            <?php foreach( $selected_filters as $filter => $value ): ?>
                                <li title="<?= $filter ?>" name="<?= $filter ?>">
                                    <?= $value ?>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <span>Aucun filtre sélectionné</span>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="query-result">
                    <div class="category-title">
                        <h2>Résultats</h2>
                        <?php if( !$isEmpty ): ?>
                            <span><?= count($villes) ?> résultat(s)</span>
                        <?php else: ?>
                            <span>Aucun résultat disponible pour cette recherche</span>
                        <?php endif; ?>
                    </div>
                    <div class="category-content">
                        <?php if( !$isEmpty ): ?>
                            <ul class="cities">
                            <?php foreach( $villes as $ville ): ?>
                                <li class="city">
                                    <div class="city-information">
                                        <h3><?= $ville['nom'] ?></h3>
                                        <div class="city-information--population">
                                            <label>Population : </label>
                                            <span><?= $ville['population'] ?></span>
                                        </div>
                                    </div>
                                    <div class="city-comment">
                                        <p>
                                            <?= nl2br( $ville['comment'] ) ?>
                                        </p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <span>Graphe vide</span>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <p>
                15/12/2015 © Abdelmoumni - Rebillard - Ribard - Robergeon
            </p>
        </footer>
    </body>
</html>