(function ($) {
  'use strict';

  function getCssVar(element, name) {
    return window.getComputedStyle(element).getPropertyValue(name).trim();
  }

  function clearInstance($scope) {
    var previous = $scope.data('gsapBackgroundCleanup');

    if (typeof previous === 'function') {
      previous();
    }
  }

  function initGsapBackground($scope) {
    var root = $scope.find('.gsap-bg-widget').get(0);

    if (!root || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
      return;
    }

    clearInstance($scope);

    gsap.registerPlugin(ScrollTrigger);

    var cursor = root.querySelector('.gsap-bg-cursor');
    var cursorRing = root.querySelector('.gsap-bg-cursor-ring');
    var plasma = root.querySelector('.gsap-bg-wrapper > .gsap-bg-plasma');
    var wrapper = root.querySelector('.gsap-bg-wrapper');
    var heroImg = root.querySelector('.gsap-bg-hero-img');
    var rowA = root.querySelector('.gsap-bg-row-a');
    var rowB = root.querySelector('.gsap-bg-row-b');
    var clouds = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-cloud'));
    var mist = root.querySelector('.gsap-bg-valley-mist');
    var snowflakes = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-snowflake'));
    var raindrops = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-raindrop'));
    var lightRays = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-light-rays span'));
    var particles = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-particle'));
    var neonGlitch = root.querySelector('.gsap-bg-neon-glitch');
    var heatHaze = root.querySelector('.gsap-bg-heat-haze');
    var fireflies = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-firefly'));
    var oceanShimmer = root.querySelector('.gsap-bg-ocean-shimmer');
    var stars = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-deco-star'));
    var brackets = gsap.utils.toArray(root.querySelectorAll('.gsap-bg-bracket'));
    var scanlines = root.querySelector('.gsap-bg-scanlines');
    var mx = 0;
    var my = 0;
    var rx = 0;
    var ry = 0;
    var animations = [];
    var triggers = [];
    var tickers = [];
    var effectSpeed = parseFloat(getCssVar(root, '--effect-speed')) || 32;
    var effectIntensity = Math.max(10, Math.min(100, parseFloat(getCssVar(root, '--effect-intensity')) || 70));
    var snowSize = parseFloat(getCssVar(root, '--snow-size')) || 7;
    var effectLayers = []
      .concat(clouds, snowflakes, raindrops, lightRays, particles, fireflies);

    [mist, neonGlitch, heatHaze, oceanShimmer].forEach(function (layer) {
      if (layer) {
        effectLayers.push(layer);
      }
    });

    if (!plasma || !wrapper || !heroImg || !rowA || !rowB) {
      return;
    }

    function getActiveCount(items) {
      return Math.max(1, Math.ceil(items.length * (effectIntensity / 100)));
    }

    function addTicker(callback) {
      gsap.ticker.add(callback);
      tickers.push(callback);
    }

    function onMouseMove(event) {
      mx = event.clientX;
      my = event.clientY;
      root.classList.add('is-cursor-active');
    }

    function onMouseLeave() {
      root.classList.remove('is-cursor-active');
    }

    root.addEventListener('mousemove', onMouseMove);
    root.addEventListener('mouseleave', onMouseLeave);

    addTicker(function () {
      rx += (mx - rx) * 0.1;
      ry += (my - ry) * 0.1;
      gsap.set(cursor, { x: mx, y: my });
      gsap.set(cursorRing, { x: rx, y: ry });

      if (root.classList.contains('is-cursor-active')) {
        var rect = root.getBoundingClientRect();
        var titleX = (rx - (rect.left + rect.width / 2)) / 35;
        var titleY = (ry - (rect.top + rect.height / 2)) / 35;

        root.style.setProperty('--title-layer-x', titleX.toFixed(2));
        root.style.setProperty('--title-layer-y', titleY.toFixed(2));
      } else {
        root.style.setProperty('--title-layer-x', '0');
        root.style.setProperty('--title-layer-y', '0');
      }
    });

    var bv = {
      b1x: 20,
      b1y: 30,
      b2x: 80,
      b2y: 15,
      b3x: 55,
      b3y: 85,
      b4x: 10,
      b4y: 80
    };

    addTicker(function () {
      plasma.style.background = '\n' +
        'radial-gradient(ellipse 70% 70% at ' + bv.b1x + '% ' + bv.b1y + '%, ' + getCssVar(root, '--pink') + ' 0%, transparent 55%),\n' +
        'radial-gradient(ellipse 60% 60% at ' + bv.b2x + '% ' + bv.b2y + '%, ' + getCssVar(root, '--yellow') + ' 0%, transparent 55%),\n' +
        'radial-gradient(ellipse 65% 65% at ' + bv.b3x + '% ' + bv.b3y + '%, ' + getCssVar(root, '--orange') + ' 0%, transparent 55%),\n' +
        'radial-gradient(ellipse 50% 50% at ' + bv.b4x + '% ' + bv.b4y + '%, ' + getCssVar(root, '--cyan') + ' 0%, transparent 50%),\n' +
        getCssVar(root, '--cream');
    });

    animations.push(gsap.to(bv, {
      b1x: 40,
      b1y: 55,
      b2x: 65,
      b2y: 35,
      b3x: 30,
      b3y: 60,
      b4x: 85,
      b4y: 25,
      duration: 10,
      repeat: -1,
      yoyo: true,
      ease: 'sine.inOut'
    }));

    clouds.forEach(function (cloud, index) {
      var direction = index % 2 === 0 ? 1 : -1;
      animations.push(gsap.to(cloud, {
        x: effectSpeed * direction,
        y: index === 2 ? 8 : 4,
        duration: 9 + index * 3,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: index * 0.7
      }));
    });

    if (mist) {
      animations.push(gsap.to(mist, {
        x: 34,
        opacity: 0.25,
        duration: 7,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
      }));
    }

    var activeSnowflakes = getActiveCount(snowflakes);

    snowflakes.forEach(function (flake, index) {
      if (index >= activeSnowflakes) {
        gsap.set(flake, { display: 'none' });
        return;
      }

      var size = snowSize * (0.65 + (index % 5) * 0.12);
      gsap.set(flake, {
        display: 'block',
        left: ((index * 13) % 100) + '%',
        width: size,
        height: size,
        opacity: 0.45 + (index % 4) * 0.12
      });
      animations.push(gsap.fromTo(flake, {
        y: '-12vh',
        x: (index % 2 ? -12 : 12)
      }, {
        y: '112vh',
        x: (index % 2 ? 42 : -42),
        duration: Math.max(5, 16 - effectSpeed / 8 + (index % 5)),
        repeat: -1,
        ease: 'none',
        delay: index * 0.18
      }));
    });

    var activeRaindrops = getActiveCount(raindrops);

    raindrops.forEach(function (drop, index) {
      if (index >= activeRaindrops) {
        gsap.set(drop, { display: 'none' });
        return;
      }

      gsap.set(drop, {
        display: 'block',
        left: ((index * 11) % 100) + '%',
        opacity: 0.35 + (index % 3) * 0.12
      });
      animations.push(gsap.fromTo(drop, {
        y: '-16vh',
        x: 0
      }, {
        y: '116vh',
        x: 90,
        duration: Math.max(0.45, 2.2 - effectSpeed / 60),
        repeat: -1,
        ease: 'none',
        delay: index * 0.05
      }));
    });

    lightRays.forEach(function (ray, index) {
      gsap.set(ray, { rotation: -12 + index * 10 });
      animations.push(gsap.to(ray, {
        rotation: -5 + index * 8,
        opacity: 0.25 + index * 0.16,
        duration: 5 + index,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
      }));
    });

    var activeParticles = getActiveCount(particles);

    particles.forEach(function (particle, index) {
      if (index >= activeParticles) {
        gsap.set(particle, { display: 'none' });
        return;
      }

      gsap.set(particle, {
        display: 'block',
        left: ((index * 17) % 100) + '%',
        top: (18 + (index * 19) % 68) + '%',
        opacity: 0.35 + (index % 5) * 0.1,
        scale: 0.6 + (index % 4) * 0.2
      });
      animations.push(gsap.to(particle, {
        x: (index % 2 ? 1 : -1) * (18 + effectSpeed / 2),
        y: (index % 3 ? -1 : 1) * (14 + effectSpeed / 3),
        duration: 3.5 + (index % 6) * 0.6,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: index * 0.08
      }));
    });

    if (neonGlitch) {
      animations.push(gsap.to(neonGlitch, {
        x: 12,
        opacity: 0.25,
        duration: 0.18,
        repeat: -1,
        yoyo: true,
        repeatDelay: 1.3,
        ease: 'steps(2)'
      }));
      animations.push(gsap.to([rowA, rowB], {
        textShadow: '8px 0 #0affee, -8px 0 #ff1a8c',
        duration: 0.12,
        repeat: -1,
        yoyo: true,
        repeatDelay: 1.4,
        ease: 'steps(2)'
      }));
    }

    if (heatHaze) {
      animations.push(gsap.to(heatHaze, {
        x: 28,
        skewX: 3,
        duration: Math.max(2.5, 7 - effectSpeed / 16),
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
      }));
    }

    var activeFireflies = getActiveCount(fireflies);

    fireflies.forEach(function (firefly, index) {
      if (index >= activeFireflies) {
        gsap.set(firefly, { display: 'none' });
        return;
      }

      gsap.set(firefly, {
        display: 'block',
        left: ((index * 23) % 100) + '%',
        top: (28 + (index * 17) % 60) + '%',
        opacity: 0.2,
        scale: 0.65 + (index % 4) * 0.18
      });
      animations.push(gsap.to(firefly, {
        x: (index % 2 ? 1 : -1) * (24 + effectSpeed / 2),
        y: (index % 3 ? -1 : 1) * (20 + effectSpeed / 3),
        opacity: 0.95,
        duration: 2.4 + (index % 5) * 0.5,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: index * 0.14
      }));
    });

    if (oceanShimmer) {
      animations.push(gsap.to(oceanShimmer, {
        x: 54,
        backgroundPosition: '120px 0, 0 0',
        duration: Math.max(3, 10 - effectSpeed / 10),
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut'
      }));
    }

    stars.forEach(function (star, index) {
      animations.push(gsap.to(star, {
        y: -20,
        rotation: 25 + index * 10,
        scale: 1.15,
        duration: 2.5 + index * 0.6,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
        delay: index * 0.3
      }));
    });

    gsap.set([rowA, rowB], { yPercent: 105 });
    gsap.set(brackets, { opacity: 0 });

    var intro = gsap.timeline({ delay: 0.15 });
    animations.push(intro);

    intro
      .to(rowA, { yPercent: 0, duration: 0.9, ease: 'power3.out' })
      .to(rowB, { yPercent: 0, duration: 0.9, ease: 'power3.out' }, '-=0.65')
      .to(brackets, { opacity: 1, duration: 0.4, stagger: 0.08, ease: 'power2.out' }, '-=0.4');

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: wrapper,
        start: 'top top',
        end: '+=180%',
        pin: true,
        scrub: 1
      }
    });
    animations.push(tl);
    triggers.push(tl.scrollTrigger);

    var zoomLayers = [heroImg].concat(effectLayers);

    tl
      .fromTo(zoomLayers, { scale: 1, z: 0 }, { scale: 2.2, z: 350, transformOrigin: 'center center', ease: 'power1.inOut' }, 0)
      .fromTo(rowA, { yPercent: 0, opacity: 1 }, { yPercent: -120, opacity: 0, ease: 'power2.in' }, 0)
      .fromTo(rowB, { yPercent: 0, opacity: 1 }, { yPercent: 120, opacity: 0, ease: 'power2.in' }, 0);

    stars.forEach(function (star, index) {
      var xDirection = index % 4 < 2 ? -1 : 1;
      var yDirection = index % 2 === 0 ? -1 : 1;
      var distance = index % 3 === 0 ? 80 : 60;

      tl.fromTo(
        star,
        { x: 0, y: 0, opacity: 1 },
        { x: distance * xDirection, y: (distance + 10) * yDirection, opacity: 0, ease: 'power2.in' },
        0
      );
    });

    tl
      .fromTo(brackets, { scale: 1, opacity: 1 }, { scale: 0.5, opacity: 0, ease: 'power2.in' }, 0)
      .fromTo(plasma, { opacity: 1 }, { opacity: 0, ease: 'power2.in' }, 0.3)
      .fromTo(scanlines, { opacity: 0.6 }, { opacity: 1.5, ease: 'none' }, 0);

    ScrollTrigger.refresh();

    $scope.data('gsapBackgroundCleanup', function () {
      root.removeEventListener('mousemove', onMouseMove);
      root.removeEventListener('mouseleave', onMouseLeave);
      tickers.forEach(function (ticker) {
        gsap.ticker.remove(ticker);
      });
      triggers.forEach(function (trigger) {
        if (trigger) {
          trigger.kill();
        }
      });
      animations.forEach(function (animation) {
        if (animation) {
          animation.kill();
        }
      });
      var cleanupTargets = [root, wrapper, heroImg, rowA, rowB, plasma, scanlines].concat(effectLayers, stars, brackets);

      gsap.set(cleanupTargets, { clearProps: 'all' });
    });
  }

  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/gsap_background.default', initGsapBackground);
  });
})(jQuery);
