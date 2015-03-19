/**
 *  Add your custom beyondz Javascript for the Canvas LMS in this file.
 *  This is configured on the Canvas admin as a Global Javascript include.
 *  See this for more info: https://guides.instructure.com/m/4214/l/41896-how-do-i-add-custom-javascript-and-css-files-to-my-account
 *
 */
 
 //testing js:
 var logo = document.getElementByID("intro-logo");
 logo.onClick=function(e){
   alert("hello");
 }
 
 //testing jquery
$.noConflict();
jQuery( document ).ready(function( $ ) {
  alert("jQ in da haus!")
}); jQuery
