/**
 *  Add your custom beyondz Javascript for the Canvas LMS in this file.
 *  This is configured on the Canvas admin as a Global Javascript include.
 *  See this for more info: https://guides.instructure.com/m/4214/l/41896-how-do-i-add-custom-javascript-and-css-files-to-my-account
 *
 */
 
 //testing js:
 console.log("js working");
 
 //testing jquery
$.noConflict();
jQuery( document ).ready(function( $ ) {
 console.log("jQ working");
 $("#intro-logo").hover(function(){
  //mouse enter handler:
  console.log("mouse is over logo");
 },function(){
  //mouse leave handler:
  console.log("mouse is no longer over logo");
 });
}); jQuery
