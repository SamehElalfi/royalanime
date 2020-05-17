# v1.2
## Added
- added controllers for seasons, anime type and rating with sorting options
- added sorting options to status and tags pages
- created add new post page in the dashboard with TinyMCE editor
- created filemanager page to upload and download files

## Changed
- made Next/Prev/All Episodes in the center
- fixed all links in the home page
- fixed search feild
- some SEO fixes

# v1.1
## Added
- created all roles and permissions
- added an option to edit robots.txt file from dashboard
- finished "add anime" page (frontend & backend)
- finished episode list page /episodes
- added the new anime list in navbar
- add the order/sort by optionin anime list page '/animes'
- installed nicolaslopezj/searchable package
- added /search page with custom search engine

## Changed
- fixed anime sitemap priority
- fixed titles for episodes without one
- fixed episode list for animes with only one episode (it was so small)
- reversed the order of the watch servers by using array_reverse()
- disabled ONLY_FULL_GROUP_BY MYSQL mode to use searchable package
- moved old /search page to /google-search
- added rel="nofollow" to navbar links

----

# v1.0.0
## Added
- Sitemap builder in dashboard /settings/advanced#sitemap

## Changed
- fixed pagination on mobile devices
- fixed telescope on production env (it was't working with auth middleware)

----

# v0.20.0
## Changed
- Added lazy load to slideshow in home page
- translated all argon dashboard to arabic
- remove page-cache from contact page cause it not redirct 'layout.thanks' view
- split links table into watch_links and download_links tables
- resized 'tags.index' page
- fixed navbar icon on mobile and tablet devices
- translated /register page
- set the ratio of the video player 16:9 on all devices
- rebuilt the database tables
- fixed unknow opening & ending music
- enabled comments on animes and episodes

## Added
- installed debugbar package
- installed spatie/laravel-permission
- installed spatie/laravel-sitemap
- installed telescope
- installed ARCANEDEV/log-viewer

----

# 0.19.0
## Changed
- Share Buttons is dynamic now
- finished login page for the dashboard
- fixed tags in anime cards (now it's in the center)

## Added
- add slug mechanism to animes and episodes
- add lazy loading to all images
- add anime covers links
- installed page-cache to cache every page as html file
- installed google-analytics package to get data in the dashboard

----

# 0.18.0
## Changed 
- hide the anime cover on mobiles
- made the anime synopsis and episodes links smaller
- made the search ison in /search page smaller on mobiles
- fixed the background border in anime cards
- translated broadcast column in animes table
- filled created_at and updated_at columns in animes table

## Added
- Installed Argon Dashboard
- Subscription page and form

----

# 0.17.0
# Added
- Google Search page emmbeded in /search page
- Added Tajawal font
- Added tags pages
- made a page to check work servers

## Changed
- fixed share icons on mobiles
- fixed small video player on mobiles
- centered footer icons and links
- translated all status, rating, broadcast and genres columns

----

# 0.16.2
## Changed
- removed comments from css/app.css and minified it.
- removed nucleo icons.
- fixed the background image in anime details page.

----

# 0.16.1
## Changed 
- optimized images by convert JPGs to WEBPs
- fixed /contact page links
- Created Helper function to use cdn.royalanime.com

## Added
- Contect page "/contact"
- changed all assets links to CDN

----

# 0.16.0
## Changed
- Stopped slideshow in /animes page
- stopped disqus comments
- minified js code in /js/app.js
- optimized logo and images
- hide the left side of navbar (social media and search button)

## Added
- google analytics tag

----

# 0.15.0 - 2020-04-26
## Changed
- refactor routes

## Added
- Installed laravel-page-speed package [https://github.com/renatomarinho/laravel-page-speed]
