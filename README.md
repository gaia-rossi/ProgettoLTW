# ProgettoLTW — WEvent

A PHP/PostgreSQL web app for browsing, organizing and joining local events (concerts, exhibitions, sports, theatre), with user registration, login, profiles and event comments. Built with vanilla PHP, jQuery and Bootstrap.

## Structure

```
index.html, paginaIniziale.html, navbar.html   # Landing and home pages
login/            # Login form + PHP auth (bcrypt password check, session, "remember me" cookie)
registrazione/     # Sign-up form + PHP registration (regular user or organizer)
area_riservata/    # Reserved area: edit profile, avatar, password
eventi/            # Event listing, search, details, subscribe/unsubscribe, attendee list
paginaIniziale/    # Home page logic: create event (organizers), list events
post/              # Publish events / post comments
css/, icons/, pictures/, avatars/   # Static assets
bootstrap/, jquery-3.6.0.js          # Front-end libraries
gestione_errori.php                  # Shared error-message page
```

## Features

- **Auth**: registration with hashed passwords (bcrypt), login with session + optional persistent cookie, distinct `organizer` vs regular-user roles.
- **Profile**: reserved area to update name, password, city/region, profile picture and header image.
- **Events**: organizers can create events (name, date, category, info); users can browse/search events, view details, and subscribe/unsubscribe; organizers can see the attendee list.
- **Social**: comments/posts on events.

## Requirements

- PHP with the `pgsql` extension
- PostgreSQL database named `WEvent`

## Run

Serve the project root with a PHP-enabled web server pointed at PostgreSQL with the `WEvent` schema created, then open `index.html`.

## Author

Gaia Rossi