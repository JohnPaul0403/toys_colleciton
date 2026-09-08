---
paths:
  - 'resources/js/**'
---

# Js

## Single Monokai retro dark theme; no light mode
The app uses one persistent dark theme based on the Monokai palette (background #272822, pink/orange/yellow/green/cyan/purple accents, sharp corners, beveled borders on cards/buttons/inputs). Do not add light mode back: the appearance middleware/cookie/toggle were removed, html always has the `dark` class, and all theme values live in `:root` in resources/css/app.css.
