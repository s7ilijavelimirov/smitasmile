# SmitaSmile WordPress Theme - Developer Guide

**Klijent:** Clinica Dental SMITA - Advanced Smile Design, Barcelona
**Tema:** Custom WordPress tema (smitasmile)
**Verzija:** 1.0.0
**Lokacija:** `/wp-content/themes/smitasmile/`

---

## Sadrzaj

1. [Pregled projekta](#pregled-projekta)
2. [Tech Stack](#tech-stack)
3. [Potrebni WordPress pluginovi](#potrebni-wordpress-pluginovi)
4. [Struktura foldera](#struktura-foldera)
5. [Build sistem (Gulp)](#build-sistem-gulp)
6. [ACF polja po stranicama](#acf-polja-po-stranicama)
7. [Custom Post Type - Smita Team](#custom-post-type---smita-team)
8. [Visejezikonost (Polylang)](#visejezikonost-polylang)
9. [Meni sistem](#meni-sistem)
10. [Sidebar i widget oblasti](#sidebar-i-widget-oblasti)
11. [Stranice i page templatei](#stranice-i-page-templatei)
12. [JavaScript moduli](#javascript-moduli)
13. [SCSS arhitektura](#scss-arhitektura)
14. [Performance optimizacije](#performance-optimizacije)
15. [Google Ads (zakomentarisano)](#google-ads-zakomentarisano)
16. [Vazne hardkodirane vrednosti](#vazne-hardkodirane-vrednosti)
17. [Razvoj - lokalno okruzenje](#razvoj---lokalno-okruzenje)

---

## Pregled projekta

SmitaSmile je custom WordPress tema za stomatoiolosku kliniku u Barceloni. Tema je dizajnirana sa minimalnim dark estetikom (crna pozadina, belo pismo), premium osecajem i jakim fokusom na konverzije (booking termina).

**Kljucne funkcionalnosti:**
- Visejezicnost: EN, ES, DE, RU, LT (5 jezika via Polylang)
- Online booking via Dentalink plugin (`[dentalink_booking]`)
- Before/After smile transformacije sa toggle efektom
- Galerija sa justified layout i fullscreen viewerom
- Custom Team Members CPT sa Bootstrap modalima
- Slide-push hamburger meni (bez standardne Bootstrap navbar)
- WhatsApp float dugme sa automatskim prevodjenjem poruke
- Instagram feed integacija (`[instagram-feed feed=1]`)
- Google Reviews via Trustindex (`[trustindex no-registration=google]`)

---

## Tech Stack

| Tehnologija | Verzija | Uloga |
|------------|---------|-------|
| WordPress | Latest | CMS |
| PHP | 7.4+ | Backend |
| Bootstrap | 5.3.8 | CSS framework |
| Swiper.js | 10.3.1 | Hero slider |
| SCSS | 1.49.0 | CSS preprocessor |
| Gulp | 4.0.2 | Build tool |
| ACF Pro | - | Custom fields |
| Polylang | - | Multijezicnost |
| Contact Form 7 | - | Kontakt forme |
| Dentalink | - | Booking sistem |

---

## Potrebni WordPress pluginovi

### OBAVEZNI (tema ne radi bez njih):
1. **Advanced Custom Fields (ACF) Pro** - svi sadrzaji stranica su ACF polja
2. **Polylang** (ili Polylang Pro) - visejezicnost, switcher, meni mapiranje
3. **Dentalink Booking** - shortcode `[dentalink_booking]` na homepage i booking stranici

### Preporuceni:
4. **Contact Form 7** - kontakt forme (4 forme, jedna po jeziku)
5. **Smash Balloon Instagram Feed** - Instagram sekcija na homepage
6. **Trustindex** - Google recenzije na homepage
7. **Classic Editor** - Gutenberg je ONEMOGUCEN u temi

---

## Struktura foldera

```
smitasmile/
|
|-- src/                          # Izvorni kod (NE editovati dist/)
|   |-- js/
|   |   |-- main.js               # Svi custom JS moduli
|   |   `-- bootstrap.bundle.js   # Bootstrap source
|   `-- scss/
|       |-- style.scss            # Glavni entry point - importuje sve
|       |-- base/
|       |   |-- _fonts.scss       # @font-face definicije
|       |   |-- _misc.scss        # Reset, globals
|       |   |-- _type.scss        # Tipografija, heading stilovi
|       |   |-- _buttons.scss     # Svi tipovi dugmadi
|       |   `-- _scrollbar.scss   # Custom scrollbar
|       |-- components/
|       |   |-- _hero-banner.scss
|       |   |-- _intro.scss       # Intro sekcija (unutrasnje stranice)
|       |   |-- _founter.scss     # Founder sekcija (homepage)
|       |   |-- _smile-makeovers.scss # Before/After kartice
|       |   |-- _treatments.scss  # Tretmani komponenta
|       |   |-- _partners.scss    # Partneri logo sekcija
|       |   |-- _team.scss        # Team kartice i modali
|       |   |-- _cta-banner.scss  # CTA banner sekcija
|       |   `-- _whatsapp.scss    # WhatsApp float dugme
|       |-- layout/
|       |   |-- _header.scss      # Site header, sticky nav
|       |   |-- _footer.scss      # Footer 4-kolumne
|       |   `-- _slide-push-menu.scss # Hamburger meni panel
|       |-- overrides/
|       |   `-- _variables.scss   # SVE CSS varijable i Bootstrap overrides
|       `-- pages/
|           |-- _home.scss
|           |-- _single.scss      # Blog post
|           |-- _team-page.scss
|           |-- _treatments-page.scss
|           |-- _gallery.scss
|           |-- _success-stories.scss
|           |-- _contact.scss
|           |-- _booking.scss
|           `-- _blog.scss
|
|-- dist/                         # Build output (generisano, ne commitovati manuelno)
|   |-- css/
|   |   |-- style.min.css         # Kompajliran custom CSS
|   |   |-- bootstrap.min.css     # Kopija iz node_modules
|   |   `-- swiper-bundle.min.css # Kopija iz node_modules
|   |-- js/
|   |   |-- main.min.js           # Minifikovan custom JS
|   |   |-- bootstrap.bundle.min.js
|   |   `-- swiper-bundle.min.js
|   |-- fonts/
|   |   |-- Lora-Regular.woff2
|   |   |-- Lora-Bold.woff2
|   |   |-- Poppins-Regular.woff2
|   |   |-- Poppins-Light.woff2
|   |   `-- Poppins-Bold.woff2
|   `-- img/
|       |-- favicon.webp
|       |-- phone.svg, email.svg, address.svg, route.svg
|       |-- instagram.svg, facebook.svg
|       |-- 360.svg, phone-home.svg
|
|-- template-parts/               # Delovi stranica (include via get_template_part)
|   |-- homepage/
|   |   |-- hero.php              # Hero slider sekcija
|   |   |-- founder.php          # Founder/About sekcija
|   |   |-- smile-makeovers.php  # Before/After + Testimonials
|   |   |-- treatments.php       # Tretmani preview (zakomentarisano na homepage)
|   |   |-- team.php              # Tim preview (zakomentarisano na homepage)
|   |   `-- partners.php          # Logo partnera
|   |-- intro-section.php         # Page header (za unutrasnje stranice)
|   |-- cta-banner.php            # CTA poziv na akciju
|   |-- gallery-masonry.php       # Galerija justified layout
|   |-- content.php               # Blog post lista item
|   |-- content-page.php          # Standardna stranica sadrzaj
|   |-- content-none.php          # Poruka kad nema sadrzaja
|   `-- content-search.php        # Search rezultati item
|
|-- inc/                          # PHP includes
|   |-- smitateam.php             # Team Members CPT + taksonomija
|   |-- template-tags.php         # Pomocne PHP funkcije
|   |-- customizer.php            # WordPress Customizer opcije
|   |-- template-functions.php    # Tema funcije
|   `-- jetpack.php               # Jetpack kompatibilnost
|
|-- class-wp-bootstrap-navwalker.php  # Bootstrap 5 nav walker
|-- class-slide-push-menu-walker.php  # Custom walker za slide meni
|
|-- front-page.php                # Homepage template
|-- page.php                      # Standardna stranica
|-- single.php                    # Blog post
|-- archive.php                   # Blog arhiva
|-- index.php                     # Fallback
|-- search.php                    # Pretraga
|-- header.php                    # Site header (ucitava se na svim stranicama)
|-- footer.php                    # Site footer
|-- sidebar.php                   # Sidebar (nekoriscen)
|-- 404.php                       # 404 stranica
|-- author.php                    # Autor arhiva
|-- tag.php                       # Tag arhiva
|-- comments.php                  # Komentari
|
|-- template-gallery.php          # Page template: Galerija
|-- template-treatments.php       # Page template: Tretmani
|-- template-contact.php          # Page template: Kontakt
|-- template-booking.php          # Page template: Booking (standalone, bez header/footer)
|-- template-success-stories.php  # Page template: Success Stories / Before-After
|-- template-smita-team.php       # Page template: Tim
|
|-- functions.php                 # Glavna tema konfiguracija
|-- style.css                     # Tema registracija (meta podaci)
|-- gulpfile.js                   # Build konfiguracija
|-- package.json                  # Node dependencies
`-- DEVELOPER-GUIDE.md            # Ovaj fajl
```

---

## Build sistem (Gulp)

### Instalacija (prvi put):
```bash
cd /wp-content/themes/smitasmile
npm install
```

### Komande:

| Komanda | Opis |
|---------|------|
| `npm run watch` | Development mode - SCSS/JS kompajliranje + BrowserSync live reload |
| `npm run serve` | Isto kao watch |
| `npm run build` | Production build - sve optimizovano i miniaturisano |

### Sta Gulp radi:

**`gulp build` (Production):**
1. SCSS `src/scss/style.scss` → kompresovan `dist/css/style.min.css`
2. JS `src/js/main.js` → minifikovan `dist/js/main.min.js`
3. Kopira Bootstrap CSS/JS iz `node_modules/` u `dist/`
4. Kopira Swiper CSS/JS iz `node_modules/` u `dist/`
5. Kopira fontove iz `src/fonts/` u `dist/fonts/`

**`gulp default` (Development):**
- Pokrece BrowserSync na `https://smitasmile.locals7codesign/` (proxy)
- Watches: SCSS, JS, PHP fajlove

> **VAZNO:** Uvek pokretaj `npm run build` pre deploymenta na produkciju.
> Editovati SAMO fajlove u `src/`. Fajlovi u `dist/` su generisani.

---

## ACF polja po stranicama

### Homepage (`front-page.php`)

**Hero sekcija** (`hero.php`):
| Polje | Tip | Opis |
|-------|-----|------|
| `hero_bg_type` | Select | `image` ili `video` |
| `hero_background_images` | Repeater | Niz slika za Swiper slider |
| `hero_background_video` | URL/File | MP4 video pozadina (alternativa slikama) |
| `hero_min_height` | Text | CSS vrednost visine npr. `100vh` |
| `hero_headline` | Text | Glavni H1 naslov |
| `hero_subheadline` | Textarea | Podnaslov |
| `hero_cta_link` | Link | Primarni CTA (Book Appointment) |
| `hero_cta_call` | Link | Sekundarni CTA (Call Us) |
| `hero_cta_contact` | Link | Trecci CTA (Contact Us) |

**Founder sekcija** (`founder.php`):
| Polje | Tip | Opis |
|-------|-----|------|
| `founder_image` | Image | Mala okrugla slika osnivaca |
| `founder_title` | Text/HTML | Naslov sekcije |
| `founder_description` | WYSIWYG | Opis/tekst |
| `founder_name` | Text | Ime osnivaca |
| `founder_signature` | Image | Slika potpisa |

**Smile Makeovers sekcija** (`smile-makeovers.php`):
| Polje | Tip | Opis |
|-------|-----|------|
| `smile_section_title` | Text | Naslov sekcije |
| `smile_makeovers` | Repeater | Niz Before/After kartica |
| `smile_makeovers > makeover_title` | Text | Naziv tretmana |
| `smile_makeovers > makeover_image_before` | Image | Before slika |
| `smile_makeovers > makeover_image_after` | Image | After slika |
| `smile_cta_link` | Link | CTA dugme ispod kartica |

### Treatments stranica (`template-treatments.php`)

| Polje | Tip | Opis |
|-------|-----|------|
| `intro_title` | Text | Naslov intro sekcije |
| `intro_description` | WYSIWYG | Opis intro sekcije |
| `intro_image` | Image | Slika intro sekcije |
| `treatments` | Repeater | Niz tretmana |
| `treatments > treatment_title` | Text | Naziv tretmana |
| `treatments > treatment_description` | WYSIWYG | Opis |
| `treatments > treatment_images` | Repeater | Slike tretmana |
| `treatments > treatment_faq` | Repeater | FAQ pitanja |
| `treatments > treatment_faq > faq_question` | Text | Pitanje |
| `treatments > treatment_faq > faq_answer` | WYSIWYG | Odgovor |

### Contact stranica (`template-contact.php`)

| Polje | Tip | Opis |
|-------|-----|------|
| `contact_main_title` | Text | Naslov stranice |
| `contact_main_description` | WYSIWYG | Opis |
| `contact_items` | Repeater | Info kartice (tel, email, adresa...) |
| `contact_items > item_icon` | Text | Naziv SVG ikone (bez ekstenzije) - fajlovi su u `dist/img/` |
| `contact_items > item_content_top` | WYSIWYG | Gornji tekst/link |
| `contact_items > item_label` | WYSIWYG | Donji label tekst |

> **Contact Forms 7:** Forma se automatski biraju po jeziku (EN, ES, DE, RU). Shortcode ID-ovi su hardkodirani u `template-contact.php`.

### Gallery stranica (`template-gallery.php`)

| Polje | Tip | Opis |
|-------|-----|------|
| `gallery_title` | Text | Naslov galerije |
| `gallery_description` | Textarea | Opis galerije |
| `gallery_images` | Repeater | Slike |
| `gallery_images > image` | Image | WordPress attachment |
| `gallery_images > title` | Text | Naslov slike (prikazan u overlay-u) |
| `gallery_images > alt_text` | Text | Alt tekst (SEO) |

### Success Stories stranica (`template-success-stories.php`)

| Polje | Tip | Opis |
|-------|-----|------|
| `smile_section_title` | Text | Naslov sekcije |
| `smile_makeovers` | Repeater | Iste Before/After kartice kao homepage |
| `smile_cta_link` | Link | CTA dugme |

### Team stranica (`template-smita-team.php`)

Koristi **Custom Post Type** `smita_team` (vidi sekciju ispod).

ACF polja na svakom Team Member CPT postu:
| Polje | Tip | Opis |
|-------|-----|------|
| `team_position_title` | Text | Titula (npr. "Dentist") |
| `team_specialization` | Text | Specijalizacija |
| `team_bio` | WYSIWYG | Biografija |
| `team_experience_sections` | Repeater | Sekcije iskustva/obrazovanja |
| `team_experience_sections > experience_title` | Text | Naslov sekcije |
| `team_experience_sections > experience_description` | WYSIWYG | Sadrzaj |
| `team_experience_sections > experience_order` | Number | Redosled prikaza |
| `team_social_links` | Repeater | Drustvene mreze |
| `team_social_links > social_platform` | Select | `linkedin`, `instagram`, `facebook`, `twitter`, `email` |
| `team_social_links > social_url` | URL | Link |

---

## Custom Post Type - Smita Team

**Lokacija:** `inc/smitateam.php` (ukljucen u `functions.php`)

- **Post type slug:** `smita_team`
- **Archive URL:** `/team/`
- **Taksonomija:** `team_category` (slug: `/team-category/`)
- **Admin meni:** "Smita Team" (pozicija 5, ikona: groups)
- **Podrska:** title, thumbnail, excerpt, editor, custom-fields, page-attributes

**Sortiranje na sajtu:** Po `menu_order` ASC - menja se via "Order" polje u admin editoru ili plugin kao "Simple Page Ordering".

**Admin lista:** Prikazuje thumbnail kolonu (150x150px preview).

---

## Visejezikonost (Polylang)

### Podrzani jezici:
- `en` - Engleski (default/fallback)
- `es` - Spanski
- `de` - Nemacki
- `ru` - Ruski
- `lt` - Litvanski

### Kako radi:

1. **Meni po jeziku** - Svaki jezik ima sopstveni navigacioni meni. Automatski se biraju u `functions.php` via `wp_nav_menu_args` filter.

   Potrebno kreirati sledece menije u WP admin:
   - `Header Menu EN`, `Header Menu ES`, `Header Menu DE`, `Header Menu RU`, `Header Menu LT`
   - `Footer Menu EN`, `Footer Menu ES`, `Footer Menu DE`, `Footer Menu RU`, `Footer Menu LT`

2. **Strings za prevod** - Registrovani u `smitasmile_register_pll_strings()` u `functions.php`. Prevodi se unose u: **Polylang > Strings Translations**.

3. **Upotreba u PHP:**
   ```php
   // Dohvatanje prevedenog stringa:
   pll__('Book Your Appointment')

   // Siguran fallback ako Polylang nije aktivan:
   function_exists('pll__') ? pll__('Call Us') : __('Call Us', 'smitasmile')

   // Dohvatanje prevedenog post ID-a:
   $booking_page_id = function_exists('pll_get_post') ? pll_get_post(484) : 484;
   ```

4. **Language Switcher u headeru** - Custom dropdown sa zastavicama, Desktop only (`d-none d-md-block`). Zastavice se ucitavaju iz `/wp-content/polylang/` foldera (SVG fajlovi koje Polylang sam generise).

5. **WhatsApp poruka** - Automatski detektuje `document.documentElement.lang` i salje odgovarajucu poruku (ES ili EN).

---

## Meni sistem

Tema NE koristi standardnu Bootstrap navbar. Umesto toga ima custom "Slide Push Menu" sistem.

### Komponente:

**Header** (`header.php`):
- Logo (levo)
- Language dropdown - desktop (desno)
- Hamburger toggle dugme (desno)

**Slide Push Menu panel** (html u `header.php`, stilovi u `_slide-push-menu.scss`, logika u `main.js`):
- Logo + Close dugme (vrh panela)
- WordPress meni via `Slide_Push_Menu_Walker` (`class-slide-push-menu-walker.php`)
- CTA dugmad: Book Appointment + Call Us + Contact Us (dno panela)
- Social links: Instagram, Facebook, Email (dno panela)

**Ponasanje:**
- Otvara se desno (ili levo, zavisi od SCSS konfiguracije)
- Overlay zatvara meni na klik
- Escape tastatura zatvara meni
- Na resize > 200px meni se automatski zatvara

### Hardkodirani Page ID-ovi (u `header.php`):
```php
$booking_page_id = pll_get_post(484);  // Booking stranica - EN ID
$contact_page_id = pll_get_post(412);  // Contact stranica - EN ID
```
> Ove vrednosti treba azurirati ako se stranice obrisu i ponovo kreiraju!

---

## Sidebar i widget oblasti

Registrovanih 6 widget oblasti u `functions.php`:

| ID | Naziv | Gde se koristi |
|----|-------|----------------|
| `primary-sidebar` | Primarna sidebara | Nekoriscena trenutno |
| `footer-logo-social` | Footer - Logo & Social | Footer kol. 1 (ispod logo) |
| `footer-contact` | Footer - Contact Info | Footer kol. 2 |
| `footer-address` | Footer - Address | Footer kol. 3 |
| `footer-maps` | Footer - Google Maps | Footer kol. 4 |
| `mobile-footer-widget` | Mobile footer widget | Nekoriscena trenutno |

---

## Stranice i page templatei

### Dodeliti template u WP admin:
Svaka stranica u WP adminu ima "Page Template" dropdown (desno sidebar). Odaberi odgovarajuci template.

| Template fajl | Naziv | Opis |
|---------------|-------|------|
| `front-page.php` | - | Homepage (automatski za "Front Page") |
| `page.php` | Defaultna strana | Standardne WordPress stranice |
| `template-treatments.php` | Treatments | Stranica sa tretmanima i FAQ |
| `template-contact.php` | Contact | Kontakt forma + mapa + info |
| `template-gallery.php` | Gallery | Foto galerija sa lightboxom |
| `template-booking.php` | Book Appointment | Standalone booking portal (bez header/footer) |
| `template-success-stories.php` | Success Stories | Before/After transformacije |
| `template-smita-team.php` | Smita Team | Grid timskih clanova sa modalima |

### Posebnost Booking templatea:
Template `template-booking.php` je **standalone** - ne koristi `get_header()` ni `get_footer()`. Ima sopstvenu HTML strukturu sa sidebar panelom (uputstvo) i glavnim sadrzajem (Dentalink widget).

---

## JavaScript moduli

Svi moduli su u `src/js/main.js` (jedan fajl, vise IIFE modula):

### 1. Swiper Hero Slider
- Selector: `.hero-swiper`
- Loop, autoplay 7000ms, fade efekat, paginacija, crossFade
- Inicijalizuje se samo ako `Swiper` objekat postoji globalno

### 2. Sticky Header
- Transparentan kad je scroll < 50px
- Tamna pozadina (rgba 0.9) posle 50px scrollanja
- **Hide on scroll down, show on scroll up** - moderni UX pattern
- Koristi `requestAnimationFrame` za performanse

### 3. Smooth Scroll
- Za sve `a[href^="#"]` linkove
- Preskace Bootstrap modal triggere
- Uzima visinu headera za offset

### 4. Smile Transformations (Before/After)
- Selector: `.transformation-card`, `.makeover-card`
- Klik toggleuje `.is-revealed` klasu
- Prva interakcija dodaje `.has-interacted` (krije "Tap" hint)

### 5. WhatsApp Float Button
- ID: `#whatsapp-btn`
- Broj: `+34622165781`
- Automatski detektuje jezik iz `<html lang="">` atributa
- Generise WhatsApp URL sa prevedenom porukom

### 6. Gallery - Justified Layout + Fullscreen Viewer
- Selector: `#galleryMasonry`
- **Justified layout:** Kalkulise visinu redova da popuni sirinu (algoritam slican Google Photos)
- Target visina reda: 160px (mobile) → 280px (desktop)
- Na resize: relayoutuje sa debounce 200ms
- **Fullscreen Viewer:**
  - Kreira se dinamicki i appenda direktno na `<body>`
  - Navigacija: dugmad prev/next, keyboard (←/→/Escape), touch swipe
  - Thumbnail traka sa skrolovanjem (horizontalno mobile, vertikalno desktop)
  - Slide animacija izmedju slika

### 7. Slide Push Menu
- Hamburger toggle, close button, overlay klik
- Submenu toggle (accordion stil)
- Focus trap (pristupacnost)
- Zatvara se na Escape, klik na linkove, resize > 200px

### 8. Language Dropdown
- Selector: `.lang-dropdown`
- Toggle na klik, zatvara ostale otvorene dropdowne
- Zatvara se na klik van i Escape

### 9. Bootstrap Modal Fix
- Premesta sve `.modal` elemente iz `.site-wrapper` direktno na `<body>`
- Resava CSS stacking context problem sa fixed/sticky elementima

---

## SCSS arhitektura

### Import redosled (`style.scss`):
1. `base/fonts` - @font-face (Lora, Poppins)
2. `overrides/variables` - sve CSS varijable, Bootstrap overrides
3. `base/misc`, `base/type`, `base/buttons`, `base/scrollbar`
4. `components/*` - Hero, Intro, Founder, Smile, Treatments, Partners, Team, CTA, WhatsApp
5. `layout/*` - Header, Footer, Slide Push Menu
6. `pages/*` - Per-page stilovi

### Boje (iz `_variables.scss`):
```scss
$primary: #000000;      // Crna - glavna boja, background
$secondary: #ffffff;    // Bela - tekst, dugmad
$accent: #1f1f1f;       // Tamno siva - hover/active
$dark-accent: #111111;
$light-accent: #e7e7e7; // Borders
$gray: #999999;
$light-gray: #f5f5f5;
```

### Fontovi:
- **Headings:** Lora (serif) - `$font-family-heading`
- **Body:** Poppins (sans-serif) - `$font-family-body`
- Fajlovi: `.woff2` format u `dist/fonts/`

### Custom container:
```scss
.container-xl-custom  // Max 1620px na XL
.container-xxl        // Max 1620px (Bootstrap override)
```

### Custom spacing utilities (Bootstrap ekstenzija):
Bootstrap ima `m-1` do `m-5`. Tema dodaje `m-6` do `m-9`:
```scss
// 6: 3rem, 7: 4rem, 8: 5rem, 9: 6rem
// Responsive verzije: py-lg-8, pb-md-6, itd.
```

### Critical CSS (inline u `<head>`):
U `functions.php` se inline-uje minimalni CSS koji je potreban za prvo renderovanje:
- CSS varijable (`--primary`, `--secondary`, `--accent`)
- Body font, margin
- `.site-header` i `.hero-section` boje
- Hero headline font-size sa `clamp()`

---

## Performance optimizacije

Implementirane u `functions.php`:

1. **Gutenberg potpuno onemogucen** - nema block editor stilova koji se ucitavaju
2. **jQuery Migrate uklonjen** - manji payload
3. **WordPress Emoji uklonjen** - nema emoji detection skripta
4. **WP head ociscen** - uklonjen generator, REST link, shortlink
5. **Bootstrap i Swiper CSS** - ucitavaju se via `<link rel="preload">` + `onload` trick (ne blokiraju rendering)
6. **Custom CSS** (`style.min.css`) - ucitava se normalno (potreban za FCP)
7. **Svi JS** ucitavaju se sa `defer` strategijom
8. **Preconnect** za Google Fonts CDN
9. **Nativni lazy loading** - `loading="lazy"` na svim slikama
10. **Smart image loading:**
    - Hero slike: `loading="eager"`, `fetchpriority="high"`
    - Logo: `loading="eager"`
    - Sve ostale: `loading="lazy"`, `decoding="async"`
11. **Critical CSS inline** - minimalni stilovi u `<head>` za brzo prvo renderovanje

---

## Google Ads (zakomentarisano)

U `functions.php` postoje dva Google Ads bloka koja su komentarisana za lokalno okruzenje:

### 1. Global Tag (u `<head>`):
```php
// Linija ~487 u functions.php
// Na produkciji: ukloni /* i */ oko echo bloka
add_action('wp_head', function () {
    /*
    echo '<!-- Google tag (gtag.js) -->';
    ...
    */
}, 1);
```

### 2. Conversion Tracking (booking success):
```php
// Linija ~505 u functions.php
// Tracking ID: AW-17534135386/OeiCCIjy64IcENrY9qhB
// Na produkciji: ukloni /* i */ oko echo bloka
```
Ovo prati kad korisnik dovrsi booking (kad `.dentalink-step[data-step='success']` dobije `active` klasu).

> **Za produkciju:** Otvori `functions.php`, pronadji oba bloka i ukloni komentar ogranicenja `/* */`.

---

## Vazne hardkodirane vrednosti

| Lokacija | Vrednost | Opis |
|----------|----------|------|
| `header.php:84` | `484` | ID Booking stranice (EN) |
| `header.php:89` | `412` | ID Contact stranice (EN) |
| `header.php:105` | `+34622165781` | Telefon za Call Us dugme u meniju |
| `template-booking.php:96` | `+34935453232` | Telefon za booking sidebar |
| `main.js:178` | `+34622165781` | WhatsApp broj |
| `template-contact.php:95` | Google Maps embed URL | Mapa klinike |
| `template-contact.php:117-130` | CF7 shortcode ID-ovi | Forme po jezicima |
| `gulpfile.js:79` | `https://smitasmile.locals7codesign/` | Lokalni dev URL za BrowserSync |

> Ako se stranice Booking ili Contact obrisu i ponovo naprave, promeni ID-ove u `header.php`.

---

## Razvoj - lokalno okruzenje

### Setup:
```bash
# 1. Instaliraj Node dependencies (jednom)
cd "c:\Users\S7DEVPQ6GF\Local Sites\smitasmile\app\public\wp-content\themes\smitasmile"
npm install

# 2. Pokreni development mode
npm run watch
# ili
npm run serve
```

BrowserSync ce se otvoriti na `http://localhost:3000` i proxirati lokalni sajt.

### Workflow za CSS izmene:
1. Edituj fajlove u `src/scss/`
2. Gulp automatski kompajlira u `dist/css/style.min.css`
3. BrowserSync automatski reloaduje browser

### Workflow za JS izmene:
1. Edituj `src/js/main.js`
2. Gulp automatski minifikuje u `dist/js/main.min.js`
3. BrowserSync automatski reloaduje browser

### Pre deploymenta:
```bash
npm run build
```

### Sta NIKAD ne editovati direktno:
- `dist/` folder - ovo je generisano
- `node_modules/` - package dependencies

### Blogpost / Classic Editor:
Tema forsira Classic Editor (Gutenberg je onemogucen). Na novim WordPress instalacijama instalirati **Classic Editor** plugin.

---

## Favicon

Favicon je custom webp format u `dist/img/favicon.webp`.

U `functions.php` postoji funkcija `smitasmile_secure_favicon()` koja ucitava favicon iz WordPress Customizer-a (polje `custom_favicon` - Attachment ID). Ako Customizer favicon nije postavljen, koristi se hardkodirana putanja u `header.php`.

**Da promenis favicon:**
1. Opcija A: WP Admin > Appearance > Customize > `custom_favicon` (ako je polje kreirano)
2. Opcija B: Zameni `dist/img/favicon.webp` novim fajlom (isti naziv)

---

## Kontakt ikone

U `template-contact.php`, ikone za kontakt stavke se dohvataju iz `dist/img/` foldera. ACF polje `item_icon` treba da sadrzi samo naziv fajla BEZ ekstenzije:

- `phone` → `dist/img/phone.svg`
- `email` → `dist/img/email.svg`
- `address` → `dist/img/address.svg`
- `route` → `dist/img/route.svg`

Da dodas novu ikonu, stavi SVG fajl u `dist/img/` i upiši naziv bez ekstenzije u ACF polje.

---

*Dokumentacija azurirana: Mart 2026*
