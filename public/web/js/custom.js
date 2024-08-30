$(document).ready(function () {
    $('.our-offices').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ["<div class='nav-btn prev-slide btn-our-officies'></div>", "<div class='nav-btn next-slide btn-our-officies'></div>"],
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    $('.testimony').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        navText: ["<div class='nav-btn prev-slide btn-testimony'></div>", "<div class='nav-btn next-slide btn-testimony'></div>"],
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });
});