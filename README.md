# GSAP Background Elementor Widget

A custom WordPress plugin that adds an animated GSAP hero background widget for Elementor. The widget includes a full-screen hero image, scroll-based zoom animation, layered title motion, decorative symbols, frame corners, animated gradient overlays, and multiple GSAP-powered atmosphere effects.

## Features

- Elementor widget: `GSAP Background`
- Default hero image from `images/background.jpg`
- Full-screen image zoom animation powered by GSAP ScrollTrigger
- Two-line editable hero heading
- Layered title motion effect with outline text trails
- Optional frame corner elements
- Optional decorative symbols
- Advanced gradient overlay controls
- Effect preset selector with multiple animated effects
- Effect opacity, speed, intensity, color, rain angle, and snow size controls

## Effect Presets

The widget includes these effect presets:

- None
- Clouds + Mist
- Snow
- Rain
- Light Rays
- Particles
- Neon/Glitch
- Heat Haze
- Fireflies
- Ocean Shimmer

## Requirements

- WordPress
- Elementor
- PHP compatible with your WordPress installation
- Internet access for CDN-loaded GSAP and Google Fonts, unless you replace those assets locally

## Installation

1. Copy the `gsap-background` folder into:

   ```text
   wp-content/plugins/
   ```

2. In WordPress admin, go to **Plugins**.
3. Activate **GSAP Background Elementor Widget**.
4. Open a page with Elementor.
5. Search for **GSAP Background** in the Elementor widgets panel.
6. Drag the widget onto the page.

## Usage

After adding the widget in Elementor:

1. Open the **Content** tab.
2. Choose or replace the hero image.
3. Edit **Heading Line 1** and **Heading Line 2**.
4. Open the **Symbols** panel to show, hide, or edit decorative symbols.
5. Open the **Style** tab.
6. Configure gradient overlay, atmosphere effect preset, frame corners, and heading typography.

## Main Controls

### Content

- Hero Image
- Hero Image Alt Text
- Heading Line 1
- Heading Line 2

### Symbols

- Show Symbols
- Symbol text
- Symbol color
- Symbol size
- Symbol CSS position

### Style

- Show Gradient Overlay
- Gradient colors
- Overlay opacity
- Blend mode
- Effect Preset
- Effect Opacity
- Effect Speed
- Effect Intensity
- Effect Color
- Rain Angle
- Snow Size
- Show Frame Corners
- Heading colors
- Heading typography

## File Structure

```text
gsap-background/
├── assets/
│   ├── css/
│   │   └── gsap-background-widget.css
│   └── js/
│       └── gsap-background-widget.js
├── images/
│   └── background.jpg
├── includes/
│   └── widgets/
│       └── class-gsap-background-widget.php
└── gsap-background.php
```

## Development Notes

- Main plugin bootstrap: `gsap-background.php`
- Elementor widget class: `includes/widgets/class-gsap-background-widget.php`
- Frontend styles: `assets/css/gsap-background-widget.css`
- GSAP animations: `assets/js/gsap-background-widget.js`
- Default image: `images/background.jpg`

The plugin registers GSAP and ScrollTrigger from CDN:

```php
https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js
https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js
```

Google Fonts loaded:

```text
Anton
Space Mono
```

## Customization

To change the default hero image, replace:

```text
images/background.jpg
```

To adjust animation behavior, edit:

```text
assets/js/gsap-background-widget.js
```

To adjust visual styling, edit:

```text
assets/css/gsap-background-widget.css
```

## Troubleshooting

### Widget does not appear in Elementor

- Confirm Elementor is installed and active.
- Confirm the plugin is active.
- Refresh Elementor editor.

### Effects do not animate

- Check browser console for JavaScript errors.
- Confirm GSAP and ScrollTrigger are loading.
- Disable caching/minification temporarily while testing.

### Elementor preview shows an error

- Save the page and reload the Elementor editor.
- Try setting **Effect Preset** to `None`, then choose another preset.
- Check PHP error logs if the preview panel still fails.

## License

Add your preferred license here before publishing to GitHub.

