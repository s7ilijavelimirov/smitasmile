# THEME-AUDIT.md — Smitasmile WordPress Tema

> **Datum audita:** 2026-03-05
> **Verzija teme:** 1.0.0
> **Pregledano fajlova:** 43 PHP fajla
> **Pregledano:** `functions.php`, svi fajlovi u `inc/`, svi template i template-parts fajlovi
> **Preskočeno:** `dist/`, `.scss`, `.js` fajlovi

---

## 1. Security Audit

### 1.1 Nedostajući escaping / sanitizacija izlaza

| Fajl | Linija | Problem | Fix |
|------|--------|---------|-----|
| `functions.php` | 312 | `get_permalink()` u `excerpt_more` filteru bez `esc_url()` | `esc_url( get_permalink() )` |
| `footer.php` | 30 | `bloginfo('name')` u `alt=""` atributu — `bloginfo()` ne escapuje za atribute | `echo esc_attr( get_bloginfo('name') )` |
| `footer.php` | 41 | `bloginfo('name')` u anchor textu bez escapinga | `echo esc_html( get_bloginfo('name') )` |
| `header.php` | 14 | `bloginfo('description')` u `<meta content="">` bez `esc_attr` | `echo esc_attr( get_bloginfo('description') )` |
| `template-booking.php` | 55 | `get_bloginfo('name')` direktno u `<h1>` bez escapinga | `echo esc_html( get_bloginfo('name') )` |
| `template-smita-team.php` | 170 | `echo $icon_svg` — SVG string bez `wp_kses_post()` | `echo wp_kses_post( $icon_svg )` |
| `template-smita-team.php` | 206 | `echo $icon_svg` — SVG string za social ikone bez `wp_kses_post()` | `echo wp_kses_post( $icon_svg )` |
| `template-parts/gallery-masonry.php` | 47 | `data-url="<?php echo $image_url; ?>"` — varijabla je escaped na liniji 36, ali `echo` bez `esc_` funkcije je loš pattern | `echo esc_url( $image_url )` |
| `template-parts/gallery-masonry.php` | 50 | `src="<?php echo $image_url; ?>"` — isti problem kao gore | `echo esc_url( $image_url )` |
| `search.php` | 21 | `get_search_query()` direktno u `printf()` bez `esc_html()` — **XSS ranjivost** kroz search string koji korisnik kontroliše | `esc_html( get_search_query() )` |
| `author.php` | 31 | `the_author_meta('display_name')` bez escapinga direktno u `<h1>` — korisnik može imati HTML karaktere u display imenu | `echo esc_html( get_the_author_meta('display_name') )` |
| `tag.php` | 22 | `single_tag_title()` bez eksplicitnog `esc_html()` u `<h1>` — naziv taga iz baze bez zaštite | `echo esc_html( single_tag_title('', false) )` |
| `functions.php` | 461 | `echo '<p>' . __('...', 'smitasmile') . '</p>'` — `__()` ne escapuje HTML; ako `.po` fajl bude kompromitovan, moguć XSS | `esc_html__( '...', 'smitasmile' )` |

**Napomena o `bloginfo()`:** WordPress `bloginfo()` funkcija ima interno escaping za neke kontekste, ali se ponašanje razlikuje zavisno od parametra. Eksplicitni `esc_attr()` / `esc_html()` oko `get_bloginfo()` je uvek ispravan i preporučen pristup.

---

### 1.2 KRITIČNO: 404.php — Header Injection i mrtva stranica

**`404.php`, linije 2–4** — ovo je najozbiljniji sigurnosni problem u celoj temi:

```php
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".get_bloginfo('url'));
exit();
```

**Problemi:**
1. **Header Injection rizik:** `get_bloginfo('url')` se koristi direktno u `header()` bez `esc_url_raw()`. Ako site URL sadrži newline karaktere (npr. usled manipulacije u bazi), napadač može ubaciti dodatne HTTP headere.
2. **Ispravno rešenje:** Koristiti WordPress `wp_redirect( home_url('/'), 301 )` umesto native PHP `header()` — WP interno validira URL.
3. **Funkcionalni bug:** `exit()` na liniji 4 ubija čitavu stranicu ispod. Sve od linije 6 do 66 je mrtav kod koji se **nikada ne izvršava** — 404 stranica nikada nije prikazana, svi korisnici su tiho preusmereni na homepage sa 301 statusom. Ovo loše utiče na SEO i korisničko iskustvo.
4. **Pogrešan textdomain:** Ceo fajl ispod linije 4 koristi textdomain `'likedaheim'` (stari predak teme) umesto `'smitasmile'`.

| Fajl | Linija | Problem |
|------|--------|---------|
| `404.php` | 2–4 | Native PHP `header()` + `get_bloginfo()` bez escaping — koristiti `wp_redirect( home_url('/'), 301 )` |
| `404.php` | 6–66 | Kompletna 404 stranica je dead code zbog `exit()` na liniji 4 |
| `404.php` | 22, 26, 35, 53 | Textdomain `'likedaheim'` umesto `'smitasmile'` |

---

### 1.4 Direktan pristup fajlovima — nedostajući ABSPATH checkovi

Nijedan fajl iz `template-parts/` direktorijuma nema standardnu WordPress zaštitu od direktnog pristupa na vrhu fajla:

```php
defined( 'ABSPATH' ) || exit;
```

**Pogođeni fajlovi (svi u `template-parts/`):**

- `template-parts/intro-section.php` — linija 1 (nema check)
- `template-parts/cta-banner.php` — linija 1 (nema check)
- `template-parts/gallery-masonry.php` — linija 1 (nema check)
- `template-parts/content.php` — linija 1 (nema check)
- `template-parts/content-page.php` — linija 1 (nema check)
- `template-parts/content-search.php` — linija 1 (nema check)
- `template-parts/content-none.php` — linija 1 (nema check)
- `template-parts/homepage/hero.php` — linija 1 (nema check)
- `template-parts/homepage/treatments.php` — linija 1 (nema check)
- `template-parts/homepage/team.php` — linija 1 (nema check)
- `template-parts/homepage/partners.php` — linija 1 (nema check)
- `template-parts/homepage/founder.php` — linija 1 (nema check)
- `template-parts/homepage/smile-makeovers.php` — linija 1 (nema check)

> **Rizik:** Nizak u produkciji (PHP fajlovi bez ABSPATH vraćaju praznu stranicu), ali je dobra praksa i preporučena od strane WordPress Theme Handbook.

---

### 1.5 Nonce verifikacija na formama i AJAX callovima

| Lokacija | Status | Detalji |
|----------|--------|---------|
| `functions.php:466` — meta box forma | ✅ Ispravno | `wp_nonce_field('smitasmile_blog_meta_box', ...)` |
| `functions.php:534` — meta box save | ✅ Ispravno | `wp_verify_nonce()` + `current_user_can()` check |
| `template-contact.php` — CF7 forma | ✅ Ispravno | Contact Form 7 plugin interno generiše i verifikuje nonce |
| `functions.php:154-157` — AJAX `smitasmileAjax` | ✅ Ispravno | `wp_create_nonce('smitasmile_nonce')` u localize_script |

> Nonce implementacija je dobra. Nema custom AJAX handlera u PHP-u koji bi zahtevao dodatnu verifikaciju.

---

### 1.6 Hardcoded podaci koji predstavljaju rizik

- **`header.php:84`** — `pll_get_post(484)` — hardcoded ID Booking stranice. Ako se stranica obriše i kreira nova, link se gubi bez upozorenja.
- **`header.php:89`** — `pll_get_post(412)` — hardcoded ID Contact stranice. Isti rizik.
- **`template-contact.php:15-16`** — Fiksna verzija `intl-tel-input@18.2.1` na CDN-u bez Subresource Integrity (SRI) hasha. Ako CDN bude kompromitovan, maliciozni kod može biti učitan.

---

### Ocena Security: **5/10**

**Obrazloženje:** Osnovna sigurnost ima ozbiljnih propusta. Kritičan bug u `404.php` (native PHP `header()` + neescaped URL + funkcionalno mrtva 404 stranica). XSS ranjivost u `search.php` kroz korisnički kontrolisan search string. Ukupno 12 lokacija sa nedostajućim escapingom, 13 template-parts fajlova bez ABSPATH checka. Pozitivno: nonce je implementiran na meta boxu, CF7 forme su zaštićene, nema SQL injection problema.

---

## 2. Performance Audit

### 2.1 Nepotrebni query-ji ili N+1 problemi

| Fajl | Linija | Problem |
|------|--------|---------|
| `template-smita-team.php` | 37–44 | `WP_Query` sa `posts_per_page => -1` — učitava **sve** team membere odjednom bez paginacije ili transient cache-inga |
| `template-smita-team.php` | 54 | `get_field('team_position_title')` + `get_field('team_specialization')` + `get_field('team_bio')` pozivi unutar `while` petlje — svaki ACF `get_field()` poziv interno poziva `get_post_meta()`, što sa velikim brojem članova može biti N+1 |
| `footer.php` | 22–24 | `get_theme_mod('custom_logo')` + `wp_get_attachment_image_src()` pozivaju se **dva puta** u `footer.php` (i po 2x u `header.php`) — logo se može cache-ovati u varijablu jednom |

**Pozitivno:** Nema N+1 anti-patterna u petljama za ACF repeater polja — svi repeater podaci se dohvataju jednim `get_field()` pozivom pre petlje.

---

### 2.2 Assets koji blokiraju render

| Fajl | Linija | Problem |
|------|--------|---------|
| `functions.php` | 143 | `wp_enqueue_style('smitasmile-style', ...)` bez version stringa (drugi arg je URL, četvrti je `null`) — bez versije, browser cache može učitati stari CSS |
| `functions.php` | 145 | `wp_enqueue_script('bootstrap-js', ..., false, true)` — `false` kao verzija generiše URL bez `?ver=` parametra |
| `functions.php` | 148 | `wp_enqueue_script('swiper-js', ..., false, true)` — isto kao gore |
| `functions.php` | 151 | `wp_enqueue_script('smitasmile-main', ..., false, true)` — isto kao gore |
| `template-contact.php` | 15–16 | `wp_enqueue_style()` i `wp_enqueue_script()` za `intl-tel-input` pozvani unutar **template fajla** umesto u `functions.php` kroz `wp_enqueue_scripts` akciju — ovo je anti-pattern koji otežava dequeue i upravljanje zavisnostima |
| `inc/customizer.php` | 59 | Referira `get_template_directory_uri() . '/js/customizer.js'` — ovaj fajl **ne postoji** (treba biti `/dist/js/`). Ovo generiše 404 grešku u Customizer preview-u |

**Pozitivno:** Bootstrap, Swiper i main JS su ispravno defer-ovani (`wp_script_add_data(..., 'strategy', 'defer')`). Preconnect i DNS-prefetch za Google Fonts su implementirani.

---

### 2.3 Nedostajuća lazy load implementacija

| Fajl | Linija | Problem |
|------|--------|---------|
| `template-parts/homepage/team.php` | 66 | `<img>` tag bez `width` i `height` atributa — uzrokuje **Cumulative Layout Shift (CLS)** jer browser ne zna dimenzije pre učitavanja |
| `template-smita-team.php` | 68 | Isti problem — `<img src="..." loading="lazy">` bez dimenzija |

**Pozitivno:** `loading="lazy"` je ispravno implementiran na svim ostalim slikama. Hero slike koriste `loading="eager"` i `fetchpriority="high"`. `wp_img_tag_add_loading_attr` filter je aktivan. `wp_get_attachment_image()` funkcija se koristi gde je to moguće (automatski dodaje dimenzije).

---

### Ocena Performance: **7/10**

**Obrazloženje:** Tema ima solidnu performance osnovu — defer skripte, preload, lazy load, inline critical CSS. Glavni problemi su nedostajuće verzije asseta (cache busting), CLS zbog slika bez dimenzija, WP_Query bez limita na team stranici, i neispravna putanja do `customizer.js`.

---

## 3. Code Quality

### 3.1 WordPress Coding Standards — naming conventions

WordPress zahteva `snake_case` za nazive funkcija, sa prefiksom koji identifikuje temu/plugin.

| Fajl | Linija | Problem | Ispravno |
|------|--------|---------|----------|
| `inc/template-functions.php` | 14 | `Smitasmile_body_classes()` — PascalCase | `smitasmile_body_classes()` |
| `inc/template-functions.php` | 27 | `add_filter('body_class', 'Smitasmile_body_classes')` | uskladiti sa novim imenom |
| `inc/template-functions.php` | 32 | `Smitasmile_pingback_header()` — PascalCase | `smitasmile_pingback_header()` |
| `inc/template-functions.php` | 37 | `add_action('wp_head', 'Smitasmile_pingback_header')` | uskladiti |
| `inc/customizer.php` | 13 | `Smitasmile_customize_register()` — PascalCase | `smitasmile_customize_register()` |
| `inc/customizer.php` | 35 | `add_action('customize_register', 'Smitasmile_customize_register')` | uskladiti |
| `inc/customizer.php` | 42 | `Smitasmile_customize_partial_blogname()` — PascalCase | `smitasmile_customize_partial_blogname()` |
| `inc/customizer.php` | 51 | `Smitasmile_customize_partial_blogdescription()` — PascalCase | `smitasmile_customize_partial_blogdescription()` |
| `inc/customizer.php` | 58 | `Smitasmile_customize_preview_js()` — PascalCase | `smitasmile_customize_preview_js()` |
| `functions.php` | 13 | `theme_setup()` — generički naziv bez prefiksa | `smitasmile_setup()` |
| `functions.php` | 40 | `add_action('after_setup_theme', 'theme_setup')` | uskladiti |
| `functions.php` | 141 | `theme_enqueue_scripts()` — bez prefiksa | `smitasmile_enqueue_scripts()` |
| `functions.php` | 163 | `add_action('wp_enqueue_scripts', 'theme_enqueue_scripts')` | uskladiti |
| `functions.php` | 248 | `theme_widgets_init()` — bez prefiksa | `smitasmile_widgets_init()` |
| `functions.php` | 299 | `add_action('widgets_init', 'theme_widgets_init')` | uskladiti |
| `functions.php` | 304 | `theme_custom_excerpt_length()` — bez prefiksa | `smitasmile_custom_excerpt_length()` |
| `functions.php` | 310 | `theme_custom_excerpt_more()` — bez prefiksa | `smitasmile_custom_excerpt_more()` |
| `comments.php` | 35 | Textdomain `'Smitasmile'` (PascalCase) umesto `'smitasmile'` | `'smitasmile'` (sva mala slova) |

**Dodatno — nekonzistentna indentacija:**
- `functions.php` — koristi tabulatore (tabs) ✓
- `template-contact.php`, `template-booking.php`, `template-treatments.php` — koriste 4 razmaka umesto tabova

---

### 3.2 Deprecated funkcije

| Fajl | Linija | Funkcija | Status |
|------|--------|----------|--------|
| `inc/template-tags.php` | 70 | `comments_popup_link()` | Deprecated u WP 4.5, vraćena u WP 5.4 — trenutno OK ali treba pratiti |

> Nema ozbiljno deprecated funkcija. Tema ne koristi `create_function()`, `the_author()` (stari API), niti `wp_get_post_thumbnail()`.

---

### 3.3 Hardcoded stringovi koji bi trebali biti translatable

| Fajl | Linija | String | Fix |
|------|--------|--------|-----|
| `template-parts/gallery-masonry.php` | 13 | `'No gallery images found.'` — bez `__()` | `__( 'No gallery images found.', 'smitasmile' )` |
| `template-parts/homepage/smile-makeovers.php` | 20 | `'After'` — fallback u ternary bez `__()` | `__( 'After', 'smitasmile' )` |
| `template-parts/homepage/smile-makeovers.php` | 21 | `'Before'` — fallback bez `__()` | `__( 'Before', 'smitasmile' )` |
| `template-parts/homepage/smile-makeovers.php` | 22 | `'Tap'` — fallback bez `__()` | `__( 'Tap', 'smitasmile' )` |
| `template-success-stories.php` | 105 | `'After'` — isti fallback | `__( 'After', 'smitasmile' )` |
| `template-success-stories.php` | 106 | `'Before'` — isti fallback | `__( 'Before', 'smitasmile' )` |
| `template-success-stories.php` | 107 | `'Tap'` — isti fallback | `__( 'Tap', 'smitasmile' )` |
| `header.php` | 53 | `<strong>SMITA</strong>` — hardcoded naziv klinike | Koristiti `get_bloginfo('name')` |
| `header.php` | 174 | `'Advanced Smile Design'` — hardcoded tagline | Koristiti `get_bloginfo('description')` |

---

### 3.4 Dead code / nekorišćene funkcije

| Fajl | Linije | Opis |
|------|--------|------|
| `template-success-stories.php` | 17–83 | Zakomentarisana kompletna "What Lead Us to Success" sekcija (65 linija) |
| `template-success-stories.php` | 86–97 | Zakomentarisan drugi testimonials blok (12 linija) |
| `functions.php` | 486–496 | Zakomentarisan Google Ads gtag.js global tag (sa napomenom o produkciji) |
| `functions.php` | 509–527 | Zakomentarisan Google Ads conversion tracking script (sa napomenom o produkciji) |
| `front-page.php` | 25 | `get_template_part('template-parts/homepage/treatments')` — zakomentarisan |
| `front-page.php` | 28 | `get_template_part('template-parts/homepage/team')` — zakomentarisan |
| `front-page.php` | 31 | `<h1>` za Instagram Feed naslov — zakomentarisan unutar `echo do_shortcode()` bloka |
| `template-gallery.php` | 24–39 | Zakomentarisan CTA button blok sa 360 tour |
| `template-gallery.php` | 44–46 | Zakomentarisan `<iframe>` sa theasys.io virtuelnom turom |
| `functions.php` | 228–229 | `// RESOURCE HINTS` komentar bez sadržaja — prazan blok |
| `404.php` | 6–66 | Kompletna 404 stranica je dead code — nikada se ne izvršava zbog `exit()` na liniji 4 |

**Napomena o Google Ads kodu:** Zakomentarisan kod je namerno ostavljen za produkcijsku implementaciju. Bolje rešenje bi bio environment check: `if ( defined('WP_ENV') && 'production' === WP_ENV )`.

---

### 3.5 Ostali code quality problemi

| Fajl | Linija | Problem |
|------|--------|---------|
| `template-booking.php` | 14–17 | `function booking_pll()` definisana unutar template fajla — funkcije treba definisati u `functions.php` ili `inc/` fajlovima |
| `inc/smitateam.php` | 114 | Inline CSS `style="width: 150px; height: 150px; object-fit: cover; border-radius: 4px;"` u admin koloni |
| `inc/smitateam.php` | 117 | Inline CSS `style="color: #999; font-size: 12px;"` |
| `inc/template-tags.php` | 58 | `printf()` bez escapinga na `$categories_list` — WP generiše ovu vrednost ali `wp_kses_post()` je preporučen |
| `inc/template-tags.php` | 64 | `printf()` bez escapinga na `$tags_list` — isti slučaj |
| `header.php` | 84, 89 | Hardcoded page ID-jevi `484` i `412` direktno u kodu — krhko rešenje |
| `inc/custom-header.php` | — | Fajl postoji ali nije uključen u `functions.php` (nije vidljiv `require_once`) |
| `author.php` | 52 | `$current_lang = pll_current_language()` — varijabla deklarisana, **nikad se ne koristi** u fajlu |
| `tag.php` | 36 | Isti problem — `$current_lang = pll_current_language()` nikad se ne koristi |
| `search.php` | 21 | Textdomain `'Smitasmile'` (PascalCase) — treba `'smitasmile'` |
| `404.php` | 22, 26, 35, 53 | Textdomain `'likedaheim'` — ostaci starog parent tema, treba `'smitasmile'` |
| `template-parts/homepage/smile-makeovers.php` | 125 | `rel="noopener"` bez `noreferrer` za `target="_blank"` linkove | `rel="noopener noreferrer"` |
| `template-contact.php` | 98 | Inline CSS `style="border:0; filter: grayscale(100%); border-radius:10px;"` direktno na `<iframe>` tagу |

---

### Ocena Code Quality: **5/10**

**Obrazloženje:** Tema ima dobru strukturu i modularni pristup, ali narušava WordPress Coding Standards u 18+ lokacija sa pogrešnim nazivima funkcija (PascalCase). Postoji značajna količina dead code-a (zakomentarisani blokovi u 5 fajlova), nekonzistentna indentacija i nekoliko anti-patterna (funkcija u template fajlu, inline CSS u PHP-u).

---

## 4. Ukupna Ocena

### **Finalna ocena: 6/10**

| Oblast | Ocena | Težina |
|--------|-------|--------|
| Security | 5/10 | Visoka |
| Performance | 7/10 | Visoka |
| Code Quality | 5/10 | Srednja |
| **Prosek** | **5.7/10** | |

---

### Top 3 prioriteta za fix

#### Prioritet 1 — Security: 404.php + escaping izlaza (kritično)
**Fajlovi:** `404.php:2-4`, `search.php:21`, `functions.php:312`, `footer.php:30,41`, `header.php:14`, `author.php:31`, `tag.php:22`, `template-smita-team.php:170,206`

Najhitniji fix je `404.php` — cela 404 stranica je funkcionalno mrtva i svi korisnici se preusmeravaju na homepage. Zameniti native PHP `header()` sa `wp_redirect()`:

```php
// 404.php — ispravno (zamenjuje linije 2-4)
wp_redirect( home_url( '/' ), 301 );
exit;
```

Zatim dodati `esc_html()` na `search.php:21` (XSS kroz search query) i ostale escape propuste na ukupno 12 lokacija.

#### Prioritet 2 — Code Quality: Preimenovati funkcije po WPCS (važno za dugoročno održavanje)
**Fajlovi:** `functions.php`, `inc/template-functions.php`, `inc/customizer.php`

18+ funkcija krši WordPress Coding Standards. Ovo direktno utiče na mogućnost korišćenja alata poput PHPCS, uklanjanje hook-ova u child temama i profesionalnost koda. Preimenovanje zahteva ažuriranje i odgovarajućih `add_action`/`add_filter` poziva.

#### Prioritet 3 — Performance: Verzionisanje asseta + CLS fix (preporučeno)
**Fajlovi:** `functions.php:143-151`, `template-parts/homepage/team.php:66`, `template-smita-team.php:68`

Dodati version string na enqueue pozive (može koristiti `_S_VERSION` konstanta koja je već definisana):
```php
wp_enqueue_style( 'smitasmile-style', get_template_directory_uri() . '/dist/css/style.min.css', array(), _S_VERSION );
```

Dodati `width` i `height` atribute na team card slike da eliminiše CLS koji negativno utiče na Core Web Vitals score.

---

*Audit uradio: Claude (Anthropic) | claude-sonnet-4-6*
