(function($){
    // "use strict";
});

console.log('------')

document.addEventListener('click',function(e){
    if(e.target && e.target.className == 'search-button button'){
        document.getElementById('listeo-listings-container').className += ' loading'
     }
 });