<style>
    nav {
        background: #1e3a8a;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    nav a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        font-family: Arial, sans-serif;
        transition: 0.3s;
    }

    nav a:hover {
        color: #93c5fd;
    }

    nav a:last-child {
        margin-left: auto;
        background: #dc2626;
        padding: 8px 15px;
        border-radius: 5px;
    }

    nav a:last-child:hover {
        background: #b91c1c;
        color: white;
    }
</style>

<nav>
    <a href=" /portfolio-awa/admin/dashboard.php">Dashboard</a>
    <a href="/portfolio-awa/admin/utilisateurs/liste.php">Administrateurs</a>
    <a href="/portfolio-awa/admin/messages/liste.php">Messages</a>
    <a href="/portfolio-awa/admin/demandes/liste.php">Demandes</a>
    <a href="/portfolio-awa/admin/projets/liste.php">Projets</a>
    <a href="/portfolio-awa/admin/deconnexion.php">Déconnexion</a>
</nav>