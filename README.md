🌸 B&T Flowers: Review Your Experience

---

Welkom bij de officiële repository van B&T Flowers, een full-stack webapplicatie ontwikkeld door Bercem & Tugche. Dit platform biedt een naadloze e-commerce ervaring gecombineerd met een interactief reviewsysteem, speciaal ontworpen voor bloemenliefhebbers en beheerders.

---

📝 Project Overzicht  
B&T Flowers is gebouwd volgens het client-server model. Het project implementeert veilige data-afhandeling, dynamische content-generatie en een modern, responsief design. Het is ontwikkeld als onderdeel van de opleiding Software Developer.

---

✨ Belangrijkste functionaliteiten  

**Volledig CRUD-Systeem:**  
Beheerders hebben volledige controle over het assortiment. Producten kunnen worden toegevoegd (add_product.php), bekeken (product_list.php), gewijzigd (edit_product.php) en verwijderd (delete_product.php).

**Interactief Review- & Like-systeem:**  
Klanten kunnen ervaringen delen op de detailpagina (flower_detail.php) en reacties van anderen 'liken' via een live database-update (like_comments.php).

**Veilig Gebruikersbeheer:**  
Een robuust systeem voor registratie (sign-up.php), inloggen (login.php) en profielbeheer (personal-data.php) met sessiebeveiliging en wachtwoord-hashing.

**Dynamisch Filtersysteem:**  
Gebruikers kunnen de catalogus filteren op categorieën in flowers.php, waarbij de data live wordt ontsloten uit de database.

**Administrator Dashboard:**  
Een centrale hub voor het beheren van producten en het inzien van inkomende klantberichten (messages.php) uit de contactformulier-database.

---

🛠️ Technische Stack  

**Frontend:** HTML5, CSS3 (Grid Layouts, Custom Variables), Boxicons API.  
**Backend:** PHP 8.x (Modular Functions, Session Management, Mail Handling).  

**Database:** MySQL met een geavanceerde dual-driver implementatie:  
- **PDO:** Gebruikt voor veilige, objectgeoriënteerde gebruikersauthenticatie (user_database.php).  
- **MySQLi:** Gebruikt voor snelle, procedurele product- en categorieverwerking.  

**Security:**  
- SQL Injection preventie via Prepared Statements.  
- XSS (Cross-Site Scripting) preventie via htmlspecialchars().  
- Veilige wachtwoordopslag via password_hash() en password_verify().

---

📂 Projectstructuur  

- **index.php:** De dynamische landingspagina.  
- **user-functions.php:** De "Business Logic Layer" met alle kernfuncties voor validatie en DB-interactie.  
- **admin_dashboard.php:** De navigatiehub voor administratieve taken.  
- **flower_detail.php:** De interactieve pagina voor productinformatie en community feedback.  
- **config.php & user_database.php:** Configuratiebestanden voor databaseverbindingen.

---

🚀 Installatie & Gebruik  

**Clone de repository:**  
```bash
git clone https://www.google.com/search?q=https://github.com/jouw-gebruikersnaam/bt-flowers.git
```

**Database Setup:**  
Importeer de bijgevoegde .sql bestanden in phpMyAdmin om de tabellen flowers_db, users_db en contact_form_db aan te maken.

**Configuratie:**  
Pas de inloggegevens in config.php en user_database.php aan naar jouw lokale serverinstellingen (bijv. XAMPP).

**Run:**  
Start je Apache/MySQL server en navigeer naar localhost/bt-flowers.

---

📅 Roadmap (Sprint Status)  

✅ Sprint 1-2: UI/UX Design, CSS Grid Layouts en Basisstructuur.  
✅ Sprint 3-4: Database Integratie en Dynamische Productcatalogus.  
✅ Sprint 5-6: Authenticatie, PDO Setup en Wachtwoordbeveiliging.  
✅ Sprint 7-8: Volledige CRUD-cyclus, Like-functionaliteit en Finale Oplevering.

---

Ontwikkeld met ❤️ door Bercem Yildirim & Tugche - 2025  
Software Development | ROC Mondriaan, School voor ICT
