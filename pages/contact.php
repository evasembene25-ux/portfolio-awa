<?php
session_start();
require_once '../config/connexion.php';
require_once '../fonctions.php';
enregistrerVisite($pdo, 'Contact');
require '../components/header.php';

?>
<?php

$nom = "";
$email = "";
$message = "";
$type_projet = "";
$description = "";

$erreurs = [];
$demande = [];
$success_projet = false;
$csrf = genererCSRF();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verifierCSRF($_POST['csrf'] ?? '')) {
        die("Jeton CSRF invalide");
    }
    $formulaire = $_POST['formulaire'] ?? '';
    $nom = nettoyer($_POST["nom"] ?? '');
    $email = nettoyer($_POST["email"] ?? '');

    if ($formulaire === 'contact') {

        $message = nettoyer($_POST['message'] ?? '');

        if (!champ_requis($nom)) {
            $erreurs[] = "Le nom est obligatoire";
        }

        if (!champ_requis($email)) {
            $erreurs[] = "L'email est obligatoire";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "Email invalide";
        }

        if (!champ_requis($message)) {
            $erreurs[] = "Le message est obligatoire";
        }
    }

    if ($formulaire === 'projet') {

        $type_projet = nettoyer($_POST['type_projet'] ?? '');
        $description = nettoyer($_POST['description'] ?? '');

        if (!champ_requis($nom)) {
            $erreurs[] = "Le nom est obligatoire";
        }

        if (!champ_requis($email)) {
            $erreurs[] = "L'email est obligatoire";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "Email invalide";
        }

        if (!champ_requis($type_projet)) {
            $erreurs[] = "Le type de projet est obligatoire";
        }

        if (!champ_requis($description)) {
            $erreurs[] = "La description est obligatoire";
        }
    }

    if (empty($erreurs)) {

        if ($formulaire === 'contact') {

            $sql = "INSERT INTO messages_contact
                (nom, email, message)
                VALUES (?, ?, ?)";

            $requete = $pdo->prepare($sql);

            $requete->execute([
                $nom,
                $email,
                $message
            ]);

            $success = "Message envoyé avec succès.";
        }

        if ($formulaire === 'projet') {

            $sql = "INSERT INTO demandes_projet
                (nom, email, type_projet, description)
                VALUES (?, ?, ?, ?)";

            $requete = $pdo->prepare($sql);

            $requete->execute([
                $nom,
                $email,
                $type_projet,
                $description
            ]);
            $demande = [
                "nom" => $nom,
                "email" => $email,
                "type_projet" => $type_projet,
                "description" => $description
            ];

            $success_projet = true;
            $message_projet = "Votre demande de projet a été envoyée avec succès.";
        }
    }
}
?>
<?php if (!empty($erreurs)) : ?>
    <div class="erreurs">
        <?php foreach ($erreurs as $erreur) : ?>
            <p><?= htmlspecialchars($erreur) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>



<section class="contact-premium">

    <div class="contact-header">
        <h2>Travaillons ensemble</h2>
        <p>
            Vous avez un projet ou une idée ? N’hésitez pas à me contacter, je serai ravie d’échanger avec vous.
        </p>
    </div>

    <div class="contact-grid">

        <!-- CONTACT SIMPLE -->
        <div class="contact-box">
            <h3>Contact rapide</h3>

            <form method="POST">
                <input type="hidden" name="formulaire" value="contact">
                <input type="hidden" name="csrf" value="<?= $csrf ?>">
                <div class="field">
                    <input type="text" name="nom" value="<?= $nom ?>">
                    <label for="nom">Nom</label>
                </div>

                <div class="field">
                    <input type="email" name="email" value="<?= $email ?>">
                    <label for="email">Email</label>
                </div>

                <div class="field">
                    <textarea name="message"><?= $message ?></textarea>
                    <label for="message">Message</label>
                </div>

                <button type="submit">Envoyer</button>
            </form>
            <?php if (isset($success)) : ?>
                <p class="success"><?= $success ?></p>
            <?php endif; ?>
        </div>


        <!-- PROJET -->

        <div class="contact-box project-box">
            <h3>Demande de projet</h3>

            <form method="POST">
                <input type="hidden" name="formulaire" value="projet">
                <input type="hidden" name="csrf" value="<?= $csrf ?>">
                <div class="field">
                    <input type="text" name="nom" required>
                    <label>Nom</label>
                </div>

                <div class="field">
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>

                <div class="field">
                    <input type="text" name="type_projet" required>
                    <label>Type de projet</label>
                </div>

                <div class="field">
                    <textarea name="description" required></textarea>
                    <label>Décrivez votre projet</label>
                </div>

                <button type="submit">Lancer le projet</button>

            </form><?php if (isset($message_projet)) : ?>
                <p class="success">
                    <?= htmlspecialchars($message_projet) ?>
                </p>
            <?php endif; ?>
            <?php if ($success_projet) : ?>

                <div class="recap">

                    <h3>Récapitulatif de votre demande</h3>

                    <p>
                        <strong>Nom :</strong>
                        <?= htmlspecialchars($demande['nom']) ?>
                    </p>

                    <p>
                        <strong>Email :</strong>
                        <?= htmlspecialchars($demande['email']) ?>
                    </p>

                    <p>
                        <strong>Type :</strong>
                        <?= htmlspecialchars($demande['type_projet']) ?>
                    </p>

                    <p>
                        <strong>Description :</strong>
                        <?= htmlspecialchars($demande['description']) ?>
                    </p>

                </div>

            <?php endif; ?>
        </div>


    </div>

</section>
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