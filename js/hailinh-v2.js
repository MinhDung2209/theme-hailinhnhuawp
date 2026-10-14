/* Hai Linh v2: lightbox anh + bam xem video YouTube tai cho */
(function () {
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a.hl-lightbox');
        if (link) {
            e.preventDefault();
            var box = document.createElement('div');
            box.className = 'hl-lb';
            box.innerHTML = '<button type="button" class="hl-lb-close" aria-label="Close">&times;</button><img alt="">';
            box.querySelector('img').src = link.getAttribute('href');
            box.addEventListener('click', function () { box.remove(); });
            document.body.appendChild(box);
            return;
        }

        var thumb = e.target.closest('.hl-video-thumb');
        if (thumb) {
            var frame = document.createElement('iframe');
            frame.src = 'https://www.youtube.com/embed/' + encodeURIComponent(thumb.getAttribute('data-yt')) + '?autoplay=1&rel=0';
            frame.allow = 'autoplay; encrypted-media; picture-in-picture';
            frame.allowFullscreen = true;
            frame.title = thumb.getAttribute('aria-label') || 'Video';
            thumb.replaceWith(frame);
        }
    });

    // Menu tren may tinh: re chuot de xo menu con, bam muc cha (VD: Products) thi mo trang cua no
    document.addEventListener('click', function (e) {
        var toggle = e.target.closest('.navbar .dropdown-toggle');
        if (!toggle || window.innerWidth < 992) return;
        var href = toggle.getAttribute('href');
        if (href && href.charAt(0) !== '#') {
            e.stopPropagation();
            window.location.href = href;
        }
    }, true);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var box = document.querySelector('.hl-lb');
            if (box) box.remove();
        }
    });
})();
