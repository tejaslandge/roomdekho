<style>
    @media (prefers-reduced-motion: no-preference) {
        html { scroll-behavior: smooth; }
    }

    .doc-page {
        --doc-ink: #172033;
        --doc-muted: #6b7280;
        --doc-violet: #8b5cf6;
        --doc-lilac: #a78bfa;
        --doc-blue: #60a5fa;
        --doc-pink: #f472b6;
        --doc-line: #ece8f7;
        --doc-soft: #f8f7ff;
        --doc-ring: rgba(139, 92, 246, .16);
        color: var(--doc-ink);
        overflow-x: clip;
    }

    .doc-page h1, .doc-page h2, .doc-page h3, .doc-page h4 {
        font-family: Outfit, Inter, sans-serif;
        letter-spacing: -.025em;
    }

    .doc-progress {
        position: fixed;
        inset: 0 0 auto 0;
        height: 3px;
        z-index: 80;
        background: transparent;
        pointer-events: none;
    }
    .doc-progress span {
        display: block;
        height: 100%;
        width: 0;
        background: linear-gradient(90deg, var(--doc-blue), var(--doc-violet), var(--doc-pink));
        box-shadow: 0 0 14px rgba(139, 92, 246, .45);
        transition: width .12s linear;
    }

    .doc-wrap {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .doc-section {
        position: relative;
        scroll-margin-top: 132px;
        padding: 52px 0;
    }

    .doc-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        border: 1px solid rgba(167, 139, 250, .22);
        background: rgba(167, 139, 250, .08);
        color: #7c5ce5;
        border-radius: 999px;
        padding: .42rem .9rem;
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
    }
    .doc-eyebrow::before {
        content: '';
        width: .42rem;
        height: .42rem;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--doc-violet), var(--doc-pink));
        box-shadow: 0 0 0 4px rgba(167, 139, 250, .16);
    }

    .doc-title {
        font-size: clamp(2rem, 4vw, 3.2rem);
        line-height: 1.06;
        font-weight: 800;
        margin: 1rem 0 .8rem;
    }
    .doc-subtitle {
        max-width: 680px;
        color: var(--doc-muted);
        font-size: 1.02rem;
        line-height: 1.75;
    }
    .doc-gradient-text {
        position: relative;
        display: inline-block;
        color: #6d4bd8;
        background: none;
        -webkit-text-fill-color: currentColor;
    }
    .doc-gradient-text::after {
        content: '';
        position: absolute;
        left: .01em;
        right: .01em;
        bottom: -.05em;
        height: .08em;
        min-height: 3px;
        border-radius: 999px;
        background: linear-gradient(90deg, #60a5fa, #8b5cf6 48%, #f472b6);
        opacity: .72;
    }

    .doc-subnav {
        position: sticky;
        top: 64px;
        z-index: 30;
        margin: 8px auto 0;
        width: min(1140px, calc(100% - 32px));
        border: 1px solid rgba(236, 232, 247, .9);
        background: rgba(255, 255, 255, .86);
        backdrop-filter: blur(18px);
        border-radius: 1.25rem;
        box-shadow: 0 12px 34px rgba(92, 66, 160, .07);
    }
    .doc-subnav-inner {
        display: flex;
        align-items: center;
        gap: .25rem;
        overflow-x: auto;
        padding: .45rem;
        scrollbar-width: none;
    }
    .doc-subnav-inner::-webkit-scrollbar { display: none; }
    .doc-subnav a {
        flex: 0 0 auto;
        padding: .55rem .85rem;
        border-radius: .85rem;
        color: #6b7280;
        font-size: .78rem;
        font-weight: 800;
        white-space: nowrap;
        transition: color .2s ease, background .2s ease;
    }
    .doc-subnav a:hover, .doc-subnav a.is-active {
        color: #6d4bd8;
        background: #f4f0ff;
    }

    .doc-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        border-radius: 1.15rem;
        padding: .9rem 1.35rem;
        font-size: .9rem;
        font-weight: 800;
        transition: transform .25s ease, box-shadow .25s ease, background .25s ease, color .25s ease;
        line-height: 1;
    }
    .doc-btn:hover { transform: translateY(-2px); }
    .doc-btn:active { transform: translateY(0) scale(.98); }
    .doc-btn-primary {
        color: #fff;
        background: linear-gradient(120deg, #7c6cf2, #a78bfa 55%, #f0a3cd);
        box-shadow: 0 16px 38px rgba(139, 92, 246, .28);
    }
    .doc-btn-primary:hover { box-shadow: 0 20px 44px rgba(139, 92, 246, .36); }
    .doc-btn-ghost {
        color: #5b4a91;
        background: #fff;
        border: 1px solid #e8e1f7;
        box-shadow: 0 8px 24px rgba(92, 66, 160, .06);
    }
    .doc-btn-ghost:hover { border-color: #cdbdf3; background: #fbfaff; }
    .doc-btn-sm { padding: .68rem .95rem; border-radius: .9rem; font-size: .78rem; }

    .doc-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        border-radius: 999px;
        border: 1px solid var(--doc-line);
        background: #fff;
        padding: .38rem .7rem;
        color: #6b7280;
        font-size: .72rem;
        font-weight: 700;
    }
    .doc-chip svg { width: .9rem; height: .9rem; color: var(--doc-violet); }

    /* ------------------------------------------------------------------
       Hero
    ------------------------------------------------------------------ */
    .doc-hero {
        position: relative;
        padding: 44px 0 14px;
    }
    .doc-hero::before,
    .doc-hero::after {
        content: '';
        position: absolute;
        border-radius: 999px;
        filter: blur(70px);
        pointer-events: none;
        z-index: 0;
    }
    .doc-hero::before {
        width: 340px;
        height: 340px;
        top: 30px;
        right: -70px;
        background: rgba(167, 139, 250, .18);
    }
    .doc-hero::after {
        width: 240px;
        height: 240px;
        bottom: 20px;
        left: -80px;
        background: rgba(249, 168, 212, .16);
    }
    .doc-hero-grid {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(0, 1.02fr) minmax(0, .98fr);
        gap: 48px;
        align-items: center;
    }
    .doc-hero h1 {
        margin: 1.15rem 0 1.15rem;
        font-size: clamp(2.5rem, 4.9vw, 4.05rem);
        line-height: 1.03;
        font-weight: 800;
        letter-spacing: -.045em;
    }
    .doc-hero-lead {
        max-width: 580px;
        color: var(--doc-muted);
        font-size: 1.06rem;
        line-height: 1.75;
    }
    .doc-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
        margin-top: 1.75rem;
    }
    .doc-hero-chips {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: 1.6rem;
    }
    .doc-hero-art {
        position: relative;
        border-radius: 2rem;
        border: 1px solid rgba(236, 232, 247, .9);
        background:
            radial-gradient(circle at 15% 15%, rgba(96, 165, 250, .16), transparent 35%),
            radial-gradient(circle at 85% 20%, rgba(244, 114, 182, .13), transparent 38%),
            radial-gradient(circle at 50% 100%, rgba(167, 139, 250, .18), transparent 48%),
            #fbfaff;
        box-shadow: 0 36px 80px rgba(92, 66, 160, .13);
        padding: 14px;
        overflow: hidden;
    }
    .doc-hero-art::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(167, 139, 250, .07) 1px, transparent 1px),
            linear-gradient(90deg, rgba(167, 139, 250, .07) 1px, transparent 1px);
        background-size: 34px 34px;
        mask-image: radial-gradient(circle at 50% 50%, #000, transparent 78%);
        pointer-events: none;
    }
    .doc-hero-art svg { display: block; width: 100%; height: auto; position: relative; }
    .doc-hero-badge {
        position: absolute;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: .5rem;
        border-radius: .9rem;
        background: rgba(255, 255, 255, .92);
        border: 1px solid #efeaf9;
        box-shadow: 0 12px 30px rgba(92, 66, 160, .12);
        padding: .5rem .7rem;
        font-size: .68rem;
        font-weight: 800;
        color: #5b4a91;
        backdrop-filter: blur(10px);
    }
    .doc-hero-badge svg { width: 1rem; height: 1rem; color: #8b5cf6; }
    .doc-hero-badge--top { right: 18px; top: 62px; animation: docBadgeFloat 5s ease-in-out infinite; }
    .doc-hero-badge--bottom { left: 14px; bottom: 34px; animation: docBadgeFloat 5.6s ease-in-out .8s infinite; }

    .doc-hero-metrics {
        display: flex;
        flex-wrap: wrap;
        gap: 1.2rem;
        margin-top: 1.6rem;
        padding-top: 1.2rem;
        border-top: 1px solid #f0ecf9;
    }
    .doc-hero-metric strong {
        display: block;
        font-family: Outfit, Inter, sans-serif;
        font-size: 1.25rem;
        line-height: 1;
        color: #4c3a85;
    }
    .doc-hero-metric span { font-size: .7rem; color: #8b8aa0; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }

    /* ------------------------------------------------------------------
       Scroll reveal
    ------------------------------------------------------------------ */
    .doc-reveal {
        opacity: 1;
        transform: none;
        transition: opacity .75s cubic-bezier(.2, .7, .3, 1), transform .75s cubic-bezier(.2, .7, .3, 1);
        will-change: opacity, transform;
    }
    .doc-js .doc-reveal {
        opacity: 0;
        transform: translateY(24px);
    }
    .doc-js .doc-reveal.is-visible { opacity: 1; transform: none; }

    /* ------------------------------------------------------------------
       Role overview
    ------------------------------------------------------------------ */
    .doc-overview {
        border-radius: 2.4rem;
        border: 1px solid #efebf9;
        background:
            radial-gradient(circle at 8% 12%, rgba(96, 165, 250, .1), transparent 30%),
            radial-gradient(circle at 92% 90%, rgba(249, 168, 212, .13), transparent 34%),
            linear-gradient(180deg, #fdfcff, #f8f6ff);
        box-shadow: 0 22px 60px rgba(92, 66, 160, .07);
        padding: clamp(22px, 4vw, 42px);
    }
    .doc-role-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.12fr) minmax(0, .88fr);
        gap: 28px;
        align-items: stretch;
        margin-top: 30px;
    }
    .doc-role-stage {
        position: relative;
        border-radius: 1.8rem;
        border: 1px solid #eee9f9;
        background: rgba(255, 255, 255, .72);
        padding: 8px;
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .doc-role-stage svg { width: 100%; height: auto; display: block; }
    .doc-role-node { cursor: pointer; }
    .doc-role-node .doc-role-halo {
        transform-box: fill-box;
        transform-origin: center;
        transition: transform .35s ease, opacity .35s ease;
    }
    .doc-role-node:hover .doc-role-halo,
    .doc-role-node:focus-visible .doc-role-halo,
    .doc-role-node.is-active .doc-role-halo {
        transform: scale(1.1);
        opacity: 1;
    }
    .doc-role-node:focus-visible { outline: none; }
    .doc-role-node .doc-role-label { transition: fill .25s ease; }
    .doc-role-node:hover .doc-role-label,
    .doc-role-node.is-active .doc-role-label { fill: #5b3fd1; }
    .doc-dash-line {
        stroke-dasharray: 6 7;
        animation: docDash 1.2s linear infinite;
    }
    .doc-role-panel {
        border-radius: 1.8rem;
        background: #fff;
        border: 1px solid #eee9f9;
        box-shadow: 0 18px 44px rgba(92, 66, 160, .07);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        min-height: 320px;
    }
    .doc-role-pane { display: none; animation: docPaneIn .35s ease both; }
    .doc-role-pane.is-active { display: block; }
    .doc-role-pane-icon {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 1rem;
        color: #7c5ce5;
        background: #f3efff;
        border: 1px solid #e9e1ff;
        margin-bottom: .9rem;
    }
    .doc-role-pane-icon svg { width: 24px; height: 24px; }
    .doc-role-pane h3 { font-size: 1.3rem; font-weight: 800; }
    .doc-role-pane p { color: var(--doc-muted); font-size: .9rem; line-height: 1.65; margin-top: .35rem; }
    .doc-role-list { margin-top: 1rem; display: grid; gap: .55rem; }
    .doc-role-list li {
        display: flex;
        align-items: flex-start;
        gap: .55rem;
        font-size: .82rem;
        color: #4b5563;
        line-height: 1.5;
    }
    .doc-role-list svg { width: 1rem; height: 1rem; flex: 0 0 auto; margin-top: .1rem; color: #8b5cf6; }
    .doc-role-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: 1rem;
    }
    .doc-role-tab {
        border-radius: .8rem;
        border: 1px solid #ebe5f8;
        background: #fff;
        color: #6b7280;
        font-size: .75rem;
        font-weight: 800;
        padding: .5rem .7rem;
        transition: .2s ease;
    }
    .doc-role-tab:hover { border-color: #cdbdf3; color: #6d4bd8; }
    .doc-role-tab.is-active { background: #f2edff; border-color: #d9cdfb; color: #5b3fd1; }

    /* ------------------------------------------------------------------
       Workflow
    ------------------------------------------------------------------ */
    .doc-flow { margin-top: 34px; }
    .doc-step {
        position: relative;
        display: grid;
        grid-template-columns: 62px minmax(0, 1fr);
        gap: 18px;
        padding-bottom: 30px;
        scroll-margin-top: 150px;
    }
    .doc-step:last-child { padding-bottom: 0; }
    .doc-step::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 64px;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, rgba(167, 139, 250, .45), rgba(236, 232, 247, .25));
    }
    .doc-step:last-child::before { display: none; }
    .doc-step-num {
        position: relative;
        z-index: 1;
        width: 62px;
        height: 62px;
        border-radius: 1.25rem;
        display: grid;
        place-items: center;
        background: #fff;
        border: 1px solid #eae4f8;
        box-shadow: 0 10px 26px rgba(92, 66, 160, .08);
        color: #7c5ce5;
        font-family: Outfit, Inter, sans-serif;
        font-weight: 800;
        font-size: 1.1rem;
        transition: .35s ease;
    }
    .doc-step-body {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(250px, 310px);
        gap: 24px;
        align-items: center;
        background: #fff;
        border: 1px solid #efebf8;
        border-radius: 1.7rem;
        padding: clamp(18px, 3vw, 28px);
        box-shadow: 0 12px 36px rgba(92, 66, 160, .055);
        transition: border-color .35s ease, box-shadow .35s ease, transform .35s ease;
    }
    .doc-step.is-active .doc-step-num {
        color: #fff;
        border-color: transparent;
        background: linear-gradient(135deg, #7c6cf2, #a78bfa 58%, #f0a3cd);
        box-shadow: 0 14px 30px rgba(139, 92, 246, .3);
    }
    .doc-step.is-active .doc-step-body {
        border-color: rgba(167, 139, 250, .42);
        box-shadow: 0 20px 50px rgba(92, 66, 160, .13);
        transform: translateY(-2px);
    }
    .doc-step-kicker {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .65rem;
        font-weight: 800;
        letter-spacing: .11em;
        text-transform: uppercase;
        color: #8b5cf6;
    }
    .doc-step-kicker::before {
        content: '';
        width: .4rem;
        height: .4rem;
        border-radius: 999px;
        background: currentColor;
    }
    .doc-step h3 { font-size: clamp(1.2rem, 2.2vw, 1.55rem); font-weight: 800; margin: .45rem 0 .55rem; }
    .doc-step p { color: var(--doc-muted); font-size: .88rem; line-height: 1.7; }
    .doc-step-points {
        display: grid;
        gap: .32rem;
        margin-top: .85rem;
    }
    .doc-step-points li {
        display: flex;
        gap: .45rem;
        align-items: flex-start;
        font-size: .78rem;
        color: #565d6b;
        line-height: 1.45;
    }
    .doc-step-points svg { width: .85rem; height: .85rem; flex: 0 0 auto; margin-top: .16rem; color: #8b5cf6; }
    .doc-step-toggle {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        margin-top: 1rem;
        border-radius: .75rem;
        border: 1px solid #e9e2f8;
        background: #fbfaff;
        color: #6d4bd8;
        font-size: .74rem;
        font-weight: 800;
        padding: .48rem .7rem;
        transition: .2s ease;
    }
    .doc-step-toggle:hover { background: #f3efff; border-color: #d8cafa; }
    .doc-step-toggle svg { width: .85rem; height: .85rem; transition: transform .25s ease; }
    .doc-step-toggle[aria-expanded="true"] svg { transform: rotate(180deg); }
    .doc-step-detail {
        max-height: 0;
        overflow: hidden;
        transition: max-height .4s cubic-bezier(.2, .7, .3, 1), margin .3s ease;
        margin-top: 0;
        border-top: 1px dashed transparent;
    }
    .doc-step-detail.is-open {
        max-height: 260px;
        margin-top: .9rem;
        padding-top: .8rem;
        border-top-color: #eee9f8;
    }
    .doc-step-detail p { font-size: .78rem; }
    .doc-step-detail strong { color: #4c3a85; }
    .doc-step-visual {
        border-radius: 1.35rem;
        border: 1px solid #f0ebfa;
        background: linear-gradient(150deg, #fbfaff, #f7f3ff 55%, #fff6fb);
        padding: 10px;
        overflow: hidden;
    }
    .doc-step-visual svg { width: 100%; height: auto; display: block; }

    /* ------------------------------------------------------------------
       Guide cards
    ------------------------------------------------------------------ */
    .doc-guide-head {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.6rem;
    }
    .doc-guide-head h2 { font-size: clamp(1.7rem, 3vw, 2.4rem); font-weight: 800; }
    .doc-guide-head p { color: var(--doc-muted); font-size: .9rem; margin-top: .35rem; }
    .doc-guide-badge {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        border-radius: 999px;
        padding: .42rem .75rem;
        font-size: .68rem;
        font-weight: 800;
        letter-spacing: .05em;
        text-transform: uppercase;
        background: #f3efff;
        border: 1px solid #e4dbff;
        color: #6d4bd8;
    }
    .doc-guide-badge svg { width: .9rem; height: .9rem; }
    .doc-guide-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }
    .doc-guide-card {
        background: #fff;
        border: 1px solid #f0edf8;
        border-radius: 1.35rem;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(96, 74, 160, .045);
        transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease, opacity .3s ease;
        height: 100%;
    }
    .doc-guide-card:hover {
        transform: translateY(-4px);
        border-color: rgba(167, 139, 250, .32);
        box-shadow: 0 20px 46px rgba(96, 74, 160, .12);
    }
    .doc-guide-card.is-filtered { display: none; }
    .doc-guide-visual {
        height: 9.2rem;
        background:
            radial-gradient(circle at 20% 10%, rgba(96, 165, 250, .11), transparent 38%),
            radial-gradient(circle at 85% 90%, rgba(249, 168, 212, .11), transparent 42%),
            linear-gradient(135deg, #fbfaff, #f5f1ff 58%, #fff6fb);
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #f5f2fb;
        padding: 6px;
        overflow: hidden;
    }
    .doc-guide-visual svg { width: 100%; height: 100%; }
    .doc-guide-body { padding: 1rem 1.05rem 1.1rem; }
    .doc-guide-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .6rem;
        margin-bottom: .55rem;
    }
    .doc-guide-dot {
        width: .45rem;
        height: .45rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #8b5cf6, #f472b6);
        box-shadow: 0 0 0 4px rgba(167, 139, 250, .1);
    }
    .doc-tag {
        font-size: .6rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #7c5ce5;
        background: #f3eeff;
        border: 1px solid #e9e0ff;
        border-radius: 999px;
        padding: .22rem .55rem;
    }
    .doc-tag--live { color: #0f766e; background: #ecfdf5; border-color: #ccfbf1; }
    .doc-tag--guide { color: #9d174d; background: #fdf2f8; border-color: #fce7f3; }
    .doc-guide-card h4 { font-size: .98rem; font-weight: 800; line-height: 1.35; }
    .doc-guide-card p { color: var(--doc-muted); font-size: .8rem; line-height: 1.62; margin-top: .4rem; }

    .doc-guide-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: .8rem;
        margin: 1.2rem 0 1.4rem;
        padding: .7rem;
        border-radius: 1.15rem;
        border: 1px solid #eee9f9;
        background: #fff;
        box-shadow: 0 8px 24px rgba(92, 66, 160, .045);
    }
    .doc-guide-search {
        position: relative;
        flex: 1 1 250px;
    }
    .doc-guide-search svg {
        position: absolute;
        left: .85rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        color: #a78bfa;
    }
    .doc-guide-search input {
        width: 100%;
        border: 1px solid #ece7f7;
        background: #fbfaff;
        border-radius: .85rem;
        padding: .65rem .85rem .65rem 2.35rem;
        font-size: .82rem;
        outline: none;
        transition: .2s ease;
    }
    .doc-guide-search input:focus { border-color: #cdbdf3; box-shadow: 0 0 0 4px rgba(167, 139, 250, .12); }
    .doc-guide-count { color: #8b8aa0; font-size: .72rem; font-weight: 700; padding-right: .4rem; }
    .doc-guide-empty {
        display: none;
        text-align: center;
        padding: 2.4rem 1rem;
        border: 1px dashed #ddd4f3;
        border-radius: 1.2rem;
        color: #8b8aa0;
        font-size: .85rem;
        background: #fdfcff;
    }
    .doc-guide-empty.is-visible { display: block; }
    .doc-guide-section.is-filtered { display: none; }
    .doc-guide-section { scroll-margin-top: 136px; }

    /* ------------------------------------------------------------------
       Trust / architecture
    ------------------------------------------------------------------ */
    .doc-trust-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }
    .doc-trust-card {
        border-radius: 1.4rem;
        border: 1px solid #efebf8;
        background: #fff;
        padding: 1.25rem;
        box-shadow: 0 10px 30px rgba(92, 66, 160, .05);
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .doc-trust-card:hover { transform: translateY(-3px); box-shadow: 0 18px 40px rgba(92, 66, 160, .1); }
    .doc-trust-icon {
        width: 44px;
        height: 44px;
        border-radius: .95rem;
        display: grid;
        place-items: center;
        color: #7c5ce5;
        background: #f3efff;
        border: 1px solid #e8dfff;
        margin-bottom: .8rem;
    }
    .doc-trust-icon svg { width: 22px; height: 22px; }
    .doc-trust-card h3 { font-size: .95rem; font-weight: 800; }
    .doc-trust-card p { color: var(--doc-muted); font-size: .78rem; line-height: 1.6; margin-top: .35rem; }

    .doc-stack {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: 1.6rem;
    }
    .doc-stack span {
        border-radius: .7rem;
        background: #fbfaff;
        border: 1px solid #eee9f8;
        padding: .42rem .65rem;
        font-size: .7rem;
        font-weight: 800;
        color: #6b7280;
    }

    /* ------------------------------------------------------------------
       FAQ
    ------------------------------------------------------------------ */
    .doc-faq-wrap {
        display: grid;
        grid-template-columns: minmax(0, .8fr) minmax(0, 1.2fr);
        gap: 36px;
        align-items: start;
        margin-top: 2.2rem;
    }
    .doc-faq { border-bottom: 1px solid #efebf8; padding: .2rem 0; }
    .doc-faq summary {
        list-style: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        cursor: pointer;
        padding: 1rem .1rem;
        font-size: .9rem;
        font-weight: 800;
        color: #2a3342;
    }
    .doc-faq summary::-webkit-details-marker { display: none; }
    .doc-faq summary span:last-child {
        width: 1.6rem;
        height: 1.6rem;
        flex: 0 0 auto;
        border-radius: .55rem;
        display: grid;
        place-items: center;
        background: #f4f0ff;
        color: #7c5ce5;
        transition: transform .25s ease, background .25s ease;
    }
    .doc-faq summary svg { width: .9rem; height: .9rem; }
    .doc-faq[open] summary span:last-child { transform: rotate(45deg); background: #ece4ff; }
    .doc-faq p {
        color: var(--doc-muted);
        font-size: .84rem;
        line-height: 1.7;
        padding: 0 2.2rem 1rem .1rem;
        animation: docPaneIn .3s ease both;
    }

    /* ------------------------------------------------------------------
       CTA + footer note
    ------------------------------------------------------------------ */
    .doc-cta {
        position: relative;
        overflow: hidden;
        border-radius: 2.4rem;
        background:
            radial-gradient(circle at 12% 20%, rgba(96, 165, 250, .2), transparent 30%),
            radial-gradient(circle at 88% 12%, rgba(244, 114, 182, .2), transparent 32%),
            linear-gradient(135deg, #7f6cf1 0%, #a78bfa 48%, #f0a3cd 100%);
        color: #fff;
        padding: clamp(34px, 6vw, 64px);
        text-align: center;
        box-shadow: 0 30px 70px rgba(139, 92, 246, .28);
    }
    .doc-cta::before,
    .doc-cta::after {
        content: '';
        position: absolute;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .18);
    }
    .doc-cta::before { width: 300px; height: 300px; top: -150px; left: -80px; }
    .doc-cta::after { width: 420px; height: 420px; bottom: -280px; right: -120px; }
    .doc-cta h2 { position: relative; font-size: clamp(1.8rem, 4vw, 3rem); font-weight: 800; }
    .doc-cta p { position: relative; color: rgba(255, 255, 255, .82); max-width: 560px; margin: .8rem auto 1.5rem; font-size: .95rem; line-height: 1.7; }
    .doc-cta-actions { position: relative; display: flex; flex-wrap: wrap; justify-content: center; gap: .7rem; }
    .doc-cta .doc-btn-primary { background: #fff; color: #6d4bd8; box-shadow: 0 16px 36px rgba(62, 35, 130, .22); }
    .doc-cta .doc-btn-ghost { background: rgba(255, 255, 255, .12); color: #fff; border-color: rgba(255, 255, 255, .3); box-shadow: none; }
    .doc-cta .doc-btn-ghost:hover { background: rgba(255, 255, 255, .2); }
    .doc-footnote {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: .8rem;
        color: #9a97ad;
        font-size: .72rem;
        padding: 1.6rem 0 0;
    }

    /* ------------------------------------------------------------------
       SVG visual animation primitives
    ------------------------------------------------------------------ */
    .doc-visual { display: block; width: 100%; height: 100%; color: #8b5cf6; overflow: visible; }
    .doc-visual text { font-family: Inter, sans-serif; }
    .doc-visual .v-float,
    .doc-visual .v-pulse,
    .doc-visual .v-pop,
    .doc-visual .v-blink,
    .doc-visual .v-slide,
    .doc-visual .v-heart,
    .doc-visual .v-bounce,
    .doc-visual .v-spin,
    .doc-visual .v-draw,
    .doc-visual .v-grow,
    .doc-visual .v-scan {
        transform-box: fill-box;
        transform-origin: center;
    }
    .doc-visual .v-float { animation: docFloat 3.4s ease-in-out infinite; }
    .doc-visual .v-pulse { animation: docPulse 2.4s ease-in-out infinite; }
    .doc-visual .v-pop { animation: docPop 2.8s ease-in-out infinite; }
    .doc-visual .v-blink { animation: docBlink 1.7s ease-in-out infinite; }
    .doc-visual .v-slide { animation: docSlide 3.6s ease-in-out infinite; }
    .doc-visual .v-heart { animation: docHeart 2s ease-in-out infinite; }
    .doc-visual .v-bounce { animation: docBounce 2.8s ease-in-out infinite; }
    .doc-visual .v-spin { animation: docSpin 5s linear infinite; }
    .doc-visual .v-draw { stroke-dasharray: 180; stroke-dashoffset: 180; animation: docDraw 3s ease-in-out infinite; }
    .doc-visual .v-grow { animation: docGrow 3s ease-in-out infinite; }
    .doc-visual .v-scan { animation: docScan 3s ease-in-out infinite; }

    .doc-reveal:not(.is-visible) .doc-visual .v-float,
    .doc-reveal:not(.is-visible) .doc-visual .v-pulse,
    .doc-reveal:not(.is-visible) .doc-visual .v-pop,
    .doc-reveal:not(.is-visible) .doc-visual .v-blink,
    .doc-reveal:not(.is-visible) .doc-visual .v-slide,
    .doc-reveal:not(.is-visible) .doc-visual .v-heart,
    .doc-reveal:not(.is-visible) .doc-visual .v-bounce,
    .doc-reveal:not(.is-visible) .doc-visual .v-spin,
    .doc-reveal:not(.is-visible) .doc-visual .v-draw,
    .doc-reveal:not(.is-visible) .doc-visual .v-grow,
    .doc-reveal:not(.is-visible) .doc-visual .v-scan {
        animation-play-state: paused;
    }

    /* ------------------------------------------------------------------
       Keyframes
    ------------------------------------------------------------------ */
    @keyframes docFloat { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }
    @keyframes docPulse { 0%, 100% { opacity: .55; transform: scale(.9); } 50% { opacity: 1; transform: scale(1.05); } }
    @keyframes docPop { 0% { opacity: 0; transform: scale(.55); } 28% { opacity: 1; transform: scale(1.08); } 42%, 100% { opacity: 1; transform: scale(1); } }
    @keyframes docBlink { 0%, 100% { opacity: .25; } 50% { opacity: 1; } }
    @keyframes docSlide { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(9px); } }
    @keyframes docHeart { 0%, 100% { transform: scale(1); } 18% { transform: scale(1.22); } 36% { transform: scale(.96); } 54% { transform: scale(1.12); } }
    @keyframes docBounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
    @keyframes docSpin { to { transform: rotate(360deg); } }
    @keyframes docDraw { 0% { stroke-dashoffset: 180; opacity: .2; } 45% { stroke-dashoffset: 0; opacity: 1; } 75%, 100% { stroke-dashoffset: 0; opacity: 1; } }
    @keyframes docGrow { 0%, 100% { transform: scaleY(.45); } 55% { transform: scaleY(1); } }
    @keyframes docScan { 0%, 100% { transform: translateY(-18px); opacity: .2; } 50% { transform: translateY(18px); opacity: 1; } }
    @keyframes docDash { to { stroke-dashoffset: -26; } }
    @keyframes docBadgeFloat { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-7px); } }
    @keyframes docPaneIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }
    @keyframes docHeroCardIn { from { opacity: 0; transform: translateY(22px) scale(.94); } to { opacity: 1; transform: none; } }
    @keyframes docHeroReveal { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: none; } }
    @keyframes docHeroDraw { to { stroke-dashoffset: 0; } }
    @keyframes docHeroGlow { 0%, 100% { opacity: .25; transform: scale(.92); } 50% { opacity: .8; transform: scale(1.04); } }
    @keyframes docHeroSearch { 0% { transform: translate(-18px, 8px); opacity: 0; } 18% { opacity: 1; } 55% { transform: translate(116px, 22px); opacity: 1; } 75%, 100% { transform: translate(116px, 22px); opacity: 1; } }
    @keyframes docHeroPop { 0%, 8% { opacity: 0; transform: scale(.6); } 22%, 100% { opacity: 1; transform: scale(1); } }
    @keyframes docHeroHouse { 0%, 60% { opacity: .35; transform: scale(.96); } 82%, 100% { opacity: 1; transform: scale(1); } }
    @keyframes docHeroEnquiry { 0%, 10% { opacity: 0; transform: translateY(10px) scale(.9); } 28%, 100% { opacity: 1; transform: none; } }

    .doc-hero-svg .h-card { animation: docHeroCardIn .75s cubic-bezier(.2, .8, .3, 1) both; }
    .doc-hero-svg .h-card,
    .doc-hero-svg .h-enquiry,
    .doc-hero-svg .h-booking,
    .doc-hero-svg .h-payment,
    .doc-hero-svg .h-house {
        transform-box: fill-box;
        transform-origin: center;
    }
    .doc-hero-svg .h-search { animation: docHeroSearch 5.4s cubic-bezier(.3, .7, .3, 1) .5s infinite; }
    .doc-hero-svg .h-route { stroke-dasharray: 520; stroke-dashoffset: 520; animation: docHeroDraw 3s ease 1.3s forwards; }
    .doc-hero-svg .h-enquiry { animation: docHeroEnquiry .8s ease 2.5s both; }
    .doc-hero-svg .h-booking { animation: docHeroPop .7s ease 3.4s both; }
    .doc-hero-svg .h-payment { animation: docHeroPop .7s ease 4.2s both; }
    .doc-hero-svg .h-house { animation: docHeroHouse 3s ease 4.8s both; }
    .doc-hero-svg .h-glow { animation: docHeroGlow 3.2s ease-in-out 5s infinite; }
    .doc-hero-svg .h-float { animation: docFloat 4.4s ease-in-out infinite; }

    /* ------------------------------------------------------------------
       Responsive
    ------------------------------------------------------------------ */
    @media (max-width: 1024px) {
        .doc-hero-grid { grid-template-columns: 1fr; gap: 32px; }
        .doc-hero-art { max-width: 720px; margin: 0 auto; }
        .doc-role-layout { grid-template-columns: 1fr; }
        .doc-guide-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .doc-trust-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .doc-faq-wrap { grid-template-columns: 1fr; gap: 24px; }
    }
    @media (max-width: 760px) {
        .doc-subnav { top: 64px; }
        .doc-section { padding: 38px 0; }
        .doc-step { grid-template-columns: 48px minmax(0, 1fr); gap: 12px; }
        .doc-step::before { left: 23px; top: 52px; }
        .doc-step-num { width: 48px; height: 48px; border-radius: 1rem; font-size: .95rem; }
        .doc-step-body { grid-template-columns: 1fr; }
        .doc-step-visual { order: -1; }
        .doc-guide-grid { grid-template-columns: 1fr; }
        .doc-guide-visual { height: 8.8rem; }
        .doc-hero-actions .doc-btn { flex: 1 1 auto; }
        .doc-hero-metrics { gap: .9rem; }
        .doc-hero-metric { flex: 1 1 30%; }
        .doc-hero-badge--top { right: 10px; top: 28px; }
        .doc-hero-badge--bottom { left: 8px; bottom: 20px; }
    }
    @media (max-width: 520px) {
        .doc-wrap { padding: 0 14px; }
        .doc-trust-grid { grid-template-columns: 1fr; }
        .doc-hero { padding-top: 28px; }
        .doc-hero-art { padding: 8px; border-radius: 1.5rem; }
        .doc-hero-badge { display: none; }
        .doc-title { font-size: 1.9rem; }
        .doc-step-body { padding: 16px; }
        .doc-cta { border-radius: 1.7rem; }
    }

    @media (prefers-reduced-motion: reduce) {
        .doc-page *, .doc-page *::before, .doc-page *::after {
            animation-duration: .001ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .001ms !important;
        }
        .doc-reveal { opacity: 1; transform: none; }
    }
</style>
