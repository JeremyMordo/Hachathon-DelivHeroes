/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

$(document).ready(function(){
    //MODALS
        //OPEN
            $('body').on('click','.modal_open',function(e) {
                e.preventDefault();
                $('.modal_overlay').addClass('active');
                $('.modal').addClass('active');
            });
        //CLOSE
            $('body').on('click','.modal_overlay',function(e) {
                e.preventDefault();
                $('.modal_overlay').removeClass('active');
                $('.modal').removeClass('active');
            });
            $('body').on('click','.modal_close',function(e) {
                e.preventDefault();
                $('.modal_overlay').removeClass('active');
                $('.modal').removeClass('active');
            });
        
    });