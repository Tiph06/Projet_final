<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="350" alt="Laravel Logo">
  </a>
  <br>
  <a href="https://tailwindcss.com" target="_blank">
    <img src="https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg" width="80" alt="Tailwind CSS Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# 🧪 Projet Final – Laravel, Tailwind, Vite & Blade

Ce projet est une application web développée avec **Laravel 12**, stylisée avec **Tailwind CSS 4**, et optimisée avec **Vite 6**.  
Il utilise des vues **Blade**, avec une base propre à faire évoluer selon les besoins ✨

## 🧰 Stack technique

-   ⚙️ **Laravel** 12 (PHP ^8.2)
-   🎨 **Tailwind CSS** 4.1
-   ⚡ **Vite** 6.3 (avec `laravel-vite-plugin`)
-   🔀 **Blade** (pas Inertia !)
-   🌐 **Axios** pour les appels API
-   🗃️ **SQLite** comme base de données par défaut
-   🧪 **PHPUnit** / **Pest** pour les tests
-   📦 **Node.js >= 18**

## ▶️ Lancer le projet

1. Clone le repo :

```bash
git clone <url>
cd projet_final
```

2. Installe les dépendances :

```bash
composer install
npm install
```

3. Configure ton environnement :

```bash
cp .env.example .env
php artisan key:generate
```

4. Lance le serveur :

```bash
npm run dev
php artisan serve
```

---

## ✅ Environnement

Extrait `.env` :

```env
APP_NAME="Laravel"
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
```

Base de données SQLite disponible par défaut (`database/database.sqlite`).

---

## 📁 Structure recommandée

```
├── app/
├── database/
│   └── migrations/
├── public/
├── resources/
│   ├── views/           # Blade templates
│   ├── js/              # JS (Alpine / Vite)
│   └── css/             # TailwindCSS
├── routes/
│   ├── web.php
│   ├── auth.php
│   └── ...
```

---

## 📌 Prochaines étapes (à venir)

-   [ ] Ajouter Alpine.js 🌿
-   [ ] Intégrer des composants interactifs
-   [ ] Créer une API externe (Unsplash, Wikipédia...)
-   [ ] Ajouter une page d’administration sécurisée
-   [ ] Déployer sur Render / Vercel / Railway

---

## 👩‍💻 Contribuer

Ce projet est en évolution constante, toute suggestion est bienvenue !  
Tu peux ouvrir une issue ou une PR une fois les bases terminées ❤️

---

## 🪪 Licence

Projet open-source sous licence [MIT](https://opensource.org/licenses/MIT).

---

_Made with ❤️ by une développeuse passionnée._
