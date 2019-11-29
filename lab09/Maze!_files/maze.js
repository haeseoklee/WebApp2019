/* CSE326 : Web Application Development
 * Lab 10 - Maze Assignment
 * name: 이해석  student_id : 2015038513
 */
'use strict';

var loser = null;  // whether the user has hit a wall

window.onload = function() {
    [].forEach.call($$('.boundary'), function(element){
        element.observe('mouseover', overBoundary);
    });
    $('end').observe('mouseover', overEnd);
    $('start').observe('click', startClick);
};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
    event.target.addClassName('youlose');
    $('status').innerHTML = 'You lose! :(';
    loser = true;
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
    $('maze').addEventListener('mouseleave', overBody);
    [].forEach.call($$('.boundary'), function(element){
        element.removeClassName('youlose');
    });
    [].forEach.call($$('.boundary'), function(element){
        element.observe('mouseover', overBoundary);
    });
    loser = null;
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
    if(!loser){
        $('status').innerHTML = 'You win! :)';
        [].forEach.call($$('.boundary'), function(element){
            element.stopObserving();
        });
        $('maze').removeEventListener('mouseleave', overBody);
    }
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
    [].forEach.call($$('.boundary'), function(element){
        element.addClassName('youlose');
    });
    $('status').innerHTML = 'You lose! :(';
    loser = true;
}
