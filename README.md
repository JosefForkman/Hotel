WHY NOT A GIF HERE? TO SET THE MODE.

# Island name

Some text about your lovely island

# Hotel name

Why not add some info about the hotel of your dreams?

# Instructions

If your project requires some installation or similar, please inform your user 'bout it. For instance, if you want a more decent indentation of your .php files, you could edit [.editorconfig]('/.editorconfig').

# Code review

Solid project mate. I can't really comment on functions and such, they are above my level, so this will perhaps come off a bit nit-picky. My tries at helping are more about naming conventions and checking spelling than saving a few lines of code through cool methods.

1. Overall - Spellchecking could be better. You use 'calender' (except in js/fullcalendar.js) which is a type of press. No big deal in this project of course, I understand what you mean. But at a job, perhaps working with international teams, there's bound to be issues when calling for functions etc.
2. Overall - Naming of variables and such should be done in the same language.
3. Overall - A few more comments would help reading and getting into the code quicker. I had some issue really understanding how these files all worked together. A bit of clarity in each file would help future co-workers get up to speed much quicker.
4. API/calender/function.php:56 - You use camelCase all of a sudden, when using snake_case for the same type of value before.
5. hotel.db - tables should be plurally named. The table "features" should be "features_rooms" since it's a pivot table.
6. You could turn the HTML <head> into it's own file and include it on other pages, since you code this way already.
7. js/check-out.js:25,48,71 - Not only a hard coded URL but one to localhost:8080, should be fetching from another adress which could be a variable.
8. js/check-out.js:27,30,31 etc - There's no need to console log anything in a completed product.
9. js/check-out.js:51 - I know I already mentioned it (languages and variablenames) but this specifically should not be named using letters that not everyone has on their standard keyboard.
