/**
 * Admin Card Animations and Interactions
 */

jQuery(document).ready(function($) {
    // Add staggered fade-in animation for cards
    $('.mfp-card').each(function(index) {
        var card = $(this);
        setTimeout(function() {
            card.addClass('is-visible');
        }, index * 100); // 100ms delay between each card
    });
});
