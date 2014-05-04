/**
 * Created by Madawa on 04/05/14.
 */
$(function() {
    $.vegas('slideshow', {
        backgrounds:[
            { src:'vegas/images/background1.jpg' },
            { src:'vegas/images/background2.jpg' },
            { src:'vegas/images/background3.jpg' },
            { src:'vegas/images/background4.jpg' },
            { src:'vegas/images/background5.jpg' }
        ],
        fade: 3000,
        delay: 8000,
        loading: false
    })('overlay');

    $.vegas('overlay', {
        src:'vegas/overlays/02.png'
    });
});
