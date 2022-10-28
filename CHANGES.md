#### [unreleased]

* Remove fat from custom admin CSS
* Better user interface and default color scheme
* WP pages (About, Credits, Freedom, Privacy) under `Dashboard` main menu

#### 0.1.6

Functionalities
* Hide WordPress update nag to all but admins
* Hide Wordpress `PHP version` upgrade nag
* Hide some invasive plugins nags
* Disable administration email verification prompt
* Howdy? No more in `admin bar`
* Remove ajacent post prefetching (head)
* Add photo credit info to images
* Remove comments support and interface (inactive by default)
* Add a ID column for posts and pages
* Reusable Blocks: now in `submenu` under `Apparence`

Bugs and problems
* Remove access to themes and plugins files Edit for WP 6.1 

#### 0.1.5

Correcting the crash of version 0.1.4: parse error: two `<?php` tags in `engine/wordpress-config.php` file (see f0268f9b). Crappy code, sorry!

#### 0.1.4
Functionalities
* Redirect single user after successful login
* Add `Bye bye JQuery`(for frontend) 
* Remove useless options from user profile
* Remove the color picker from profile admin page
* Redirect user after successful login  

Enhancements
* Add a changelog: `CHANGES.md` (git-updater)

Bugs and problems
* Remove generator in head (was incomplete)
* Correct deprecated code for login page logo (#4)

#### 0.1.3

Functionalities
* Removing the "capital P dangit" function (suck)
* Remove DNS prefetch (privacy)
* Remove WP Emoji DNS prefetch (performances)

Bugs and problems
* Remove `generator` in head (was incomplete)

#### 0.1.2
_Test release for git-updater pluggin, no real changes_

Enhancements
* Add `git` support for updates

#### Initial commit

Functionalities
* Remove the admin bar in public site for all users
* Remove title prefix from archives pages
* Better RSS feeds (add thumbnail image and delay publishing)
* Clean and simple login page
* Stop WordPress to send too much mails
* Sanitize media name (all lower case)
* Disable attachement permalink
* Remove post format support (in case)
* Disable eimoji
* Prevent self ping
* No error message on login page
* Disable WP Registration Page
* No Password recovery link on login page
* No way to list user accounts from outside admin
* Clean-up site `head` from useless mentions

Bugs and problems
* None known ;-)
