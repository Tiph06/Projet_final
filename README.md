# 🚀 Application Laravel 12 - Guide de Déploiement Local Windows

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.17-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![Windows](https://img.shields.io/badge/Windows-0078D6?style=for-the-badge&logo=windows&logoColor=white)

**Guide complet pour installer et configurer l'application Laravel 12 sur Windows**

[🔧 Installation](#%EF%B8%8F-installation) •
[🚀 Lancement](#-lancement-de-lapplication) •
[🛠️ Commandes](#%EF%B8%8F-commandes-utiles) •
[❓ Support](#-support)

</div>

---

## 📋 Prérequis Système

### 💻 Logiciels requis

| Logiciel     | Version minimale | Lien de téléchargement                                                               |
| ------------ | ---------------- | ------------------------------------------------------------------------------------ |
| **PHP**      | 8.2+             | [XAMPP](https://www.apachefriends.org/) ou [WampServer](https://www.wampserver.com/) |
| **Composer** | Dernière version | [getcomposer.org](https://getcomposer.org/)                                          |
| **Node.js**  | 18+              | [nodejs.org](https://nodejs.org/)                                                    |
| **Git**      | Dernière version | [git-scm.com](https://git-scm.com/)                                                  |

### 🔧 Extensions PHP requises

Avec **XAMPP** ou **WampServer**, ces extensions sont généralement incluses :

<details>
<summary>📝 Liste complète des extensions PHP</summary>

-   ✅ BCMath PHP Extension
-   ✅ Ctype PHP Extension
-   ✅ cURL PHP Extension
-   ✅ DOM PHP Extension
-   ✅ Fileinfo PHP Extension
-   ✅ Filter PHP Extension
-   ✅ Hash PHP Extension
-   ✅ Mbstring PHP Extension
-   ✅ OpenSSL PHP Extension
-   ✅ PCRE PHP Extension
-   ✅ PDO PHP Extension
-   ✅ Session PHP Extension
-   ✅ Tokenizer PHP Extension
-   ✅ XML PHP Extension
-   ✅ ZIP PHP Extension

</details>

### 🖥️ Installation recommandée sur Windows

```powershell
# Vérifier que PHP est installé et accessible
php --version

# Vérifier que Composer est installé
composer --version

# Vérifier que Node.js est installé
node --version
npm --version
```

---

## ⚙️ Installation

### 1️⃣ Cloner le projet

```powershell
git clone https://github.com/Tiph06/Projet_final.git
cd Projet_final
git checkout dev
```

### 2️⃣ Installer les dépendances PHP

```powershell
composer install
```

<details>
<summary>⚠️ En cas d'erreur avec Composer</summary>

```powershell
# Si erreur de mémoire
php -d memory_limit=-1 composer.phar install

# Si erreur de certificat SSL
composer config --global disable-tls false
composer config --global secure-http false
```

</details>

### 3️⃣ Installer les dépendances Node.js

```powershell
npm install
```

### 4️⃣ Configuration de l'environnement

```powershell
# Copier le fichier d'exemple (Windows)
copy .env.example .env

# Générer la clé d'application
php artisan key:generate
```

### 5️⃣ Configuration de la base de données SQLite

> 💡 **SQLite** est parfait pour le développement local - aucune configuration complexe requise !

```powershell
# Le fichier de base de données sera créé automatiquement
# Créer le fichier manuellement si nécessaire (facultatif)
type nul > database\database.sqlite

# Exécuter les migrations avec données de test
php artisan migrate --seed
```

---

## 🚀 Lancement de l'application

### ✅ **Méthode recommandée** : Script de développement intégré

Le projet inclut un script qui lance **tous les services** simultanément :

```powershell
composer run dev
```

> **🎯 Cette commande unique lance :**
>
> -   🌐 Serveur Laravel (`http://localhost:8000`)
> -   ⚡ Worker de queue pour les tâches asynchrones
> -   🎨 Vite pour la compilation des assets en temps réel

### 🔄 Méthode manuelle (si besoin)

Si vous préférez contrôler chaque service séparément :

```powershell
# Terminal 1 : Serveur Laravel
php artisan serve

# Terminal 2 : Worker de queue (optionnel)
php artisan queue:listen

# Terminal 3 : Compilation des assets
npm run dev
```

---

## 🌐 Accès à l'application

Une fois les services lancés :

| 🔗 Service          | 📍 URL                | 📝 Description        |
| ------------------- | --------------------- | --------------------- |
| **Application**     | http://localhost:8000 | Interface principale  |
| **Vite Dev Server** | http://localhost:5173 | Hot reload des assets |

---

## 📁 Structure du projet

<details>
<summary>🗂️ Arborescence complète</summary>

```
Projet_final/
├── 📁 app/                 # Code source Laravel
├── 📁 bootstrap/           # Fichiers de démarrage
├── 📁 config/             # Configuration
├── 📁 database/           # Migrations, seeders, SQLite
│   └── 📄 database.sqlite # Base de données SQLite
├── 📁 public/             # Assets publics
├── 📁 resources/          # Vues, CSS, JS
├── 📁 routes/             # Définition des routes
├── 📁 storage/            # Logs, cache, uploads
├── 📁 tests/              # Tests automatisés
├── 📄 .env                # Variables d'environnement
├── 📄 composer.json       # Dépendances PHP
├── 📄 package.json        # Dépendances Node.js
└── 📄 vite.config.js      # Configuration Vite
```

</details>

---

## 🛠️ Commandes utiles

### 🎨 Laravel Artisan

<details>
<summary>📚 Commandes de développement</summary>

```powershell
# Nettoyer tous les caches
php artisan optimize:clear

# Lister toutes les routes
php artisan route:list

# Créer un contrôleur
php artisan make:controller MonController

# Créer un modèle avec migration
php artisan make:model MonModel -m

# Lancer les tests
php artisan test
```

</details>

### 🗄️ Base de données

```powershell
# Remettre à zéro la base avec données de test
php artisan migrate:fresh --seed

# Créer une migration
php artisan make:migration create_ma_table

# Voir le statut des migrations
php artisan migrate:status
```

### 🎯 Assets et compilation

```powershell
# Développement avec hot reload
npm run dev

# Build pour la production
npm run build

# Analyser les dépendances
npm audit
```

---

## 📦 Technologies utilisées

### 🔧 Backend

| Package                                                                                      | Version | Rôle                 |
| -------------------------------------------------------------------------------------------- | ------- | -------------------- |
| ![Laravel](https://img.shields.io/badge/Laravel-12.17-FF2D20?style=flat-square&logo=laravel) | 12.17   | Framework principal  |
| ![Sanctum](https://img.shields.io/badge/Sanctum-4.1-4F46E5?style=flat-square)                | 4.1     | Authentification API |
| ![SQLite](https://img.shields.io/badge/SQLite-Local-003B57?style=flat-square&logo=sqlite)    | Local   | Base de données      |

### 🎨 Frontend

| Outil                                                                                           | Rôle                     |
| ----------------------------------------------------------------------------------------------- | ------------------------ |
| ![Vite](https://img.shields.io/badge/Vite-Bundler-646CFF?style=flat-square&logo=vite)           | Build tool & Hot reload  |
| ![Laravel Vite](https://img.shields.io/badge/Laravel_Vite-Integration-FF2D20?style=flat-square) | Intégration Laravel/Vite |

### 🧪 Développement

| Outil                                                                    | Version | Rôle                  |
| ------------------------------------------------------------------------ | ------- | --------------------- |
| ![Pest](https://img.shields.io/badge/Pest-3.8-22C55E?style=flat-square)  | 3.8     | Framework de tests    |
| ![Pint](https://img.shields.io/badge/Pint-1.13-0369A1?style=flat-square) | 1.13    | Formateur de code PHP |

---

## 🗄️ Configuration de la base de données

### SQLite (Recommandé pour le développement)

| Paramètre         | Valeur                     | Description             |
| ----------------- | -------------------------- | ----------------------- |
| **Type**          | SQLite                     | Base de données fichier |
| **Fichier**       | `database/database.sqlite` | Stockage local          |
| **Configuration** | `DB_CONNECTION=sqlite`     | Dans `.env`             |

> ✅ **Avantages** : Pas de serveur à installer, parfait pour le développement, portable

---

## ❗ Résolution de problèmes

### 🚨 Erreurs communes sur Windows

<details>
<summary>🔍 "Class not found" / Autoload</summary>

```powershell
# Régénérer l'autoload
composer dump-autoload -o

# Nettoyer le cache de configuration
php artisan config:clear
```

</details>

<details>
<summary>🔍 "Application key not found"</summary>

```powershell
# Générer une nouvelle clé
php artisan key:generate
```

</details>

<details>
<summary>🔍 "Database not found"</summary>

```powershell
# Créer le fichier SQLite
type nul > database\database.sqlite
php artisan migrate
```

</details>

<details>
<summary>🔍 "Port 8000 already in use"</summary>

```powershell
# Utiliser un autre port
php artisan serve --port=8001

# Ou arrêter le processus utilisant le port
netstat -ano | findstr :8000
taskkill /PID [PID_NUMBER] /F
```

</details>

<details>
<summary>🔍 "Permission denied" sur storage</summary>

```powershell
# Solution : Exécuter en tant qu'administrateur ou changer le propriétaire
# Généralement pas nécessaire sur Windows avec les versions récentes
```

</details>

### ✅ Vérification de l'installation

```powershell
# Vérifier Laravel
php artisan --version
php artisan about

# Vérifier les extensions PHP
php -m | findstr /C:"mbstring" /C:"curl" /C:"zip"

# Tester la connexion à la base
php artisan tinker
# Puis dans Tinker : DB::connection()->getPdo();
```

---

## 📞 Support

<div align="center">

| 📚 Resource               | 🔗 Lien                                                                  |
| ------------------------- | ------------------------------------------------------------------------ |
| **Documentation Laravel** | [laravel.com/docs/12.x](https://laravel.com/docs/12.x)                   |
| **Repository du projet**  | [github.com/Tiph06/Projet_final](https://github.com/Tiph06/Projet_final) |
| **Laravel France**        | [laravel-france.com](https://laravel-france.com)                         |
| **Communauté Discord**    | [discord.gg/laravel](https://discord.gg/laravel)                         |

</div>

---

<div align="center">

### 🌟 **Projet prêt pour le développement !** 🌟

**⚡ Commande magique pour démarrer :**

```powershell
composer run dev
```

> **💡 Conseil** : Gardez cette commande sous la main - elle lance tout ce dont vous avez besoin !

---

**Made with ❤️by une développeuse passionnée.**

![Visitor Badge](https://visitor-badge.laobi.icu/badge?page_id=projet_final_setup)

</div>
