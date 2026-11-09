<script>
    (function () {
        'use strict';

        var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var canObserve = 'IntersectionObserver' in window && !reduceMotion;

        if (canObserve) {
            document.documentElement.classList.add('doc-js');
        }

        /* -----------------------------------------------------------------
           Reading progress
        ----------------------------------------------------------------- */
        var progressBar = document.getElementById('docProgress');

        function updateProgress() {
            if (!progressBar) return;
            var scrollable = document.documentElement.scrollHeight - window.innerHeight;
            var value = scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0;
            progressBar.style.width = Math.min(100, Math.max(0, value)) + '%';
        }

        /* -----------------------------------------------------------------
           Scroll reveal
        ----------------------------------------------------------------- */
        var revealItems = Array.prototype.slice.call(document.querySelectorAll('.doc-reveal'));

        if (canObserve) {
            var revealObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.07, rootMargin: '0px 0px -35px 0px' });

            revealItems.forEach(function (item) {
                if (!item.classList.contains('is-visible')) revealObserver.observe(item);
            });
        } else {
            revealItems.forEach(function (item) { item.classList.add('is-visible'); });
        }

        /* -----------------------------------------------------------------
           Workflow active step
        ----------------------------------------------------------------- */
        var workflowSteps = Array.prototype.slice.call(document.querySelectorAll('[data-workflow-step]'));

        function updateActiveWorkflowStep() {
            if (!workflowSteps.length || window.innerWidth < 760) return;
            var focalPoint = window.innerHeight * 0.44;
            var closest = null;
            var closestDistance = Infinity;

            workflowSteps.forEach(function (step) {
                var rect = step.getBoundingClientRect();
                var distance = Math.abs(rect.top + rect.height / 2 - focalPoint);
                if (distance < closestDistance) {
                    closestDistance = distance;
                    closest = step;
                }
            });

            workflowSteps.forEach(function (step) {
                step.classList.toggle('is-active', step === closest);
            });
        }

        /* -----------------------------------------------------------------
           Section navigation highlight
        ----------------------------------------------------------------- */
        var sectionIds = ['overview', 'workflow', 'guides', 'tenant-guide', 'owner-guide', 'admin-guide', 'trust', 'faq'];
        var sections = sectionIds.map(function (id) { return document.getElementById(id); }).filter(Boolean);
        var navLinks = Array.prototype.slice.call(document.querySelectorAll('.doc-subnav a'));

        function updateSectionNav() {
            if (!sections.length || !navLinks.length) return;
            var marker = window.scrollY + 180;
            var activeId = sections[0].id;

            sections.forEach(function (section) {
                var top = section.getBoundingClientRect().top + window.scrollY;
                if (top <= marker) activeId = section.id;
            });

            navLinks.forEach(function (link) {
                link.classList.toggle('is-active', link.getAttribute('href') === '#' + activeId);
            });
        }

        /* -----------------------------------------------------------------
           Scroll dispatcher
        ----------------------------------------------------------------- */
        var ticking = false;

        function onScroll() {
            if (ticking) return;
            ticking = true;
            window.requestAnimationFrame(function () {
                updateProgress();
                updateActiveWorkflowStep();
                updateSectionNav();
                ticking = false;
            });
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });
        updateProgress();
        updateActiveWorkflowStep();
        updateSectionNav();

        /* -----------------------------------------------------------------
           Role explorer
        ----------------------------------------------------------------- */
        var roleNodes = Array.prototype.slice.call(document.querySelectorAll('[data-role]'));
        var rolePanes = Array.prototype.slice.call(document.querySelectorAll('[data-role-pane]'));

        function activateRole(role) {
            roleNodes.forEach(function (node) {
                var active = node.getAttribute('data-role') === role;
                node.classList.toggle('is-active', active);
                node.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
            rolePanes.forEach(function (pane) {
                pane.classList.toggle('is-active', pane.getAttribute('data-role-pane') === role);
            });
        }

        roleNodes.forEach(function (node) {
            node.addEventListener('click', function () {
                activateRole(node.getAttribute('data-role'));
            });
            node.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    activateRole(node.getAttribute('data-role'));
                }
            });
        });

        /* -----------------------------------------------------------------
           Workflow "Learn more"
        ----------------------------------------------------------------- */
        var stepButtons = Array.prototype.slice.call(document.querySelectorAll('[data-step-toggle]'));

        stepButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var detail = document.getElementById(button.getAttribute('aria-controls'));
                if (!detail) return;
                var isOpen = button.getAttribute('aria-expanded') === 'true';
                var label = button.querySelector('[data-step-label]');

                button.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
                detail.classList.toggle('is-open', !isOpen);
                if (label) label.textContent = isOpen ? 'Learn more' : 'Show less';
            });
        });

        /* -----------------------------------------------------------------
           Guide search
        ----------------------------------------------------------------- */
        var guideSearch = document.getElementById('docGuideSearch');
        var guideCards = Array.prototype.slice.call(document.querySelectorAll('[data-guide-card]'));
        var guideSections = Array.prototype.slice.call(document.querySelectorAll('[data-guide-section]'));
        var guideCount = document.getElementById('docGuideCount');
        var guideEmpty = document.getElementById('docGuideEmpty');

        if (guideCount) guideCount.textContent = guideCards.length;

        function filterGuides() {
            var query = guideSearch ? guideSearch.value.trim().toLowerCase() : '';
            var visible = 0;

            guideCards.forEach(function (card) {
                var searchable = (card.getAttribute('data-search') || '').toLowerCase();
                var match = !query || searchable.indexOf(query) !== -1;
                card.classList.toggle('is-filtered', !match);
                if (match) visible++;
            });

            guideSections.forEach(function (section) {
                var hasVisible = section.querySelector('[data-guide-card]:not(.is-filtered)');
                section.classList.toggle('is-filtered', !hasVisible);
            });

            if (guideCount) guideCount.textContent = visible;
            if (guideEmpty) guideEmpty.classList.toggle('is-visible', query.length > 0 && visible === 0);
        }

        if (guideSearch) {
            guideSearch.addEventListener('input', filterGuides);
        }

        /* -----------------------------------------------------------------
           FAQ accordion
        ----------------------------------------------------------------- */
        var faqItems = Array.prototype.slice.call(document.querySelectorAll('.doc-faq'));

        faqItems.forEach(function (item) {
            item.addEventListener('toggle', function () {
                if (!item.open) return;
                faqItems.forEach(function (other) {
                    if (other !== item) other.open = false;
                });
            });
        });
    })();
</script>
