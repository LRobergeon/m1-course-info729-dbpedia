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
                    <span class="category-title">
                        <h2>Types d'objets</h2>
                    </span>
                    <span class="category-content">
                    </span>
                </div>
                <div class="selection-facet">
                    <span class="category-title">
                        <h2>Facettes</h2>
                    </span>
                    <span class="category-content">
                        <?php if( !$isEmpty ): ?>
                            <ul>
                            <?php foreach( $types as $type ): ?>
                                <li>
                                    <?= $type ?>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <span>Graphe vide</span>
                        <?php endif; ?>
                    </span>
                </div>
            </section>
            <section class="column-main query">
                <div class="query-selected_facets">
                    <span class="category-title">
                        <h2>Vos filtres</h2>
                    </span>
                    <span class="category-content">
                        
                    </span>
                </div>
                <div class="query-result">
                    <span class="category-title">
                        <h2>Résultats</h2>
                    </span>
                    <span class="category-content">
                        
                    </span>
                </div>
            </section>
        </main>
        <footer>
            <p>
                2015 © Abdelmoumni - Rebillard - Ribard - Robergeon
            </p>
        </footer>
    </body>
</html>