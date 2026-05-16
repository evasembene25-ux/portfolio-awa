<?php require '../fonctions.php'; ?>
<?php require '../components/header.php'; ?>
<?php

$projets = [

    [
        "titre" => "Site AVA Senteur",
        "description" => "Plateforme e-commerce permettant la vente de parfums en ligne.",
        "image" => "../images/siteinternet.jpeg",
        "tech" => ["HTML", "CSS", "JavaScript"],
        "lien" => "ava-senteur.php"
    ],

    [
        "titre" => "Poubelle intelligente",
        "description" => "Système automatisé avec capteurs.",
        "image" => "../images/poubelle.jpeg",
        "tech" => ["Arduino"],
        "lien" => "poubelle-intelligente.php"
    ],

    [
        "titre" => "Système de sécurité",
        "description" => "Solution de surveillance intelligente avec RFID.",
        "image" => "../images/systemesecurite.jpeg",
        "tech" => ["Arduino"],
        "lien" => "systeme-securite.php"
    ],
    [
        "titre" => "Répertoire téléphonique",
        "description" => " Application permettant de gérer un répertoire téléphonique connecté à une base de données,
            avec ajout, suppression et recherche de contacts.",
        "image" => "../images/repertoire.jpeg",
        "tech" => ["Langage C", "MySQL"],
        "lien" => "repertoire-telephonique.php"
    ],
    [
        "titre" => "Réseau d'entreprise",
        "description" => "Configuration d'un réseau d'entreprise avec serveurs, postes clients et services réseau.",
        "image" => "../images/reseau_entreprise.jpeg",
        "tech" => ["Cisco"],
        "lien" => "reseau-entreprise.php"
    ],
    [
        "titre" => "Système de sécurité avancée",
        "description" => "Réalisation d’un scan réseau afin d’identifier les machines actives, les ports ouverts et les
            services vulnérables présents sur un réseau local.",
        "image" => "../images/securiteavance.36.jpeg",
        "tech" => ["linux"],
        "lien" => "securite-avancee.php"
    ]

];

$mot_cle = nettoyer($_GET['q'] ?? '');

$resultats = [];

if ($mot_cle !== '') {

    foreach ($projets as $projet) {

        if (
            stripos($projet['titre'], $mot_cle) !== false ||
            stripos($projet['description'], $mot_cle) !== false ||
            stripos(implode(' ', $projet['tech']), $mot_cle) !== false
        ) {
            $resultats[] = $projet;
        }
    }
} else {

    $resultats = $projets;
}

?>
<main>
    <form method="GET">

        <input
            type="text"
            name="q"
            placeholder="Rechercher un projet..."
            class="search"
            value="<?= $mot_cle ?>">

    </form>

    <section class="projects">

        <?php if (empty($resultats)) : ?>

            <p class="aucun-resultat">
                Aucun projet trouvé.
            </p>

        <?php else : ?>

            <?php foreach ($resultats as $projet) : ?>

                <article class="card">

                    <img src="<?= htmlspecialchars($projet['image']) ?>" alt="<?= htmlspecialchars($projet['titre']) ?>">

                    <h3><?= htmlspecialchars($projet['titre']) ?></h3>

                    <p><?= htmlspecialchars($projet['description']) ?></p>

                    <div class="tech">

                        <?php foreach ($projet['tech'] as $tech) : ?>

                            <span class="badge">
                                <?= htmlspecialchars($tech) ?>
                            </span>

                        <?php endforeach; ?>

                    </div>

                    <a href="<?= htmlspecialchars($projet['lien']) ?>" class="btn">
                        Voir le projet
                    </a>

                </article>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>
</main>
<footer class="footer">

    <div class="footer-container">
        <div class="footer-col">
            <h3>Awa Soré</h3>
            <p>Étudiante en génie logiciel et administration réseau passionnée par le développement web moderne.</p>
        </div>

        <div class="footer-col">
            <h3>Navigation</h3>
            <a href="../index.php">Accueil</a>
            <a href="projets.php">Projets</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="footer-col">
            <h3>Contact</h3>
            <a href="mailto:evasembene25@gmail.com">Email
            </a>
            <a href="tel:+221777686779">
                Téléphone
            </a>

        </div>

        <div class="footer-col">
            <h3>Réseaux</h3>
            <div class="socials">

                <a href="tel:+221777686779"><img src="../images/whatsapp.png"></a>
                <a href="https://linkedin.com/in/eva-sembene-84b6b9400"><img src="../images/linkedin.png"></a>
                <a href="https://github.com/evasembene25-ux"><img src="../images/githup.png"></a>
            </div>
        </div>

    </div>



</footer>

<?php require '../components/footer.php'; ?>