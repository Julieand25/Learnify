<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify - Experience SPM Learning Like Never Before</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        /* ═══════════════════════
           PAGE WRAPPER
        ═══════════════════════ */
        .page {
            display: flex;
            height: 100vh;
            width: 100%;
            background: #dff4f2;
        }

        /* ═══════════════════════
           LEFT PANEL
        ═══════════════════════ */
        .left-panel {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding: 60px 60px 60px 140px;
        }

        /* Brand / Logo */
        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
        }

        .brand img {
            width: 150px;
            height: auto;
        }

        .brand-name {
            font-size: 1.7rem;
            font-weight: 800;
            color: #1c3d6b;
            letter-spacing: 4px;
            text-align: center;
        }

        /* Headline */
        .headline {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.2;
            margin-bottom: 24px;
        }

        /* Description */
        .description {
            font-size: 0.9rem;
            color: #555;
            line-height: 1.7;
            max-width: 420px;
            margin-bottom: 40px;
        }

        /* CTA Button */
        .btn-cta {
            display: inline-block;
            padding: 14px 32px;
            background: #2e8b84;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s;
            margin-bottom: 40px;
        }

        .btn-cta:hover { opacity: 0.88; }

        /* Testimonial quote */
        .quote {
            font-size: 0.8rem;
            color: #666;
            line-height: 1.7;
            max-width: 650px;
            font-style: italic;
        }

        /* ═══════════════════════
           RIGHT PANEL
        ═══════════════════════ */
        .right-panel {
            width: 560px;
            flex-shrink: 0;
            background: #dff4f2;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            position: relative;
            border-radius: 50% 0 0 50% / 50% 0 0 50%;
            overflow: visible;
            padding: 60px 90px 60px 60px;
        }

        /* Fat circle blob */
        .circle-blob {
            width: 650px;
            height: 920px;
            background: #dff4f2;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: -60px;
        }

        /* Image slider container */
        .slider-wrap {
            width: 430px;
            height: 470px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
        }

        /* Slide dots */
        .dots {
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            cursor: pointer;
            transition: background 0.3s;
        }

        .dot.active {
            background: #fff;
        }

        /* ═══════════════════════
           TABLET (≤ 1100px)
        ═══════════════════════ */
        @media (max-width: 1100px) {
            .right-panel {
                width: 380px;
            }

            .circle-blob {
                width: 460px;
                height: 600px;
                margin-right: -80px;
            }

            .slider-wrap {
                width: 280px;
                height: 280px;
            }

            .headline { font-size: 2.4rem; }

            .left-panel { padding: 50px 40px 50px 50px; }
        }

        /* ═══════════════════════
           MOBILE (≤ 767px)
        ═══════════════════════ */
        @media (max-width: 767px) {
            .page {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }

            .left-panel {
                width: 100%;
                align-items: center;
                text-align: center;
                padding: 50px 24px 40px;
                order: 2;
            }

            .description { max-width: 100%; }
            .quote { max-width: 100%; }

            .right-panel {
                width: 100%;
                border-radius: 0 0 40% 40% / 0 0 50px 50px;
                justify-content: center;
                padding: 50px 20px 80px;
                overflow: hidden;
                order: 1;
            }

            .circle-blob {
                width: auto;
                height: auto;
                background: transparent;
                border-radius: 0;
                margin-right: 0;
            }

            .slider-wrap {
                width: 260px;
                height: 260px;
            }

            .headline { font-size: 2rem; }

            .brand { margin-bottom: 32px; }
        }

        /* ═══════════════════════
           SMALL MOBILE (≤ 480px)
        ═══════════════════════ */
        @media (max-width: 480px) {
            .headline { font-size: 1.7rem; }
            .brand img { width: 80px; }
            .brand-name { font-size: 1rem; letter-spacing: 3px; }
            .btn-cta { padding: 12px 26px; font-size: 0.88rem; }
            .slider-wrap { width: 220px; height: 220px; }
        }
    </style>
</head>
<body>

<div class="page">

    {{-- ── LEFT PANEL ── --}}
    <div class="left-panel">

        {{-- Brand --}}
        <div class="brand">
            <img src="{{ asset('images/learnify-logo.png') }}" alt="Learnify Logo">
            <p class="brand-name">LEARNIFY</p>
        </div>

        {{-- Headline --}}
        <h1 class="headline">
            Experience SPM<br>
            learning like<br>
            never before
        </h1>

        {{-- Description --}}
        <p class="description">
            Transform static textbooks into interactive experiences.
            Master the Malaysian SPM syllabus with dynamic
            simulations, smart quizzes, and real-time progress tracking
        </p>

        {{-- CTA --}}
        <a href="{{ route('login') }}" class="btn-cta">Get Started for Free</a>

        {{-- Quote --}}
        <p class="quote">
            "Learnify is designed to bridge the gap between textbook theory and real-world understanding.
            Whether it's Physic, Mathematic, or Biology, we transform static notes into dynamic experiences."
        </p>

    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="right-panel">
        <div class="circle-blob">

            {{-- Image Slider --}}
            <div class="slider-wrap" id="slider">
                <div class="slide active">
                    <img src="{{ asset('images/sp-photo1.png') }}" alt="Student 1">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/sp-photo2.png') }}" alt="Student 2">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/sp-photo3.png') }}" alt="Student 3">
                </div>
                <div class="slide">
                    <img src="{{ asset('images/sp-photo4.png') }}" alt="Student 4">
                </div>

                {{-- Dots --}}
                <div class="dots">
                    <div class="dot active" onclick="goToSlide(0)"></div>
                    <div class="dot" onclick="goToSlide(1)"></div>
                    <div class="dot" onclick="goToSlide(2)"></div>
                    <div class="dot" onclick="goToSlide(3)"></div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    // ── Overflow lock (same pattern as login) ──
    function handleOverflow() {
        if (window.innerWidth > 767) {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        } else {
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
        }
    }
    handleOverflow();
    window.addEventListener('resize', handleOverflow);

    // ── Image slider ──
    let current = 0;
    const slides = document.querySelectorAll('.slide');
    const dots   = document.querySelectorAll('.dot');

    function goToSlide(index) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = index;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function nextSlide() {
        goToSlide((current + 1) % slides.length);
    }

    // Auto-advance every 3 seconds
    let timer = setInterval(nextSlide, 3000);

    // Reset timer when user manually clicks a dot
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            clearInterval(timer);
            goToSlide(i);
            timer = setInterval(nextSlide, 3000);
        });
    });
</script>

</body>
</html>