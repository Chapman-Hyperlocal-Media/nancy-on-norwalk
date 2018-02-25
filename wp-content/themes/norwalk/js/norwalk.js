import './polyfills/requestAnimationFrame-polyfill';
import './vendor/debounce';
import './_norwalk-ads';

(($) => {
    const $window = $(window);
    const $mainNav = $('#main-nav');
    const $document = $(document);
    const $mainContent = $('#main-content');
    const $sidebar = $mainContent.find('aside.sidebar');
    const $adSlots = $sidebar.find('li.widget.goog-ad');
    const $ads = $adSlots.find('div.goog-ad');
    let $mobileAdSlots = $mainContent.find('div.content > div.mobile-ad-slot');
    let adsInSidebar = true;

    // $window.smartresize(function(e) {
    //     var height = $mainNav.outerHeight();
    // });

    $window.scroll(() => {
        $mainNav.toggleClass('addLogo', $window.scrollTop() >= 195);
    });

    let showNav;

    const hideNav = (e) => {
        let keepGoing = true;

        e.target.parentElement.classList.keys().forEach((key) => {
            if (key === 'menu-item') {
                keepGoing = false;
            }
        });

        if (e.target.id !== 'nav-label' && keepGoing) {
            $mainNav.removeClass('expand');
            $('#nav-label, #nav-label > object').one('click tap', null, null, showNav);
        }
    };

    showNav = () => {
        $mainNav.addClass('expand');
        const args = '#main-content, #mainhead, #mainfoot';
        $(args).one('click tap touchstart', null, args, hideNav);
    };

    const norwalkTabsInit = () => {
        const $tabGroups = $('div.norwalk-tabs');
        $tabGroups.each(() => {
            const $tabs = $(this);
            $tabs.find('.tab-title').each(() => {
                const $title = $(this);
                const target = $title.data('tab');
                const text = $title.html();
                const isDefault = $title.parent().hasClass('default');
                const buttonClass = isDefault ? 'tab-button active' : 'tab-button';
                $(`<div class="${buttonClass}" data-target="${target}">${text}</div>`).insertBefore($title.closest('div.norwalk-tabs').children('.norwalk-tab.first'));
                $tabs.find('.default').addClass('active');
            });
            const $tabButtons = $tabs.find('div.tab-button');
            $tabButtons.click(() => {
                const $button = $(this);
                const $target = $button.parent().find(`div.${$button.data('target')}`);
                if (!$target.hasClass('active')) {
                    $tabs.children('div.norwalk-tab, div.tab-button').removeClass('active');
                    $target.add($button).addClass('active');
                }
            });
        });
    };

    const mobileAdCheck = () => {
        const documentWidth = $document.width();
        if (documentWidth < 801) {
            let slotNum = 0;
            let newSlot = false;

            $ads.each(() => {
                $(this).appendTo($mobileAdSlots[slotNum]);
                //
                // check to see if element is filled and mark it if so.
                //
                const $thisSlot = $mobileAdSlots.eq(slotNum);
                let slotEmpty = true;
                $thisSlot.find('.goog-ad').each(() => {
                    slotEmpty = $.trim($(this).html()) === '';
                    if (!slotEmpty && !$thisSlot.hasClass('filled')) {
                        $thisSlot.addClass('filled');
                    }

                    if (newSlot) {
                        slotNum += 1;
                        newSlot = false;
                    }
                    else {
                        newSlot = true;
                    }
                });
            });

            googletag.pubads().refresh();
            adsInSidebar = false;
            googletag.enableServices();
        }
        else if (!adsInSidebar && documentWidth >= 801) {
            let slotNum = 0;

            //
            // Remove the filled marker
            //
            $ads.each(() => {
                $(this).appendTo($adSlots[slotNum]);
                const $thisSlot = $mobileAdSlots.eq(slotNum);

                if ($thisSlot.hasClass('filled')) {
                    $thisSlot.removeClass('filled');
                }
                slotNum += 1;
            });

            googletag.pubads().refresh();
            adsInSidebar = true;
            googletag.enableServices();
        }
    };

    $(document).ready(() => {
        if ($('html').hasClass('wallpaper-ad')) {
            let contentWidth = $document.width() - 400;
            $('#NoN-content').css({ width: contentWidth });

            $window.smartresize(() => {
                contentWidth = $document.width() - 400;
                $('#NoN-content').css({ width: contentWidth });
            });
        }

        /*
         *   Mobile ad placement code
         *
         *   Inserts mobile-ad-slots in between paragraphs on single story pages
         *
         */
        if ($('body').hasClass('single')) {
            const $content = $mainContent.find('div.the-content');
            let storyHeight = 0;
            let i = 1;

            $content.find('p').each(() => {
                const $this = $(this);
                storyHeight += $this.outerHeight();

                if (storyHeight > 500) {
                    // spacing the ads apart a bit
                    $this.after(`<div id="mobile-ad-slot-${i}" class="mobile-ad-slot"><p class="ad-label">Advertisement</p></div>`);
                    storyHeight = 0;
                    i += 1;
                }
            });

            $('#comments-section').find('article.comment.odd').each(() => {
                $(this).after(`<div id="mobile-ad-slot-${i}" class="mobile-ad-slot comment"><p class="ad-label">Advertisement</p></div>`);
                i += 1;
            });

            $mobileAdSlots = $mainContent.find('div.content div.the-content > div.mobile-ad-slot, #comments-section > div.comments > div.mobile-ad-slot');
        }

        //  Move the ads from the sidebar into mobile ad slots when appropriate.
        //
        if ($document.width() < 801) {
            tLimit = 0;
            t = setInterval(() => {

                mobileAdCheck();
                if (tLimit >= 5000) {
                    clearInterval(t);
                    googletag.pubads().refresh();
                }
                tLimit += 500;
            }, 500);
        }
        else mobileAdCheck();
        $window.smartresize((e) => {
            mobileAdCheck(e);
            googletag.pubads().refresh();
        });

        $('#nav-logo, #nav-label').prependTo('#main-nav').attr('style', '');

        $('#main-nextprev').appendTo('#main-nav').attr('style', '');

        $('#nav-label, #nav-label > object').on('click tap', null, null, showNav);

        if ($('div.norwalk-tabs').length > 0) {
            norwalkTabsInit();
        }
        else {
            console.log('no tabs found');
        }

        $('button.sc-payment-btn.stripe-button-el').click(() => {
            const $this = $(this);
            if (!$this.parents('html').hasClass('cssanimations')) {
                // skip this whole thing if the browser can't do a css animation
                return;
            }
            $this.addClass('stripe-on');
            function stripeCheck(el) {
                if (!$('.stripe_checkout_app').is(':visible')) {
                    el.removeClass('stripe-on');
                    return;
                }
                setTimeout(stripeCheck, 500, $this);
            }
            stripeCheck();
        });
    });
})(jQuery);
