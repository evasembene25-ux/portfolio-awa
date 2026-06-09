<?php
require_once '../config/connexion.php';
require_once '../fonctions.php';
enregistrerVisite($pdo, 'Projets'); ?>
<?php require '../components/header.php'; ?>
<?php

$recherche = $_GET['recherche'] ?? '';

$sql = "SELECT * FROM projets";

if (!empty($recherche)) {
    $sql .= " WHERE titre LIKE ? OR description LIKE ? ";
}

$requete = $pdo->prepare($sql);

if (!empty($recherche)) {
    $motCle = "%" . $recherche . "%";
    $requete->execute([$motCle, $motCle]);
} else {
    $requete->execute();
}

$projets = $requete->fetchAll();

?>


<main>
    <form method="GET">

        <input
            type="text"
            name="recherche"
            placeholder="Rechercher un projet..."
            class="search"
            value="<?= htmlspecialchars($recherche) ?>">

    </form>

    <section class="projects">

        <?php if (empty($projets)) : ?>

            <p class="aucun-resultat">
                Aucun projet trouvé.
            </p>

        <?php else : ?>

            <?php foreach ($projets as $projet) : ?>

                <article class="card">

                    <img src="../images/<?= htmlspecialchars($projet['image']) ?>"
                        alt="<?= htmlspecialchars($projet['titre']) ?>">

                    <h3><?= htmlspecialchars($projet['titre']) ?></h3>

                    <p><?= htmlspecialchars($projet['description']) ?></p>

                    <div class="tech">

                        <?php
                        $technologies = explode(',', $projet['technologies']);

                        foreach ($technologies as $tech) :
                        ?>

                            <span class="badge">
                                <?= htmlspecialchars(trim($tech)) ?>
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